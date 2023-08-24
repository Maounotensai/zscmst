app.config(function ($routeProvider) {

  $routeProvider

  .when("/medical-services/consultation", {

    templateUrl: 'angularjs/views/medical-services/consultation/index.ctp',

    controller: "ConsultationController",

  })

  .when("/medical-services/consultation/add", {

    templateUrl: 'angularjs/views/medical-services/consultation/add.ctp',

    controller: "ConsultationAddController",

  })

  .when("/medical-services/consultation/edit/:id", {

    templateUrl: 'angularjs/views/medical-services/consultation/edit.ctp',

    controller: "ConsultationEditController",

  })

  .when("/medical-services/consultation/view/:id", {

    templateUrl: 'angularjs/views/medical-services/consultation/view.ctp',

    controller: "ConsultationViewController",

  })

  .when("/medical-services/consultation/student-index", {

    templateUrl: tmp + "medical_services__consultation__student_index",

    controller: "StudentConsultationController",

  })

  .when("/medical-services/consultation/student-add", {

    templateUrl: tmp + "medical_services__consultation__student_add",

    controller: "StudentConsultationAddController",

  })

  .when("/medical-services/consultation/student-edit/:id", {

    templateUrl: tmp + "medical_services__consultation__student_edit",

    controller: "StudentConsultationEditController",

  })

  .when("/medical-services/consultation/student-view/:id", {

    templateUrl: tmp + "medical_services__consultation__student_view",

    controller: "StudentConsultationViewController",

  });
  
});
