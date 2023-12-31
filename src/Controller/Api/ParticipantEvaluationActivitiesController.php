<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
use Cake\I18n\Time;



class ParticipantEvaluationActivitiesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->ParticipantEvaluationActivities = TableRegistry::getTableLocator()->get('ParticipantEvaluationActivities');

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

    $limit = 25;

    $tmpData = $this->ParticipantEvaluationActivities->paginate($this->ParticipantEvaluationActivities->getAllParticipantEvaluationActivity($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $participant_evaluation_activities = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];
    // var_dump($RequestForms);
    foreach ($participant_evaluation_activities as $data) {

      $datas[] = array(

  
          'id'            => $data['id'],
  
          'activity'      => $data['activity'],

          'venue'         => $data['venue'],

          'year'          => $data['year'],

          'course'        => $data['program_name'],

          'question_1'    => $data['question_1'],

          'question_2'    => $data['question_2'],

          'date'          => fdate($data['date'],'m/d/Y')

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

    $requestData = $this->request->getData('ParticipantEvaluationActivity');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : null;

    $data = $this->ParticipantEvaluationActivities->newEmptyEntity();
   
    $data = $this->ParticipantEvaluationActivities->patchEntity($data, $requestData); 

    if ($this->ParticipantEvaluationActivities->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Participant Evaluation Activity has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Participant Evaluation Activity Management',

          'code' => $requestData['activity'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Participant Evaluation Activity cannot saved this time.',

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

    $data['ParticipantEvaluationActivity'] = $this->ParticipantEvaluationActivities->find()

      ->contain([

        'CollegePrograms'

        ])

      ->where([

        'ParticipantEvaluationActivities.visible' => 1,

        'ParticipantEvaluationActivities.id' => $id

      ])

      ->first();

      $data = [

        'ParticipantEvaluationActivity' => $data['ParticipantEvaluationActivity'],

        'CollegeProgram'  => $data['ParticipantEvaluationActivity']->CollegeProgram,

      ];

      unset($data['ParticipantEvaluationActivity']->CollegeProgram);


      $data['ParticipantEvaluationActivity']['date'] = isset($data['ParticipantEvaluationActivity']['date']) ? date('m/d/Y', strtotime($data['ParticipantEvaluationActivity']['date'])) : null;

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

    $data = $this->ParticipantEvaluationActivities->get($id); 

    $requestData = $this->getRequest()->getData('ParticipantEvaluationActivity');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : NULL;

    $this->ParticipantEvaluationActivities->patchEntity($data, $requestData); 

    if ($this->ParticipantEvaluationActivities->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Participant Evaluation Activity has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Participant Evaluation Activity',

          'code' => $requestData['activity'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Participant Evaluation Activity cannot updated this time.',

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

    $data = $this->ParticipantEvaluationActivities->get($id);

    $data->visible = 0;

    if ($this->ParticipantEvaluationActivities->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Participant Evaluation Activity has been successfully deleted'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Participant Evaluation Activity cannot be deleted at this time.'

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
