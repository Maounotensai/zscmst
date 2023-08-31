<?php
	/**
	* Routes configuration.
	*
	* In this file, you set up routes to your controllers and their actions.
	* Routes are very important mechanism that allows you to freely connect
	* different URLs to chosen controllers and their actions (functions).
	*
	* It's loaded within the context of `Application::routes()` method which
	* receives a `RouteBuilder` instance `$routes` as method argument.
	*
	* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
	* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
	*
	* Licensed under The MIT License
	* For full copyright and license information, please see the LICENSE.txt
	* Redistributions of files must retain the above copyright notice.
	*
	* @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
	* @link          https://cakephp.org CakePHP(tm) Project
	* @license       https://opensource.org/licenses/mit-license.php MIT License
	*/

	use Cake\Routing\Route\DashedRoute;
	use Cake\Routing\RouteBuilder;

	return static function (RouteBuilder $routes) {

	  $routes->setRouteClass(DashedRoute::class);

	  $routes->scope('/', function (RouteBuilder $builder) {
	   
	    $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'login']);

	    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

	    $builder->connect('/logout', ['controller' => 'Main', 'action' => 'logout']);

	    $builder->fallbacks();

	  });

    $routes->prefix('api', function (RouteBuilder $routes) {
	     
      $routes->connect('/select', ['controller' => 'Select']);

      //sir raymond
      $routes->resources('Buildings');

      $routes->resources('Permissions');

      $routes->resources('Roles');

      $routes->resources('LearningResourceMembers');

      $routes->resources('VisitorsAlumnis');

      $routes->resources('MaterialTypes');

      $routes->resources('CollectionTypes');

      $routes->resources('Bibliographies');

      $routes->resources('InventoryBibliographies');

      $routes->connect('/inventory_bibliographies/manual', ['controller' => 'InventoryBibliographies', 'action' => 'api_manual']);

      $routes->connect('/inventory_bibliographies/manual/:id', ['controller' => 'InventoryBibliographies', 'action' => 'api_manual']);

      $routes->connect('/inventory_bibliographies/manual_delete/:id', ['controller' => 'InventoryBibliographies', 'action' => 'api_manual_delete']);

      $routes->resources('CheckOuts');

      $routes->resources('CheckIns');

      $routes->resources('IllnessRecommendations');

      $routes->resources('PropertyLogs');

      $routes->connect('/property_logs/manual', ['controller' => 'PropertyLogs', 'action' => 'api_manual']);

      $routes->connect('/property_logs/manual/:id', ['controller' => 'PropertyLogs', 'action' => 'api_manual']);

      $routes->connect('/property_logs/manual_delete/:id', ['controller' => 'PropertyLogs', 'action' => 'api_manual_delete']);

      $routes->resources('Consultations');

      $routes->resources('StudentApplications');


      //sir raff

      $routes->resources('Accounts');

      $routes->resources('OfficeReferences');

      $routes->resources('NurseProfiles');

      $routes->resources('Settings');

      $routes->resources('Apartelles');

      $routes->resources('GoodMorals');

      $routes->resources('Prescriptions');

      $routes->resources('UserLogs');

      $routes->resources('MedicalEmployeeProfiles');

      $routes->resources('ReferralRecommendations');

      $routes->resources('ItemIssuances');

      $routes->resources('MedicalCertificates');

      $routes->resources('StudentLogs');

      $routes->resources('ApartelleRegistrations');

      $routes->resources('Prospectuses');



      //sir leo

      $routes->resources('ScholarshipNames', ['path' => 'scholarship_names']);

	 		$routes->resources('Schools');

	 		$routes->resources('Employees');

	 		$routes->resources('FacultyClearances');

	 		$routes->resources('StudentClearances');

	 		$routes->resources('CounselingTypes');

	 		$routes->resources('Affidavits');

	 		$routes->resources('PromissoryNotes');

	 		$routes->resources('ReferralSlips');

	 		$routes->resources('AppointmentSlips');

	 		$routes->resources('CalendarActivities');

	 		$routes->resources('CounselingIntakes');

	 		$routes->resources('ParticipantEvaluationActivities');

	 		$routes->resources('StudentExits');

	 		$routes->resources('GcoEvaluations');

	 		$routes->resources('Sections');

	    $routes->resources('Colleges');

	    $routes->resources('CollegePrograms');

	    $routes->connect('/college_programs/course', ['controller' => 'CollegePrograms', 'action' => 'course']);

	    $routes->connect('/college_programs/course_view/:id', ['controller' => 'CollegePrograms', 'action' => 'course_view']);

	    $routes->connect('/college_programs/course_update/:id', ['controller' => 'CollegePrograms', 'action' => 'course_update']);

	    $routes->connect('/college_programs/course_delete', ['controller' => 'CollegePrograms', 'action' => 'course_delete']);

	    $routes->resources('Courses'); 


	    //czyd

      $routes->resources('Users');

      $routes->resources('RequestForms');

     	$routes->resources('Majors');

      $routes->resources('Rooms');

      $routes->resources('Users');

      $routes->resources('UserPermissions');

      $routes->resources('Admins');

      $routes->resources('AttendanceCounselings');

      $routes->resources('CounselingAppointments');

      $routes->resources('ScholarshipApplications');

      $routes->resources('ScholarshipNames');

      $routes->resources('StudentBehaviors');

      $routes->resources('AwardManagements');

      $routes->resources('AwardeeManagements');

      $routes->resources('Completions');

      $routes->resources('Students');

      $routes->resources('Dentals');

      $routes->connect('/reports/faculty_masterlists', ['controller' => 'Reports', 'action' => 'faculty_masterlists']);

      $routes->connect('/reports/enrollment_profiles', ['controller' => 'Reports', 'action' => 'enrollment_profiles']);

      $routes->connect('/reports/enrollment_list', ['controller' => 'Reports', 'action' => 'enrollment_list']);

      $routes->connect('/reports/academic_failures_list', ['controller' => 'Reports', 'action' => 'academic_failures_list']);

      $routes->connect('/reports/student_behavior', ['controller' => 'Reports', 'action' => 'student_behavior']);

      $routes->connect('/reports/list_applicants', ['controller' => 'Reports', 'action' => 'list_applicants']);

      $routes->connect('/reports/list_checkouts', ['controller' => 'Reports', 'action' => 'list_checkouts']);



      // Other routes
      $routes->fallbacks();

	  });

	  Router::extensions(['json', 'pdf']);

	};
