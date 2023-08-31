<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
use App\Model\Entity\Student;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'PHPMailer/Exception.php';

include 'PHPMailer/PHPMailer.php';

include 'PHPMailer/SMTP.php';

class StudentApplicationsController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->loadComponent('Global');

    $this->StudentApplications = TableRegistry::getTableLocator()->get('StudentApplications');


    $this->CollegeProgram = TableRegistry::getTableLocator()->get('CollegePrograms');

    $this->Student = TableRegistry::getTableLocator()->get('Students');

    $this->Room = TableRegistry::getTableLocator()->get('Rooms');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    $conditionsPrint = '';

    if($this->request->getQuery('search') != null){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date') != null) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(StudentApplication.application_date) = '$search_date'"; 

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startDate') != null) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(StudentApplication.application_date) >= '$start' AND DATE(StudentApplication.application_date) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

    $conditions['status'] = '';

    if ($this->request->getQuery('status') != null) {

      $status = $this->request->getQuery('status');

      if($status == 'assessed'){

        $conditions['status'] = "AND StudentApplication.approve != 3";

        $conditionsPrint .= '&status!=3';

      }else{

        $conditions['status'] = "AND StudentApplication.approve = $status";

        $conditionsPrint .= '&status='.$this->request->getQuery('status');

      }

    }

    $conditions['rate'] = '';

    if ($this->request->getQuery('rate') != null) {

      $rate = $this->request->getQuery('rate');

      if($rate == 0){

        $conditions['rate'] = "AND StudentApplication.rate_by_id IS NULL";

      }else{

        $conditions['rate'] = "AND StudentApplication.rate_by_id IS NOT NULL";

      }

      $conditionsPrint .= '&rate='.$this->request->getQuery('rate');

    }


    $conditions['order'] = '';

    if ($this->request->getQuery('order') != null){

      $order = $this->request->getQuery('order');

      $conditions['order'] = $order;

      $conditionsPrint .= '&order='.$order;
      
    }

    // var_dump($conditions);

    $limit = 25;

    $tmpData = $this->StudentApplications->paginate($this->StudentApplications->getAllStudentApplication($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $main = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($main as $data) {

      $datas[] = array(

        'id'                => $data['id'],

        'full_name'         => $data['full_name'],

        'email'             => $data['email'],

        'address'           => $data['address'],

        'contact_no'        => $data['contact_no'],

        'gender'            => $data['gender'],

        'application_date'  => fdate($data['application_date'],'m/d/Y'),

        'rate'              => $data['rate'],

        'status'            => $data['status'],

        'request_purpose'   => $data['request_purpose'],

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

  public function view($id = null){

    $data['StudentApplication'] = $this->StudentApplications->find()
    ->contain([
        'YearLevelTerms',
        'Colleges',
        'PreferredPrograms',
        'SecondaryPrograms',
        'StudentApplicationImages' => [
            'conditions' => [
                'StudentApplicationImages.visible' => 1
            ]
        ],
        'StudentEnrolledCourses' => [
            'conditions' => [
                'StudentEnrolledCourses.visible' => 1
            ]
        ],
        'StudentEnrolledUnits' => [
            'conditions' => [
                'StudentEnrolledUnits.visible' => 1
            ]
        ],
        'StudentEnrollments' => [
            'conditions' => [
                'StudentEnrollments.visible' => 1
            ]
        ]
    ])
    ->where([
        'StudentApplications.visible' => 1,
        'StudentApplications.id' => $id
    ])
    ->first();

    // var_dump($data['StudentApplication']['college_program']);

    $data['StudentApplication']['birth_date'] = isset($data['StudentApplication']['birth_date']) ? date('m/d/Y', strtotime($data['StudentApplication']['birth_date'])) : '';

    $data['StudentApplication']['approved_date'] = isset($data['StudentApplication']['approved_date']) ? date('m/d/Y', strtotime($data['StudentApplication']['approved_date'])) : '';

    $data['StudentApplication']['disapproved_date'] = isset($data['StudentApplication']['disapproved_date']) ? date('m/d/Y', strtotime($data['StudentApplication']['disapproved_date'])) : '';

    $data['StudentApplicationImage'] = $data['StudentApplication']['student_application_images'];

    $data['College'] = $data['StudentApplication']['college'];

    $data['CollegeProgram'] = $data['StudentApplication']['preferred_program'];

    $data['CollegeProgramSecondary'] = $data['StudentApplication']['secondary_program'];

    $data['YearLevelTerm'] = $data['StudentApplication']['year_level_term'];

    unset($data['StudentApplication']['student_application_image']);

    unset($data['StudentApplication']['college']);

    unset($data['StudentApplication']['preferred_program']);

    unset($data['StudentApplication']['year_level_term']);

    unset($data['StudentApplication']['secondary_program']);

    $applicationImage = array();

    if(!empty($data['StudentApplicationImage'])){

      foreach($data['StudentApplicationImage'] as $key => $image){

        if (!is_null($image['images'])) {

          $applicationImage[] = array(

            'imageSrc' => $this->base . '/uploads/student-application/' . $id . '/' . @$image['images'],

            'name' => @$image['images'],

            'id' => @$image['id'],

          );

        }

      }
    }

    $response = array(

      'ok'   => true,

      'data' => $data,

      'applicationImage' =>$applicationImage

    );
      
    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response'

   ));

        $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function add() {

    if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false)

    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

    $this->request->data = json_decode($_POST['data'], true); 

    $main = $this->request->data;

    $main['StudentApplication']['application_date'] = date('Y-m-d');

    $main['StudentApplication']['year_term_id'] = 1;

    $main['StudentApplication']['birth_date'] = isset($main['StudentApplication']['birth_date']) ? fdate($main['StudentApplication']['birth_date'],'Y-m-d') : null;


    $save = $this->StudentApplication->validSave($main);

    if($save['ok']){

      $id = $this->StudentApplication->getLastInsertId();

      if (count($_FILES) > 0) {

        foreach($_FILES as $image){

          for($ctr = 0; $ctr < count($image['name']); $ctr++){

            $path = "uploads/student-application/$id";

            if(!file_exists('uploads')) mkdir('uploads');

            if(!file_exists('uploads/student-application')) mkdir('uploads/student-application');

            if(!file_exists($path)) mkdir($path);
            
            move_uploaded_file($image['tmp_name'][$ctr], $path . '/' . $image['name'][$ctr]);

            $names[$ctr] = $image['name'][$ctr];

          }

        }

        $newPRImage = @$_FILES['attachment']['name'];

        $datasImages = array();

        if(!empty($newPRImage)){

          if(isset($this->request->data['StudentApplicationImage'])){

            foreach ($this->request->data['StudentApplicationImage'][count($this->request->data['StudentApplicationImage']) - 1]['images'] as $key => $valueImages) {

              $valueImages['images'] = $names[$key];

              $valueImages['application_id'] = $id;

              $datasImages[] = $valueImages;

            }

            $this->StudentApplicationImage->saveMany(@$datasImages);

          }

        }

      }

      $response = $save;

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('Student Application', 'Add',$main['StudentApplication']['first_name'].' '.$main['StudentApplication']['first_name']); 

    }else{

      $response = $save;

    }
    
    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response',

    ));

  }  

  public function edit($id = null){

    if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false)

    $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

    $this->request->data = json_decode($_POST['data'], true); 

    $main = $this->request->data['StudentApplication'];


    $main['birth_date'] = isset($main['birth_date']) ? fdate($main['birth_date'],'Y-m-d') : null;

    

    if($this->StudentApplication->save($main)) {

      $response = array(

        'ok'   => true,

        'msg'  => 'Student Application has been successfully updated.',

        'data' => $this->request->data,

      );

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('Student Application', 'Edit',$main['first_name'].' '.$main['last_name']); 

    }else{

      $response = array(

        'ok'  =>false,

        'msg' =>'Student Application cannot be updated this time.',

        'data'=>$this->request->data,

      );

    }

    $this->set(array(

      'response'=>$response, 

      '_serialize'=>'response'

    ));

  }

  public function delete($id = null) {

    $main = $this->StudentApplication->findById($id);

    if ($this->StudentApplication->hide($id)) {

      $response = array(

        'ok'   => true,

        'msg'  => 'Student Application has been successfully deleted'

      );

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('Student Application', 'Delete',$main['StudentApplication']['first_name'].' '.$main['StudentApplication']['last_name']); 

    } else {

      $response = array(

        'ok'  => false,

        'msg' => 'Student Application cannot be deleted this time.'

      );

    }

    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response',

    ));

  }

  public function api_deleteImage($id = null) {

    $data = $this->StudentApplicationImage->findById($id);

    if ($this->StudentApplicationImage->hide($id)) {

      $path = "uploads/student-application/" . @$data['StudentApplicationImage']['application_id'];

      $orgfile = $path . '/' . @$data['StudentApplicationImage']['images'];

      if(file_exists($orgfile)){

        unlink(@$orgfile);

      }

      $response = array(

        'ok'   => true,

        'data' => $id,

        'msg' => 'File has been deleted.'

      );

    } else {

      $response = array(

        'ok'   => false,

        'data' => $id,

      );

    }

    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response'

    ));

  }

  public function email(){

    $this->autoRender = false;

    $request = $this->request->getData();

    $app = $this->StudentApplications->find()
    ->where([
        'StudentApplications.visible' => 1,
        'StudentApplications.id' => $request['reference_id']
    ])
    ->first();

    //EMAIL VERIFICATION

      if(isset($app['email'])){

        $name = $app['first_name'].' '.substr($app['middle_name'],0,1).'. '.$app['last_name'];

            $app_no = $app['application_no'];

            $email = $app['email'];

            //EMAIL VERIFICATION
            if(isset($email)){

              if($email != ''){

                // fix value
            
                $mail = new PHPMailer(true);

                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
                    $mail->Password = 'tkoahowwnzuzqczy'; // Your Gmail password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('mycreativepandaii@gmail.com', 'MCP'); // Sender's email and name
                    $mail->addAddress($email, $name); // Recipient's email and name

                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Test Email';

                    $_SESSION['name'] = $name; 

                    $_SESSION['date'] = fdate($request['date'],'F d, Y'); 

                    $_SESSION['time'] = $request['time']; 

                    $_SESSION['place'] = $request['place']; 

                    $_SESSION['room'] = $request['room'];

                    $_SESSION['id'] = $request['reference_id'];

                     ob_start();

                include('Email/cat-email.ctp');

                $bodyContent = ob_get_contents();

                ob_end_clean();

                $mail->Body = $bodyContent;
                    

                    $mail->send();

          }

        }

      }

    //EMAIL VERIFICATION

    //SAVING 

    if(!empty($request)) {

      $request['date'] = isset($request['date']) ? fdate($request['date'],'Y-m-d') : null;

       $query = new Student([
        'id' => $request['reference_id'],

        'date' => $request['date'],

        'time' => $request['time'],

        'place' => $request['place'],

        'room' => $request['room']
        ]);

        $this->Student->save($query);

    }

    //SAVING

    $response = array(

      'ok'   => true,

      'data' => $app,       

      'msg'  => 'Email notification has been sent.'

    );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'send Email',

          'userId' => $this->Auth->user('id'),

          'description' => 'CAT',

          'code' => '',

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function api_bulk_email(){

    $this->autoRender = false;

    $request = $this->request->getData();

    if(!empty($request)){

      foreach ($request as $key => $value) {

        $app = $this->StudentApplications->get($value['student_id']); 

        //EMAIL VERIFICATION

          // if(isset($app['StudentApplication']['email'])){

          //   $name = $app['StudentApplication']['first_name'].' '.substr($app['StudentApplication']['middle_name'],0,1).'. '.$app['StudentApplication']['last_name'];

          //   $email = $app['StudentApplication']['email'];

          //   if(isset($email)){

          //     if($email != ''){

          //       $Email = new CakeEmail();

          //       $Email->emailFormat('html');

          //       $Email->template('cat-email', 'mytemplate');

          //       $_SESSION['name'] = $name; 

          //       $_SESSION['date'] = fdate($value['date'],'F d, Y'); 

          //       $_SESSION['time'] = $value['time']; 

          //       $_SESSION['place'] = $value['place']; 

          //       $_SESSION['room'] = $value['room'];

          //       $_SESSION['id'] = $value['student_id'];

          //       $Email->to($email, $name);

          //       $Email->subject('CAT details');

          //       $Email->from(array($this->Global->Settings('email') => 'ESMIS'));

          //       $Email->send();

          //     }

          //   }

          // }

        //EMAIL VERIFICATION

        //EMAIL VERIFICATION

          if(isset($app['email'])){

            $name = $app['first_name'].' '.substr($app['middle_name'],0,1).'. '.$app['last_name'];

            $email = $app['email'];

            if(isset($email)){

              if($email != ''){

                // fix value

                $mail = new PHPMailer();

                $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable debugging
                $mail->Debugoutput = function($str, $level) { echo "SMTP: $str\n"; };


                $mail->isSMTP();

                $mail->Host = 'smtp.mycreativepanda.ph';

                $mail->SMTPAuth = true;

                $mail->Username = 'mycreativepandaii@gmail.com';

                $mail->Password = '@k31w)61&1$%';

                // $mail->SMTPSecure = 'ssl';

                // $mail->Port = 465;

                $mail->SMTPSecure = false;

                $mail->Port = 25;

                $mail->setFrom($this->Global->Settings('email'),'ZABOANGA STATE COLLEGE OF MARINE SCIENCES TECHNOLOGY');

                // end fix value

                $_SESSION['name'] = $name; 

                $_SESSION['date'] = fdate($value['date'],'F d, Y'); 

                $_SESSION['time'] = $value['time']; 

                $_SESSION['place'] = $value['place']; 

                $_SESSION['room'] = $value['room'];

                $_SESSION['id'] = $value['student_id'];

                $mail->addAddress($email,$name);

                $mail->isHTML(true);

                $mail->Subject = 'CAT details';

                ob_start();

                include('Email/cat-email.ctp');

                $bodyContent = ob_get_contents();

                ob_end_clean();

                $mail->Body = $bodyContent;
                
                if($mail->send()){

                  $status =  "Sent";

                  var_dump($status);
                
                }else{

                  $status =  "Failed".$mail->ErrorInfo;

                  var_dump($status);

                }

              }

            }

          }

        //EMAIL VERIFICATION

      }

    }

    //SAVING 

    // if(!empty($value)) {

    //   $value['date'] = isset($value['date']) ? fdate($value['date'],'Y-m-d') : null;
        
    //   $entity = $this->StudentApplications->newEntity([

    //       'id' => $value['student_id'],

    //       'date' => $value['date'],

    //       'time' => $value['time'],

    //       'place' => $value['place'],

    //       'room' => $value['room']

    //   ]);
      
    //   $this->StudentApplications->save($entity);

    // }

    //SAVING

    $response = array(

      'ok'   => true,   

      'msg'  => 'Email notification has been sent.'

    );

    $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
      
    $userLogEntity = $userLogTable->newEntity([

        'action' => 'Bulk Email Notification',

        'userId' => $this->Auth->user('id'),

        'description' => 'CAT',

        'code' => '',

        'created' => date('Y-m-d H:i:s'),

        'modified' => date('Y-m-d H:i:s')

    ]);
    
    $userLogTable->save($userLogEntity);

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function rate($id = null){

     $this->autoRender = false;

    $app = $this->StudentApplications->get($id);

    $data['id'] = $id;

    $app->approve = 1;

    $app->rated_date = date('Y-m-d');

    $app->rate_by_id = $this->Auth->user('id');

    $app->rate = @$this->request->getData('rate');

    $app->status = 'FOR INTERVIEW REQUEST';

    if($this->StudentApplications->save($app)){

      //LIST OF PROGRAMS BASED ON RATE

        $program = $this->CollegeProgram->get($app['preferred_program_id']);

        if(!empty($program)){ // EMAIL FOR FAILED

          if($program['passing_rate'] > $app['rate']){

            $program_list = $this->CollegeProgram->find()

              ->where([

                'CollegeProgram.visible' => 1,

                'CollegeProgram.passing_rate <=' => $app['rate']

              ])
              ->all();

            $list = array();

            if(!empty($program_list)){

              foreach ($program_list as $keys => $values) {
                
                $list[$keys]['name'] = $values['CollegeProgram']['name'];

              }

            }
              if(isset($app['email'])){

            $name = $app['first_name'].' '.substr($app['middle_name'],0,1).'. '.$app['last_name'];

            $email = $app['email'];

            if(isset($email)){

              if($email != ''){
                // fix value

                $mail = new PHPMailer(true);

                  try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.mycreativepanda.ph';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
                    $mail->Password = '@k31w)61&1$%'; // Your Gmail password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('your@gmail.com', 'Your Name'); // Sender's email and name
                    $mail->addAddress($email, 'Recipient Name'); // Recipient's email and name

                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Test Email';
                    $mail->Body = 'This is a test email sent from PHPMailer.';

                    $mail->send();
                    echo 'Message has been sent';
                  } catch (Exception $e) {
                      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  }

              }

            }

          }

            //EMAIL VERIFICATION

          }else{ // EMAIL FOR PASSED
            $name = $app['first_name'].' '.substr($app['middle_name'],0,1).'. '.$app['last_name'];

            $app_no = $app['application_no'];

            $email = $app['email'];

            //EMAIL VERIFICATION
            if(isset($email)){

              if($email != ''){

                // fix value
            
                $mail = new PHPMailer(true);

                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
                    $mail->Password = 'tkoahowwnzuzqczy'; // Your Gmail password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('mycreativepandaii@gmail.com', 'MCP'); // Sender's email and name
                    $mail->addAddress($email, $name); // Recipient's email and name

                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Test Email';


                    $_SESSION['application_no'] = $app_no; 

                    $_SESSION['name'] = $name; 

                    $_SESSION['rate'] = @$this->request->getData('rate');

                    $_SESSION['preferred_program'] = $program['name']; 

                    $_SESSION['id'] = $app['id']; 

                     ob_start();

                include('Email/cat-result-email-passed.ctp');

                $bodyContent = ob_get_contents();

                ob_end_clean();

                $mail->Body = $bodyContent;
                    

                    $mail->send();


              }

            }

          }

            //EMAIL VERIFICATION

          }

        

      //END 

      //TRANSFERRING DATA TO STUDENT TABLE

        // $this->Student->create();
        $query = new Student([
            'student_applicant_id' => $id,
            'student_no' => $app['student_no'],
            'first_name' => $app['first_name'],
            'middle_name' => $app['middle_name'],
            'last_name' => $app['last_name'],
            'college_id' => $app['college_id'],
            'program_id' => $app['preferred_program_id'],
            'gender' => $app['gender'],
            'year_term_id' => $app['year_term_id'],
            'email' => $app['email']
        ]);

        $this->Student->save($query);

        $student_id = $query->id;

      //END 



      $response = array(

        'ok'   => true,

        'data' => $data,       

        'msg'  => 'Examinee has been successfully rated.'

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'rate',

          'userId' => $this->Auth->user('id'),

          'description' => 'CAT',

          'code' => '',

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);

      $userLogTable->save($userLogEntity);

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Examinee cannot be rated this time.'

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

  public function api_request_interview($id = null){

    $app = $this->StudentApplication->findById($id);

    $student = $this->Student->findById($this->Session->read('Auth.User.studentId'));

    $data['id'] = $student['Student']['student_applicant_id'];

    $data['approve'] = 1;

    $data['status'] = 'REQUESTED';

    $data['request_purpose'] = $this->request->data['purpose'];   

    $this->StudentApplication->create();

    if($this->StudentApplication->save($data)){

      $response = array(

        'ok'   => true,

        'data' => $data,       

        'msg'  => 'You have successfully requested for a medical interview.'

      );

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('Admission Application', 'Medical Interview Request',@$app['StudentApplication']['student_no']); 

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Cannot request interview this time.'

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));
    
  }

  public function send_schedule($id = null){

    $request = $this->request->getData(); 

    $room = $this->Room->get($request['room']);

    $app = $this->StudentApplications->get($id);

    //EMAIL VERIFICATION

      $name = @$app['first_name'].' '.@$app['middle_name'].' '.@$app['last_name'];

      $email = @$app['email'];

     if($app['email']){

        $name = $app['first_name'].' '.substr($app['middle_name'],0,1).'. '.$app['last_name'];

            $app_no = $app['application_no'];

            $email = $app['email'];

            //EMAIL VERIFICATION
            if($email){

              if($email != ''){

                // fix value
            
                $mail = new PHPMailer(true);

                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
                    $mail->Password = 'tkoahowwnzuzqczy'; // Your Gmail password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('mycreativepandaii@gmail.com', 'MCP'); // Sender's email and name
                    $mail->addAddress($email, $name); // Recipient's email and name

                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Test Email';

                    $_SESSION['name'] = $name; 

                    $_SESSION['date'] = fdate($request['date'],'F d, Y'); 

                    $_SESSION['time'] = $request['time']; 

                    $_SESSION['place'] = $request['place']; 

                    $_SESSION['room'] = $request['room'];

                    $_SESSION['id'] = $request['reference_id'];

                     ob_start();

                include('Email/cat-email.ctp');

                $bodyContent = ob_get_contents();

                ob_end_clean();

                $mail->Body = $bodyContent;
                    

                    $mail->send();

          }

        }

      }

    //EMAIL VERIFICATION

    $response = array(

      'ok'   => true,

      'data' => $request,       

      'msg'  => 'Examinee has been successfully rated.'

    );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'send Schedule',

          'userId' => $this->Auth->user('id'),

          'description' => 'CAT',

          'code' => '',

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));
    
  }

  public function api_qualify($id = null){

    $app = $this->StudentApplication->findById($id);

    $data['id'] = $id;

    $data['approve'] = 2;

    $data['approved_date'] = date('Y-m-d');

    $data['approved_by_id'] = $this->Session->read('Auth.User.id');

    $data['status'] = 'QUALIFIED';

    $this->StudentApplication->create();

    if($this->StudentApplication->save($data)){

      //EMAIL VERIFICATION

        $name = @$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['middle_name'].' '.@$app['StudentApplication']['last_name'];

        $email = @$app['StudentApplication']['email'];

        if(isset($email)){

          if(!empty($email)){

            if($email != ''){

              $Email = new CakeEmail();

              $Email->emailFormat('html');

              $Email->template('admission-application-qualified', 'mytemplate');

              $_SESSION['name'] = @$name; 

              $_SESSION['application_no'] = @$app['StudentApplication']['application_no'];

              $_SESSION['id'] = $id; 

              $Email->to($email, $name);

              $Email->subject('Application Status');

              $Email->from(array($this->Global->Settings('email') => 'ESMIS'));

              $Email->send();

            }

          }

        }

      //EMAIL VERIFICATION

      $response = array(

        'ok'   => true,

        'data' => $data,       

        'msg'  => 'Examinee has been successfully rated.'

      );

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('CAT', 'Rate',@$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['last_name']); 

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Examinee cannot be rated this time.'

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

  } 

  public function api_unqualify($id = null){

    $app = $this->StudentApplication->findById($id);

    $data['id'] = $id;

    $data['approve'] = 3;

    $data['disapproved_by_id'] = $this->Session->read('Auth.User.id');

    $data['disapproved_reason'] = @$this->request->data['explanation'];

    $data['disapproved_date'] = date('Y-m-d');

    $this->StudentApplication->create();

    if($this->StudentApplication->save($data)){

      //EMAIL VERIFICATION

        $name = @$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['middle_name'].' '.@$app['StudentApplication']['last_name'];

        $email = @$app['StudentApplication']['email'];

        if(isset($email)){

          if(!empty($email)){

            if($email != ''){

              $Email = new CakeEmail();

              $Email->emailFormat('html');

              $Email->template('admission-application-unqualified', 'mytemplate');

              $_SESSION['name'] = @$name; 

              $_SESSION['application_no'] = @$app['StudentApplication']['application_no'];

              $_SESSION['disapproved_reason'] = @$data['disapproved_reason']; 

              $_SESSION['id'] = $id; 

              $Email->to($email, $name);

              $Email->subject('Application Status');

              $Email->from(array($this->Global->Settings('email') => 'ESMIS'));

              $Email->send();

            }

          }

        }

      //EMAIL VERIFICATION

      $response = array(

        'ok'   => true,

        'data' => $data,       

        'msg'  => 'Student Application has been successfully disapproved.'

      );

      $this->loadModel('UserLog');

      $this->UserLog->addLogs('Student Application', 'Disapproved',@$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['last_name']); 

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Student Application cannot be disapproved this time.'

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));
    
  }

}
