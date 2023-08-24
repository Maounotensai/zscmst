app.config(function($routeProvider) {

  $routeProvider

  .when('/reports/admission/list-students', {

    templateUrl: tmp + 'reports__admission__list_students',

    controller: 'ListStudentController',

  })

  .when('/reports/admission/list-of-applicants', {

    templateUrl: tmp + 'reports__admission__list_of_applicants',

    controller: 'ListApplicantsController',

  })

    .when("/reports/admission/scholarship-evaluations", {
  
    templateUrl: tmp + "reports__admission__scholarship_evaluations",

    controller: "ScholarshipEvaluationsController",
 
  })

});