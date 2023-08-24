app.config(function($routeProvider) {

  $routeProvider

  .when('/corporate-affairs/apartelle', {

    templateUrl: 'angularjs/views/apartelle/index.ctp',

    controller: 'ApartelleController',

  })

  .when('/corporate-affairs/apartelle/add', {

    templateUrl: 'angularjs/views/apartelle/add.ctp',

    controller: 'ApartelleAddController',

  })

  .when('/corporate-affairs/apartelle/edit/:id', {

    templateUrl: 'angularjs/views/apartelle/edit.ctp',

    controller: 'ApartelleEditController',

  })

  .when('/corporate-affairs/apartelle/view/:id', {

    templateUrl: 'angularjs/views/apartelle/view.ctp',

    controller: 'ApartelleViewController',

  });
  
});