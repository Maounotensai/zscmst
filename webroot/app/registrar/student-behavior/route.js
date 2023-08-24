app.config(function($routeProvider) {

  $routeProvider

  .when('/registrar/student-behavior', {

    templateUrl: 'angularjs/views/registrar/student-behavior/index.ctp',

    controller: 'StudentBehaviorController',

  })

   .when('/registrar/student-behavior/add', {

    templateUrl: 'angularjs/views/registrar/student-behavior/add.ctp',

    controller: 'StudentBehaviorAddController',

  })

  .when('/registrar/student-behavior/edit/:id', {

    templateUrl: 'angularjs/views/registrar/student-behavior/edit.ctp',

    controller: 'StudentBehaviorEditController',

  })

  .when('/registrar/student-behavior/view/:id', {

    templateUrl: 'angularjs/views/registrar/student-behavior/view.ctp',

    controller: 'StudentBehaviorViewController',

  })

});