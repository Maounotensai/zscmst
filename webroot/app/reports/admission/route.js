app.config(function($routeProvider) {

  $routeProvider

  .when('/reports/admission/list-students', {

    templateUrl: 'angularjs/views/reports/admission/list-students.ctp',

    controller: 'ListStudentController',

  })

  .when('/reports/admission/list-of-applicants', {

    templateUrl: 'angularjs/views/reports/admission/list-of-applicants.ctp',

    controller: 'ListApplicantsController',

  })

    .when("/reports/admission/scholarship-evaluations", {
  
    templateUrl: 'angularjs/views/reports/admission/scholarship-evaluations.ctp',

    controller: "ScholarshipEvaluationsController",
 
  })

});