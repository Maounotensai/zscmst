app.config(function($routeProvider) {

  $routeProvider

  .when('/admission/transferee', {

    templateUrl: tmp + 'admission__transferee__index',

    controller: 'TransfereeController',

  })

  .when('/admission/transferee/add', {

    templateUrl: tmp + 'admission__transferee__add',

    controller: 'TransfereeAddController',

  })

  .when('/admission/transferee/edit/:id', {

    templateUrl: tmp + 'admission__transferee__edit',

    controller: 'TransfereeEditController',

  })

  .when('/admission/transferee/view/:id', {

    templateUrl: tmp + 'admission__transferee__view',

    controller: 'TransfereeViewController',

  });
  
});