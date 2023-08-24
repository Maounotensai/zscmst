app.config(function ($routeProvider) {
  $routeProvider

    .when("/registrar/club", {
      templateUrl:
        tmp + "registrar__club__index",

      controller: "ClubController",
    })

    .when("/registrar/club/add", {
      templateUrl: tmp + "registrar__club__add",

      controller: "ClubAddController",
    })

    .when("/registrar/club/edit/:id", {
      templateUrl:
        tmp + "registrar__club__edit",

      controller: "ClubEditController",
    })

    .when("/registrar/club/view/:id", {
      templateUrl:
        tmp + "registrar__club__view",

      controller: "ClubViewController",
    });
});
