<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;


class SettingsController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->Settings = TableRegistry::getTableLocator()->get('Settings');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

    }

    $dataTable = TableRegistry::getTableLocator()->get('Settings');

    $limit = 25;

    $tmpData = $dataTable->paginate($dataTable->getAllSettings($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $settings = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($settings as $setting) {

      $datas[] = array(

        'id'           => $setting['id'],

        'code'         => $setting['code'],

        'name'         => $setting['name'],

        'value'     => $setting['value'],

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

    $this->autoRender = false;

    $requestData = $this->request->getData('Setting');

    $data = $this->Settings->newEmptyEntity();
   
    $data = $this->Settings->patchEntity($data, $requestData); 

    if ($this->Settings->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Information has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Organization Information',

          'name' => $requestData['name'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Information cannot saved this time.',

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

    $data['Account'] = $this->Accounts->find()

      ->where([

        'visible' => 1,

        'id' => $id

      ])

      ->first();

    $data['Account']['active_view'] = $data['Account']['active'] ? 'True' : 'False';

    $data['Account']['floors'] = intval($data['Account']['floors']);

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

    $building = $this->Accounts->get($id); 

    $requestData = $this->getRequest()->getData('Account');

    $requestData['date'] = isset($requestData['date']) ? date('Y/m/d', strtotime($requestData['date'])) : null;

    $this->Accounts->patchEntity($building, $requestData); 

    if ($this->Accounts->save($building)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Chart of Accounts has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Chart of Accounts',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Chart of Accounts cannot updated this time.',

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

    $data = $this->Accounts->get($id);

    $data->visible = 0;

    if ($this->Accounts->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Chart of Accounts has been successfully deleted'

      ];

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Delete',

          'description' => 'Chart of Accounts',

          'code' => $data->code,

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Chart of Accounts cannot be deleted at this time.'

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
