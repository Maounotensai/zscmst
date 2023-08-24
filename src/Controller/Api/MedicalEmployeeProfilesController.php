<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;

class MedicalEmployeeProfilesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->MedicalEmployeeProfiles = TableRegistry::getTableLocator()->get('MedicalEmployeeProfiles');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

    }

    $dataTable = TableRegistry::getTableLocator()->get('MedicalEmployeeProfiles');

    $limit = 25;

    $tmpData = $dataTable->paginate($dataTable->getAllMedicalEmployeeProfile($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $medicalEmployeeProfiles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($medicalEmployeeProfiles as $medical) {

      $datas[] = array(

        'id'                      => $medical['id'],

        'code'                    => $medical['code'],

        'employee_name'           => $medical['employee_name'],

        'address'                 => $medical['address'],

        'age'                     => $medical['age'],

        'height'                  => $medical['height'],

        'weight'                  => $medical['weight'],

        'remarks'                 => $medical['remarks']

      );

    }

    $response = [

      'ok' => true,

      'data' => $datas,

      'paginator' => $paginator,

    ];

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function add(){

    if ($this->request->is(['post', 'ajax']) && $this->request->is('json')) {

      $requestData = $this->request->getData('data');

      $data = json_decode($requestData, true);

      // var_dump($data);

      $medicalEmployeeProfiles = $data['MedicalEmployeeProfile'];

      $uploadedFile = $this->request->getData('file');

      if ($uploadedFile instanceof \Laminas\Diactoros\UploadedFile && $uploadedFile->getError() === UPLOAD_ERR_OK) {

        $medicalEmployeeProfiles['files'] = $uploadedFile->getClientFilename();

      }

      $save = $this->MedicalEmployeeProfiles->save($medicalEmployeeProfiles);
      
      $employee_id = $save['data']['id'];

      if ($save['ok']) {

        if ($uploadedFile instanceof \Laminas\Diactoros\UploadedFile && $uploadedFile->getError() === UPLOAD_ERR_OK) {

          $medicalEmployeeProfiles['files'] = $uploadedFile->getClientFilename();

          // Upload user image

          if (!file_exists('uploads')) {

            mkdir('uploads');

          }

          if (!file_exists('uploads/medical-employee-profile')) {

            mkdir('uploads/medical-employee-profile');

          }

          $imagePath = "uploads/medical-employee-profile/$employee_id";

          if (!file_exists($imagePath)) {

            mkdir($imagePath);

          }

          $uploadedFilePath = $imagePath . '/' . $uploadedFile->getClientFilename();

          $uploadedFile->moveTo($uploadedFilePath);

          $response = array(

            'ok'  =>true,

            'msg' =>'Medical Employee Profile has been successfully saved.',

            'data'=> $requestData

          );

          $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
            
          $userLogEntity = $userLogTable->newEntity([

              'action' => 'Add',

              'description' => 'Medical Employee Profile',

              'code' => $requestData['code'],

              'created' => date('Y-m-d H:i:s'),

              'modified' => date('Y-m-d H:i:s')

          ]);
          
          $userLogTable->save($userLogEntity);

        }

      }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Medical Employee Profile cannot saved this time.',

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

    }

  }

  public function view($id = null){

    $data['MedicalEmployeeProfile'] = $this->MedicalEmployeeProfiles->find()

      ->where([

        'visible' => 1,

        'id' => $id

      ])

      ->first();

    $data['MedicalEmployeeProfile']['active_view'] = $data['MedicalEmployeeProfile']['active'] ? 'True' : 'False';

    $data['MedicalEmployeeProfile']['floors'] = intval($data['MedicalEmployeeProfile']['floors']);

    $response = [

      'ok' => true,

      'data' => $data

    ];

    $this->set([

      'response' => $response,

      '_serialize' => 'response'

    ]);

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function edit($id){

    $building = $this->GoodMorals->get($id); 

    $requestData = $this->getRequest()->getData('GoodMoral');

    $requestData['date'] = isset($requestData['date']) ? date('Y/m/d', strtotime($requestData['date'])) : null;

    $requestData['date'] = isset($requestData['date']) ? fdate($requestData['date'],'Y-m-d') : NULL;

    $this->GoodMorals->patchEntity($building, $requestData); 

    if ($this->GoodMorals->save($building)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Good Moral Certificate has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Good Moral Certificate',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Good Moral Certificate cannot updated this time.',

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function delete($id){

    $this->autoRender = false;

    $this->request->allowMethod(['delete']);

    $data = $this->MedicalEmployeeProfiles->get($id);

    $data->visible = 0;

    if ($this->MedicalEmployeeProfiles->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Medicla Employee Profile has been successfully deleted'

      ];

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Delete',

          'description' => 'Medicla Employee Profile',

          'code' => $data->code,

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Medicla Employee Profile cannot be deleted at this time.'

      ];

    }

    $this->set([

      'response' => $response,

      '_serialize' => 'response'

    ]);

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

}
