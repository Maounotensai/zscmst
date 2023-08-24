app.config(function ($routeProvider) {

$routeProvider

  .when("/admission/scholarship-application", {
  
    templateUrl: tmp + "admission__scholarship_application__index",

    controller: "ScholarshipApplicationController",
 
  })

  .when("/admission/scholarship-application/add", {
  
    templateUrl: tmp + "admission__scholarship_application__add",

    controller: "ScholarshipApplicationAddController",

  })

  .when("/admission/scholarship-application/edit/:id", {
 
    templateUrl: tmp + "admission__scholarship_application__edit",

    controller: "ScholarshipApplicationEditController",

  })

  .when("/admission/scholarship-application/view/:id", {
 
    templateUrl: tmp + "admission__scholarship_application__view",
 
    controller: "ScholarshipApplicationViewController",
 
  })

  .when("/admission/admin-scholarship-application", {
  
    templateUrl: tmp + "admission__scholarship_application__admin_index",

    controller: "AdminScholarshipApplicationController",
 
  })

  .when("/admission/admin-scholarship-application/add", {
  
    templateUrl: tmp + "admission__scholarship_application__admin_add",

    controller: "AdminScholarshipApplicationAddController",

  })

  .when("/admission/admin-scholarship-application/edit/:id", {
 
    templateUrl: tmp + "admission__scholarship_application__admin_edit",

    controller: "AdminScholarshipApplicationEditController",

  })

  .when("/admission/admin-scholarship-application/view/:id", {
 
    templateUrl: tmp + "admission__scholarship_application__admin_view",
 
    controller: "AdminScholarshipApplicationViewController",
 
  });

});
