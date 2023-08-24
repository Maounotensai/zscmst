<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;

class ApartelleRegistrationsController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->ApartelleRegistrations = TableRegistry::getTableLocator()->get('ApartelleRegistrations');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    $conditionsPrint = '';

    $condition['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

    }

    $conditions['status'] = '';

    if ($this->request->getQuery('status')!=null) {

      $status = $this->request->getQuery('status');

      $conditions['status'] = "AND ApartelleRegistration.approve = $status";
 
      $conditionsPrint .= '&status='.$this->request->getQuery('status');

    }

    $conditions['studentId'] = '';

    if ($this->request->getQuery('per_student')) {

      $per_student = $this->request->getQuery('per_student');
      
      $studentId = $this->Session->read('Auth.User.studentId');

      $conditions['studentId'] = "AND ApartelleRegistration.student_id = $studentId";

      $conditionsPrint .= '&per_student='.$per_student;

    }

    $dataTable = TableRegistry::getTableLocator()->get('ApartelleRegistrations');

    $limit = 25;

    $tmpData = $dataTable->paginate($dataTable->getAllApartelleRegistrationPrint($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $apartelleRegistrations = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($apartelleRegistrations as $apartelleRegistration) {

      $datas[] = array(

        'id'                       => $apartelleRegistration['id'],

        'code'                     => $apartelleRegistration['code'],

        'student_name'             => $apartelleRegistration['student_name'],

        'nick_name'                => $apartelleRegistration['nick_name'],

        'date_of_birth'            => fdate($apartelleRegistration['date_of_birth'],'m/d/Y'),

        'address'                  => $apartelleRegistration['address'],

        'course'                   => $apartelleRegistration['code'],

        'year_level'               => $apartelleRegistration['description'],

        'status'                   => $apartelleRegistration['approve'],
      );

    }

    $response = [

      'ok' => true,

      'data' => $datas,

      'paginator' => $paginator,

      'conditionsPrint' => $conditionsPrint

    ];

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function add(){

    $this->autoRender = false;

    $requestData = $this->request->getData('GoodMoral');

    $requestData['date'] = isset($requestData['date']) ? fdate($requestData['date'],'Y-m-d') : NULL;

    $data = $this->GoodMorals->newEmptyEntity();
   
    $data = $this->GoodMorals->patchEntity($data, $requestData); 

    if ($this->GoodMorals->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Good Moral Certificate has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

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

        'msg' =>'Good Moral Certificate cannot saved this time.',

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

  public function view($id = null){

    $data['GoodMoral'] = $this->GoodMorals->find()

      ->where([

        'visible' => 1,

        'id' => $id

      ])

      ->first();

    $data['GoodMoral']['active_view'] = $data['GoodMoral']['active'] ? 'True' : 'False';

    $data['GoodMoral']['date'] = $data['GoodMoral']['date']->format('m/d/Y');

    $data['GoodMoral']['floors'] = intval($data['GoodMoral']['floors']);

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

    $data = $this->GoodMorals->get($id);

    $data->visible = 0;

    if ($this->GoodMorals->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Good Moral Certificate has been successfully deleted'

      ];

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Delete',

          'description' => 'Good Moral Certificate',

          'code' => $data->code,

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Good Moral Certificate cannot be deleted at this time.'

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
