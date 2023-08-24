<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;


class ApartellesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->Apartelles = TableRegistry::getTableLocator()->get('Apartelles');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(Apartelles.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startdate')) {

      $start = $this->request->getQuery('startdate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(Apartelles.date) >= '$start' AND DATE(Apartelles.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

    $dataTable = TableRegistry::getTableLocator()->get('Apartelles');

    $limit = 25;

    $tmpData = $dataTable->paginate($dataTable->getAllApartelle($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $apartelles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($apartelles as $apartelle) {

      $datas[] = array(

        'id'           => $apartelle['id'],

        'code'         => $apartelle['code'],

        'building_no'         => $apartelle['building_no'],

        'room_no'     => $apartelle['room_no'],

        'price'   => $apartelle['price'],

        'capacity'   => $apartelle['capacity'],

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

    $requestData = $this->request->getData('Apartelle');

    $data = $this->Apartelles->newEmptyEntity();
   
    $data = $this->Apartelles->patchEntity($data, $requestData); 

    if ($this->Apartelles->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Apartelles has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Apartelle Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Apartelles cannot saved this time.',

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

    $data['Apartelle'] = $this->Apartelles->find()

      ->where([

        'visible' => 1,

        'id' => $id

      ])

      ->first();

    $data['Apartelle']['active_view'] = $data['Apartelle']['active'] ? 'True' : 'False';

    $data['Apartelle']['floors'] = intval($data['Apartelle']['floors']);

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

    $building = $this->Apartelles->get($id); 

    $requestData = $this->getRequest()->getData('Apartelle');

    $requestData['date'] = isset($requestData['date']) ? date('Y/m/d', strtotime($requestData['date'])) : null;

    $this->Apartelles->patchEntity($building, $requestData); 

    if ($this->Apartelles->save($building)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Apartelles has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Apartelle Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Apartelles cannot updated this time.',

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

    $data = $this->Apartelles->get($id);

    $data->visible = 0;

    if ($this->Apartelles->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Apartelles has been successfully deleted'

      ];

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Delete',

          'description' => 'Apartelle Management',

          'code' => $data->code,

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Apartelles cannot be deleted at this time.'

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
