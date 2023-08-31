<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
 

class ReportsController extends AppController {



	public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->Reports = TableRegistry::getTableLocator()->get('Reports');

    $this->ItemIssuance = TableRegistry::getTableLocator()->get('ItemIssuances');

    $this->InventoryProperty = TableRegistry::getTableLocator()->get('InventoryProperties');

    $this->CheckOutSub = TableRegistry::getTableLocator()->get('CheckOutSubs');

  }


  public function faculty_masterlists() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['college_id'] = "AND Employee.college_id IS NULL";

    if ($this->request->getQuery('college_id')) {

      $college_id = $this->request->getQuery('college_id'); 

      $conditions['college_id'] = " AND Employee.college_id = $college_id";

      $conditionsPrint .= '&college_id='.$college_id;

    }

    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllFacultyMasterlist($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'faculty-masterlist'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $faculty_masterlists = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($faculty_masterlists as $data) {

      $datas[] = array(

          'id'            => $data['id'],
          
          'code'  		  => $data['code'],

          'faculty_name'  => $data['full_name'],

          'gender'        => $data['gender'],

          'academic_rank' => $data['academic_rank'],

          'college'       => $data['college'],

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

  public function medical_monthly_accomplishment() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $start = date('Y-m-').'01';

    $end = date('Y-m-t');

    $conditions['date'] = "AND DATE(ConsultationSub.date) >= '$start' AND DATE(ConsultationSub.date) <= '$end'";

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = "AND DATE(ConsultationSub.date) >= '$start' AND DATE(ConsultationSub.date) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllMedicalMonthlyAccomplishment($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'medical-monthly-accomplishment'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $monthly_accomplishments = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($monthly_accomplishments as $data) {

      $datas[] = array(

          'ailment'           => $data['ailment'],

          'studentTreated'    => $data['studentTreated'],

          'employeeTreated'   => $data['employeeTreated'],

          'totalTreated'      => $data['totalTreated'],

          'studentReferred'   => $data['studentReferred'],

          'employeeReferred'  => $data['employeeReferred'],

          'totalReferred'     => $data['totalReferred'],

          'remarks'           => $data['remarks'],

       );

    }

    $response = array(

      'ok' => true,

      'conditionsPrint' => $conditionsPrint,

      'data' => $datas,

      'month' => 'For the month of '.fdate($start,'F Y'),

      'paginator' => $paginator

    );

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }  

  public function medical_property_equipment() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(PropertyLog.date) = '$search_date'"; 

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(PropertyLog.date) >= '$start' AND DATE(PropertyLog.date) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllMedicalPropertyEquipment($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'medical-property-equipment'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $property_equipments = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($property_equipments as $data) {

      $datas[] = array(

          'id'           => $data['id'],

          'property_name' => $data['property_name'],

          'type'         => $data['type'],

          'date'         => fdate($data['date'],'m/d/Y'),

       );

    }

    $response = array(

      'ok' => true,

      'conditionsPrint' => $conditionsPrint,

      'data' => $datas,

      'paginator' => $paginator

    );

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function medical_monthly_consumption() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $start = date('Y-m-d');

    $end = date('Y-m-t');

    $conditionDate = "AND DATE(ItemIssuance.date) >= '$start' AND DATE(ItemIssuance.date) <= '$end'";

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditionDate = "AND DATE(ItemIssuance.date) >= '$start' AND DATE(ItemIssuance.date) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllMedicalMonthlyConsumption($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'medical-monthly-consumption'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $monthly_consumptions = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    if(count($monthly_consumptions) > 0){

      foreach ($monthly_consumptions as $data) {

        $item_id = $data['id'];

        $issuancesQuery = $this->ItemIssuance->find();
    	$issuancesQuery->select([

    	    'number_issued' => $issuancesQuery->func()->coalesce([

    	        $issuancesQuery->func()->sum('ItemIssuanceSubs.quantity'),

    	        0
    	    ])

    	])

    ->leftJoinWith('ItemIssuanceSubs')	

    ->where([

        'ItemIssuances.visible' => 1,

        'ItemIssuances.status' => 1,

        'ItemIssuanceSubs.item_id' => $item_id

      ])

      ->enableAutoFields(true);

      $issuancesResult = $issuancesQuery->firstOrFail();

      $total_issuances = $issuancesResult->number_issued ?? 0;

      $inventory = $this->InventoryProperty->find()

      ->where([

          'InventoryProperties.visible' => 1,

          'InventoryProperties.property_log_id' => $item_id

      ])

      ->all();

  		$total_stock = 0;

  		foreach ($inventory as $entity) {

  		    $entity->expiry_date = $entity->expiry_date->format('m/d/Y');

  		    $total_stock += $entity->stocks;

  		}

          $datas[] = array(

            'property_name'        => $data['property_name'],

            'inventory'            => $inventory,

            'total_stock'          => $total_stock,    

            'balance'              => $total_stock - $total_issuances,       

            'number_issued'        => $total_issuances,

          );

        }

      }

      $response = array(

        'ok' => true,

        'conditionsPrint' => $conditionsPrint,

        'data' => $datas,

        'paginator' => $paginator

      );

      $this->response->withType('application/json');

      $this->response->getBody()->write(json_encode($response));

      return $this->response;

  }  


  public function enrollment_profile() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['program_id'] = "";

    if ($this->request->getQuery('program_id')) {

      $program_id = $this->request->getQuery('program_id'); 

      $conditions['program_id'] = " AND Student.program_id = $program_id";

      $conditionsPrint .= '&program_id='.$program_id;

    }

    $conditions['year_term_id'] = "AND Student.year_term_id IS NULL";

    if ($this->request->getQuery('year_term_id')) {

      $year_term_id = $this->request->getQuery('year_term_id'); 

      $conditions['year_term_id'] = " AND Student.year_term_id = $year_term_id";

      $conditionsPrint .= '&year_term_id='.$year_term_id;

    }

    $conditions['college_id'] = " ";

    if ($this->request->getQuery('college_id')) {

      $college_id = $this->request->getQuery('college_id'); 

      $conditions['college_id'] = " AND Student.college_id = $college_id";

      $conditionsPrint .= '&college_id='.$college_id;

    }

    $conditions['section_id'] = " ";

    if ($this->request->getQuery('section_id')) {

      $section_id = $this->request->getQuery('section_id'); 

      $conditions['section_id'] = " AND StudentEnrolledCourse.section_id = $section_id";

      $conditionsPrint .= '&section_id='.$section_id;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllEnrollmentProfile($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'enrollment-profile'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $enrollment_profiles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($enrollment_profiles as $data) {


        $fullName = $data['last_name'] . ' ' . $data['first_name'] . ' ' . $data['middle_name']; // Concatenated full name

        $datas[] = array(

         'id'           =>        $data['id'],

         'student_no'   =>        $data['student_no'],

         'course'       =>        $data['course'],

         'name'         =>        $data ['name'],

         'section'      =>        $data ['section'],

         'email'        =>        $data ['email'],

         'fullname'     =>        $fullName,

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

  public function enrollment_list() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }


    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(StudentEnrollment.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startdate')) {

      $start = $this->request->getQuery('startdate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(StudentEnrollment.date) >= '$start' AND DATE(StudentEnrollment.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

   
    $conditions['year_term_id'] = "AND Student.year_term_id IS NULL";

    if ($this->request->getQuery('year_term_id')) {

      $year_term_id = $this->request->getQuery('year_term_id'); 

      $conditions['year_term_id'] = " AND Student.year_term_id = $year_term_id";

      $conditionsPrint .= '&year_term_id='.$year_term_id;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllEnrollmentList($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'enrollment-list'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $enrollment_profiles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($enrollment_profiles as $data) {

        $datas[] = array(

          'id'          => $data['id'],

          'student_name'   => $data['full_name'],

          'student_no'  => $data['student_no'],

          'college'     => $data['college'],

          'program'     => $data['program'],

          'date'        => fdate($data['date'],'m/d/Y'),

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

  public function academic_failures_list() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['college_id'] = '';

    if ($this->request->getQuery('collee_id')) {

      $college_id = $this->request->getQuery('college_id'); 

      $conditions['college_id'] = " AND Student.college_id = $college_id";

      $conditionsPrint .= '&college_id='.$college_id;

    }

    $conditions['college_program_id'] = "AND Student.program_id IS NULL";

    if ($this->request->getQuery('collee_program_id')) {

      $college_program_id = $this->request->getQuery('college_program_id'); 

      $conditions['college_program_id'] = " AND Student.program_id = $college_program_id";

      $conditionsPrint .= '&college_program_id='.$college_program_id;

    }

    $conditions['program_course_id'] = '';

    if ($this->request->getQuery('progrm_course_id')) {

      $program_course_id = $this->request->getQuery('program_course_id'); 

      $conditions['program_course_id'] = " AND StudentEnrolledCourse.course_id = $program_course_id";

      $conditionsPrint .= '&program_course_id='.$program_course_id;

    }

    $conditions['term'] = '';

    if ($this->request->getQuery('term')) {

      $term = $this->request->getQuery('term'); 

      if($term === 'midterm'){
        $conditions['term'] = " AND StudentEnrolledCourse.midterm_submitted = 1 AND StudentEnrolledCourse.midterm_grade > 3 ";
      }
      else if($term === 'finalterm'){
        $conditions['term'] = " AND StudentEnrolledCourse.finalterm_submitted = 1 AND StudentEnrolledCourse.finalterm_grade > 3 ";
      }
      else if($term === 'final'){
        $conditions['term'] = " AND StudentEnrolledCourse.final_grade > 3 ";
      }
      
      $conditionsPrint .= '&term='.$term;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllFailedStudent($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'academic-failures-list'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $enrollment_profiles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($enrollment_profiles as $data) {

        $datas[] = array(

          'student_no'   => $data['student_no'],

          'student_name'   => $data['full_name'],

          'remarks'   => 'FAILED',

          'year' => $data['year'],

          'semester' => $data['semester'],

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

  public function student_behavior() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(StudentBehavior.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(StudentBehavior.date) >= '$start' AND DATE(StudentBehavior.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }
    $conditions['program_id'] = '';

    if ($this->request->getQuery('program_id')) {

      $program_id = $this->request->getQuery('program_id'); 

      $conditions['program_id'] = " AND StudentBehavior.course_id = $program_id";

      $conditionsPrint .= '&program_id='.$program_id;

    }

    $conditions['year'] = "";


    if ($this->request->getQuery('year_term_id')) {

      $year = $this->request->getQuery('year_term_id'); 

      $conditions['year'] = " AND StudentBehavior.year_term_id = '$year' ";

      $conditionsPrint .= '&year='.$year;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllStudentBehavior($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'student-behavior'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $enrollment_profiles = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($enrollment_profiles as $data) {

        $datas[] = array(

            'id'          => $data['id'],

            'student_name'   => $data['student_name'],

            'student_no'  => $data['student_no'],

            'program'     => $data['program'],

            'behavior'     => $data['behavior'],

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


  //admission
  public function list_applicants() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }


    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(ScholarshipApplication.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startdate')) {

      $start = $this->request->getQuery('startdate'); 

      $end = $this->request->getQuery('endDate');

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

    $tmpData = $this->Reports->paginate($this->Reports->getAllListApplicant($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'list-applicant'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $list_applicant = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($list_applicant as $data) {

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

  public function list_checkouts() {

    //with pagination

    $page = $this->request->getQuery('page', 1);

    $conditions = array();
    
    $conditionsPrint = '';

    $conditions['search'] = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(CheckOut.date_borrowed) = '$search_date'"; 

      $conditionsPrint .= '&date='.$search_date;

    }

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(CheckOut.date_borrowed) >= '$start' AND DATE(CheckOut.date_borrowed) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }
    
    $limit = 25;

    $tmpData = $this->Reports->paginate($this->Reports->getAllCheckout($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions,

        'type'   => 'check-out'

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $checkout = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($checkout as $data) {

        $sub = $this->CheckOutSub->find()
        
          ->where([
            
            'visible' => 1,

            'check_out_id' => $data['id'],

          ])
        ->all();

        $datas[] = array(

        'id'                 => $data['id'],

        'library_id_number'  => $data['library_id_number'],

        'code'               => $data['code'],

        'member_name'        => $data['member_name'],

        'email'              => $data['email'],

        'date_borrowed'      => fdate($data['date_borrowed'],'m/d/Y'),

        'subs'                => $sub

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





}