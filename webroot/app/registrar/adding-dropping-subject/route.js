

app.config(function($routeProvider) {

  $routeProvider
  .when('/registrar/adding-dropping-subject', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__index',

    controller: 'AddingDroppingSubjectController',

  })

  .when('/registrar/adding-dropping-subject/add', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__add',

    controller: 'AddingDroppingSubjectAddController',

  })

  .when('/registrar/adding-dropping-subject/edit/:id', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__edit',

    controller: 'AddingDroppingSubjectEditController',

  })

  .when('/registrar/adding-dropping-subject/view/:id', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__view',

    controller: 'AddingDroppingSubjectViewController',

  })


  .when('/registrar/admin-adding-dropping-subject', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__admin_index',

    controller: 'AdminAddingDroppingSubjectController',

  })

  .when('/registrar/admin-adding-dropping-subject/add', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__admin_add',

    controller: 'AdminAddingDroppingSubjectAddController',

  })

  .when('/registrar/admin-adding-dropping-subject/edit/:id', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__admin_edit',

    controller: 'AdminAddingDroppingSubjectEditController',

  })

  .when('/registrar/admin-adding-dropping-subject/view/:id', {

    templateUrl: tmp + 'registrar__adding_dropping_subject__admin_view',

    controller: 'AdminAddingDroppingSubjectViewController'

  });

  

  
});