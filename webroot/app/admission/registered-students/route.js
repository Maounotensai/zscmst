app.config(function($routeProvider) {

  $routeProvider

  .when('/admission/registered-students', {

    templateUrl: tmp + 'admission__registered_students__index',

    controller: 'RegisteredStudentController',

  })

  .when("/admission/registered-students/view/:id", {
 
    templateUrl: tmp + "admission__registered_students__view",
 
    controller: "RegisteredStudentViewController",
 
  });
  
});