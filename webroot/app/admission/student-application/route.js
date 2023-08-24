app.config(function($routeProvider) {

  $routeProvider

  .when('/admission/student-application', {

    templateUrl: tmp + 'admission__student_application__index',

    controller: 'StudentApplicationController',

  })

  .when('/admission/student-application/add', {

    templateUrl: tmp + 'admission__student_application__add',

    controller: 'StudentApplicationAddController',

  })

  .when('/admission/student-application/edit/:id', {

    templateUrl: tmp + 'admission__student_application__edit',

    controller: 'StudentApplicationEditController',

  })

  .when('/admission/student-application/view/:id', {

    templateUrl: tmp + 'admission__student_application__view',

    controller: 'StudentApplicationViewController',

  });
  
});