app.config(function($routeProvider) {

  $routeProvider

  .when('/backup', {

    templateUrl: tmp + 'backup__index',

    controller: 'BackupController',

  });
  
});