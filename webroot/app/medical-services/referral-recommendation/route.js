app.config(function($routeProvider) {

  $routeProvider

  .when('/medical-services/referral-recommendation', {

    templateUrl: 'angularjs/views/medical-services/referral-recommendation/index.ctp',

    controller: 'ReferralRecommendationController',

  })

  .when('/medical-services/referral-recommendation/add', {

    templateUrl: 'angularjs/views/medical-services/referral-recommendation/add.ctp',

    controller: 'ReferralRecommendationAddController',

  })

  .when('/medical-services/referral-recommendation/edit/:id', {

    templateUrl: 'angularjs/views/medical-services/referral-recommendation/edit.ctp',

    controller: 'ReferralRecommendationEditController',

  })

  .when('/medical-services/referral-recommendation/view/:id', {

    templateUrl: 'angularjs/views/medical-services/referral-recommendation/view.ctp',

    controller: 'ReferralRecommendationViewController',

  })
  // .when("/medical-services/referral-recommendation/student-index", {
  //   templateUrl: tmp + "medical_services__referral_recommendation__student_index",

  //   controller: "StudentReferralRecommendationController",
  // })

  // .when("/medical-services/referral-recommendation/student-add", {
  //   templateUrl: tmp + "medical_services__referral_recommendation__student_add",

  //   controller: "StudentReferralRecommendationAddController",
  // })

  // .when("/medical-services/referral-recommendation/student-edit/:id", {
  //   templateUrl: tmp + "medical_services__referral_recommendation__student_edit",

  //   controller: "StudentReferralRecommendationEditController",
  // })

  // .when("/medical-services/referral-recommendation/student-view/:id", {
  //   templateUrl: tmp + "medical_services__referral_recommendation__student_view",

  //   controller: "StudentReferralRecommendationViewController",
  // })
  ;
  
});