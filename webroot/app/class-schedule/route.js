app.config(function($routeProvider) {

  $routeProvider

  .when('/class-schedule', {

    templateUrl: tmp + 'class_schedule__index',

    controller: 'ClassScheduleController',

  })

 .when('/class-schedule/add', {

   templateUrl: tmp + 'class_schedule__add',

  controller: 'ClassScheduleAddController',

 })

 .when('/class-schedule/edit/:id', {

   templateUrl: tmp + 'class_schedule__edit',

   controller: 'ClassScheduleEditController',

  })

 .when('/class-schedule/view/:id', {

    templateUrl: tmp + 'class_schedule__view',

    controller: 'ClassScheduleViewController',

  });

});


