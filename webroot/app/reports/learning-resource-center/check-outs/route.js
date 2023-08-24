app.config(function($routeProvider) {

  $routeProvider

  .when('/reports/learning-resource-center/check-outs/index', {

    templateUrl: tmp + 'reports__learning_resource_center__check_outs__index',

    controller: 'ReportCheckOutController',

  })

});