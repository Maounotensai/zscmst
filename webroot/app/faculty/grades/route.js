app.config(function($routeProvider) {

  $routeProvider

  .when('/faculty/grades', {

    templateUrl: tmp + 'faculty__grades__index',

    controller: 'GradeController',

  })

  .when('/faculty/grades/add', {

    templateUrl: tmp + 'faculty__grades__add',

    controller: 'GradeAddController',

  })

  .when('/faculty/grades/edit/:id', {

    templateUrl: tmp + 'faculty__grades__edit',

    controller: 'GradeEditController',

  })

 .when('/faculty/grades/view/:id', {

    templateUrl: tmp + 'faculty__grades__view',

    controller: 'GradeViewController',

  });

});


