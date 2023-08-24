app.config(function($routeProvider) {

  $routeProvider

  .when('/block-section', {

    templateUrl: tmp + 'block_section__index',

    controller: 'BlockSectionController',

  })

  .when('/block-section/add', {

    templateUrl: tmp + 'block_section__add',

    controller: 'BlockSectionAddController',

  })

  .when('/block-section/edit/:id', {

    templateUrl: tmp + 'block_section__edit',

    controller: 'BlockSectionEditController',

  })

  .when('/block-section/view/:id', {

    templateUrl: tmp + 'block_section__view',

    controller: 'BlockSectionViewController',

  })

  .when('/block-section/view-schedule/:id', {

    templateUrl: tmp + 'block_section__view_schedule',

    controller: 'BlockSectionScheduleViewController',

  });
  
});