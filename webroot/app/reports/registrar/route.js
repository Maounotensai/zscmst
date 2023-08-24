app.config(function($routeProvider) {

  $routeProvider

  .when('/reports/registrar/subject-masterlists', {

    templateUrl: tmp + 'reports__registrar__subject_masterlists',

    controller: 'SubjectMasterlistController',

  })

  .when('/reports/registrar/enrollment-list', {

    templateUrl: tmp + 'reports__registrar__enrollment_list',

    controller: 'EnrollmentListReportController',

  })

  .when('/reports/registrar/student-masterlist', {

    templateUrl: tmp + 'reports__registrar__student_masterlist',

    controller: 'ListStudentController',

  })

  .when('/reports/registrar/student-ranking', {

    templateUrl: tmp + 'reports__registrar__student_ranking',

    controller: 'StudentRankingController',

  })

  .when('/reports/registrar/promoted-student', {

    templateUrl: tmp + 'reports__registrar__promoted_student',

    controller: 'PromotedStudentController',

  })

  .when('/reports/registrar/student-behavior', {

    templateUrl: tmp + 'reports__registrar__student_behavior',

    controller: 'StudentBehaviorReportController',

  })

  .when('/reports/registrar/academic-failures-list', {

    templateUrl: tmp + 'reports__registrar__academic_failures_list', 

    controller: 'AcademicFailuresListController', 

  })

  .when('/reports/registrar/student-club-list', {

    templateUrl: tmp + 'reports__registrar__student_club_list', 

    controller: 'StudentClubListController', 

  })

  .when('/reports/registrar/academic-list', {

    templateUrl: tmp + 'reports__registrar__academic_list',

    controller: 'AcademicListController',

  })
  
  .when('/reports/registrar/list-academic-awardees', {

    templateUrl: tmp + 'reports__registrar__list_academic_awardees',

    controller: 'ListAcademicAwardeeController',

  })

  .when('/reports/registrar/gwa', {

    templateUrl: tmp + 'reports__registrar__gwa',

    controller: 'GWAController',

  })

  .when('/reports/registrar/enrollment-profile', {

    templateUrl: tmp + 'reports__registrar__enrollment_profile',

    controller: 'EnrollmentProfileController',

  })


});