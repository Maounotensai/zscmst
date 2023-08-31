app.config(function($routeProvider) {

  $routeProvider

  .when('/registrar/prospectus', {

    templateUrl: 'angularjs/views/registrar/prospectus/index.ctp',

    controller: 'ProspectusController',

  })

  .when("/registrar/prospectus/view/:id", {
 
    templateUrl: "angularjs/views/registrar/prospectus/view.ctp",
 
    controller: "ProspectusViewController",
 
  })

  .when("/registrar/prospectus/view-student/:id", {
 
    templateUrl: "angularjs/views/registrar/prospectus/view-student.ctp",
 
    controller: "ProspectusStudentViewController",
 
  });
  
});