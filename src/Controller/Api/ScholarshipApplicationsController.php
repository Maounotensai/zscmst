<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
use Cake\I18n\Time;


class ScholarshipApplicationsController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->ScholarshipApplication = TableRegistry::getTableLocator()->get('ScholarshipApplications');

    $this->UserLogs = TableRegistry::getTableLocator()->get('UserLogs');

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

    if (isset($this->request->query['date'])) {

      $search_date = $this->request->query['date'];

      $conditions['date'] = " AND DATE(ScholarshipApplication.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if (isset($this->request->query['startDate'])) {

      $start = $this->request->query['startDate']; 

      $end = $this->request->query['endDate'];

      $conditions['date'] = " AND DATE(ScholarshipApplication.date) >= '$start' AND DATE(ScholarshipApplication.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

    $conditions['status'] = '';

    if ($this->request->getQuery('status')!=null) {

      $status = $this->request->getQuery('status');

      $conditions['status'] = " AND ScholarshipApplication.approve = $status";
 
      $conditionsPrint .= '&status='.$this->request->getQuery('status');

    }

    $conditions['studentId'] = '';

    if ($this->request->getQuery('per_student')) {

      $per_student = $this->request->getQuery('per_student');
      
      $studentId = $this->Session->read('Auth.User.studentId');

      $conditions['studentId'] = " AND ScholarshipApplication.student_id = $studentId";

      $conditionsPrint .= '&per_student='.$per_student;

    }

    $limit = 25;

    $tmpData = $this->ScholarshipApplication->paginate($this->ScholarshipApplication->getAllScholarshipApplication($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $ScholarshipApplication = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];
    // print_r($ScholarshipApplication);
    foreach ($ScholarshipApplication as $data) {

      $datas[] = array(

          'id'            => $data['id'],

          'code'          => $data['code'],

          'student_name'  => $data['student_name'],

          'date'          => fdate($data['date'],'m/d/Y'),

          'program'       => $data['name'],

          'scholarship_name'       => $data['scholarship_name'],

          'sex'           => $data['sex'],

          'age'           => $data['age'],
       
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

    $requestData = $this->request->getData('ScholarshipApplication');

    $data = $this->ScholarshipApplication->newEmptyEntity();
   
    $data = $this->ScholarshipApplication->patchEntity($data, $requestData); 

    if ($this->ScholarshipApplication->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Scholarship Application has been successfully saved.',

        'data'=>$requestData

      );


        
      $userLogEntity = $this->UserLogs->newEntity([

          'action' => 'Add',

          'description' => 'Scholarship Application Management',

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $this->UserLogs->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Scholarship Application cannot saved this time.',

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

    $data['ScholarshipApplication'] = $this->ScholarshipApplication->find()
    
    ->contain([
      
        'Students',
        
        'CollegePrograms',
        
        'Schools' => ['fields' => 'school_name'],
        
        'ScholarshipNames' => ['fields' => 'scholarship_name']
        
    ])
    
    ->where([
      
        'ScholarshipApplication.visible' => true,
        
        'ScholarshipApplication.id' => $id
        
    ])
    
    ->first();

    $data['Student'] = $data['ScholarshipApplication']['student'];

    $data['CollegeProgram'] = $data['ScholarshipApplication']['college_program'];

    $data['School'] = $data['ScholarshipApplication']['school'];

    $data['ScholarshipName'] = $data['ScholarshipApplication']['scholarship_name'];


    unset($data['ScholarshipApplication']['student']);

    unset($data['ScholarshipApplication']['college_program']);

    unset($data['ScholarshipApplication']['school']);

    unset($data['ScholarshipApplication']['scholarship_name']);

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

    $ScholarshipApplication = $this->ScholarshipApplication->get($id); 

    $requestData = $this->getRequest()->getData('ScholarshipApplication');
    // var_dump($requestData);
    $requestData['date'] = isset($requestData['date']) ? date('Y/m/d', strtotime($requestData['date'])) : null;

    $data = $this->ScholarshipApplication->patchEntity($ScholarshipApplication, $requestData); 

    // debug($data);

    if ($this->ScholarshipApplication->save($ScholarshipApplication)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'ScholarshipApplication has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogEntity = $this->UserLogs->newEntity([

          'action' => 'Edit',

          'description' => 'ScholarshipApplication Management',

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $this->UserLogs->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'ScholarshipApplication cannot updated this time.',

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

    $data = $this->ScholarshipApplication->get($id);

    $data->visible = 0;

    if ($this->ScholarshipApplication->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'ScholarshipApplication has been successfully deleted'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'ScholarshipApplication cannot be deleted at this time.'

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
