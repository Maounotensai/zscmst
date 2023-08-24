app.config(function($routeProvider) {

  $routeProvider

  .when('/student-ledger', {

    templateUrl: tmp + 'student_ledger__index',

    controller: 'StudentLedgerController',

  });

});


