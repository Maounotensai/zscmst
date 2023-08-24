app.config(function($routeProvider) {

  $routeProvider

  .when('/cashier/payment', {

    templateUrl: tmp + 'cashier__payment__index',

    controller: 'PaymentController',

  })

  .when("/cashier/payment/add/", {
 
    templateUrl: tmp + "cashier__payment__add",
 
    controller: "PaymentAddController",
 
  })

  .when("/cashier/payment/view/:id", {
 
    templateUrl: tmp + "cashier__payment__view",
 
    controller: "PaymentViewController",
 
  })

  .when("/cashier/payment/edit/:id", {
 
    templateUrl: tmp + "cashier__payment__edit",
 
    controller: "PaymentEditController",
 
  });
  
});