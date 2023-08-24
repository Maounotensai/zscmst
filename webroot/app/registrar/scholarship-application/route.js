app.config(function ($routeProvider) {

$routeProvider

  .when("/admission/scholarship-application", {
  
    templateUrl: 'angularjs/views/registrar/scholarship-application/index',

    controller: "ScholarshipApplicationController",
 
  })

  .when("/admission/scholarship-application/add", {
  
    templateUrl: 'angularjs/views/registrar/scholarship-application/add.ctp',

    controller: "ScholarshipApplicationAddController",

  })

  .when("/admission/scholarship-application/edit/:id", {
 
    templateUrl: 'angularjs/views/registrar/scholarship-application/edit.ctp',

    controller: "ScholarshipApplicationEditController",

  })

  .when("/admission/scholarship-application/view/:id", {
 
    templateUrl: 'angularjs/views/registrar/scholarship-application/view.ctp',
 
    controller: "ScholarshipApplicationViewController",
 
  })

  .when("/admission/admin-scholarship-application", {
  
    templateUrl: 'angularjs/views/registrar/scholarship-application/admin-index.ctp',

    controller: "AdminScholarshipApplicationController",
 
  })

  .when("/admission/admin-scholarship-application/add", {
  
    templateUrl: 'angularjs/views/registrar/scholarship-application/admin-add.ctp',

    controller: "AdminScholarshipApplicationAddController",

  })

  .when("/admission/admin-scholarship-application/edit/:id", {
 
    templateUrl: 'angularjs/views/registrar/scholarship-application/admin-edit.ctp',

    controller: "AdminScholarshipApplicationEditController",

  })

  .when("/admission/admin-scholarship-application/view/:id", {
 
    templateUrl: 'angularjs/views/registrar/scholarship-application/admin-view.ctp',
 
    controller: "AdminScholarshipApplicationViewController",
 
  });

});
