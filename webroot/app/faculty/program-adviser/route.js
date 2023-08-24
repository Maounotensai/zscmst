app.config(function($routeProvider) {

  $routeProvider

  .when('/faculty/program-adviser', {

    templateUrl: tmp + 'faculty__program_adviser__index',

    controller: 'ProgramAdviserController',

  })

 .when('/faculty/program-adviser/view/:id', {

    templateUrl: tmp + 'faculty__program_adviser__view',

    controller: 'ProgramAdviserViewController',

  });

});


