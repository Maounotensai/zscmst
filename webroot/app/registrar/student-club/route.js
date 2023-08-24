app.config(function($routeProvider) {

  $routeProvider

  .when('/registrar/student-club', {

    templateUrl: tmp + 'registrar__student_club__index',

    controller: 'StudentClubController',

  })

  .when('/registrar/student-club/add', {

    templateUrl: tmp + 'registrar__student_club__add',

    controller: 'StudentClubAddController',

  })

  .when('/registrar/student-club/edit/:id', {

    templateUrl: tmp + 'registrar__student_club__edit',

    controller: 'StudentClubEditController',

  })

  .when('/registrar/student-club/view/:id', {

    templateUrl: tmp + 'registrar__student_club__view',

    controller: 'StudentClubViewController',

  })

  .when('/registrar/admin-student-club', {

    templateUrl: tmp + 'registrar__student_club__admin_index',

    controller: 'AdminStudentClubController',

  })

  .when('/registrar/admin-student-club/add', {

    templateUrl: tmp + 'registrar__student_club__admin_add',

    controller: 'AdminStudentClubAddController',

  })

    .when('/registrar/admin-student-club/edit/:id', {

    templateUrl: tmp + 'registrar__student_club__admin_edit',

    controller: 'AdminStudentClubEditController',

  })

    .when('/registrar/admin-student-club/view/:id', {

    templateUrl: tmp + 'registrar__student_club__admin_view',

    controller: 'AdminStudentClubViewController',

  });
  
});