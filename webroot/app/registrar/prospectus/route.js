app.config(function($routeProvider) {

  $routeProvider

  .when('/registrar/prospectus', {

    templateUrl: tmp + 'registrar__prospectus__index',

    controller: 'ProspectusController',

  })

  .when("/registrar/prospectus/view/:id", {
 
    templateUrl: tmp + "registrar__prospectus__view",
 
    controller: "ProspectusViewController",
 
  })

  .when("/registrar/prospectus/view-student/:id", {
 
    templateUrl: tmp + "registrar__prospectus__view_student",
 
    controller: "ProspectusStudentViewController",
 
  });
  
});