<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
use Cake\I18n\Time;



class StudentClearancesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->StudentClearances = TableRegistry::getTableLocator()->get('StudentClearances');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    $conditionsPrint = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(StudentClearance.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startdate')) {

      $start = $this->request->getQuery('startdate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(StudentClearance.date) >= '$start' AND DATE(StudentClearance.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }


    $limit = 25;

    $tmpData = $this->StudentClearances->paginate($this->StudentClearances->getAllStudentClearance($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $student_clearances = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];
    // var_dump($RequestForms);
    foreach ($student_clearances as $data) {

      $datas[] = array(

  
          'id'            => $data['id'],
  
          'code'          => $data['code'],

          'student_name'  => $data['student_name'],

          'semester'       => $data['semester'],

          'sa_number'       => $data['sa_number'],

          'major'       => $data['major'],

          'program'       => $data['name'],

          'year'       => $data['year'],

          'school_year'       => $data['school_year'],

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

    $requestData = $this->request->getData('StudentClearance');



    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : null;



    $data = $this->StudentClearances->newEmptyEntity();
   
    $data = $this->StudentClearances->patchEntity($data, $requestData); 

    if ($this->StudentClearances->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Student Clearance has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Student Clearance Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Student Clearance cannot saved this time.',

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

    $data = $this->StudentClearances->find()
      ->contain([
          'Students'=> [
              'conditions' => ['Students.visible' => 1],
            ],

          'CollegePrograms'=> [
              'conditions' => ['CollegePrograms.visible' => 1],
            ]
        ])

      ->where([

        'StudentClearances.visible' => 1,

        'StudentClearances.id' => $id

      ])

      ->first();

      $StudentClearance = $data->toArray();

      unset($StudentClearance['Student']);

      unset($StudentClearance['CollegeProgram']);

      $data = [

        'StudentClearance' => $StudentClearance,

        'Student'  => $data['Student'],

        'CollegeProgram'  => $data['CollegeProgram'],

      ];

      $data['StudentClearance']['date'] = isset($data['StudentClearance']['date']) ? date('m/d/Y', strtotime($data['StudentClearance']['date'])) : null;

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

    $data = $this->StudentClearances->get($id); 

    $requestData = $this->getRequest()->getData('StudentClearance');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : NULL;

    $this->StudentClearances->patchEntity($data, $requestData); 

    if ($this->StudentClearances->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Student Clearance has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Student Clearance',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Student Clearance cannot updated this time.',

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

    $data = $this->StudentClearances->get($id);

    $data->visible = 0;

    if ($this->StudentClearances->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Student Clearance has been successfully deleted'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Student Clearance cannot be deleted at this time.'

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
