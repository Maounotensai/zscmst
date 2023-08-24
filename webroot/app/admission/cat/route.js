app.config(function($routeProvider) {

  $routeProvider

  .when('/admission/cat', {

    templateUrl: tmp + 'admission__cat__index',

    controller: 'CatController',

  })

  .when("/admission/cat/view/:id", {
 
    templateUrl: tmp + "admission__cat__view",
 
    controller: "CatViewController",
 
  });
  
});