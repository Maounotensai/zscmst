app.config(function($routeProvider) {

  $routeProvider

  .when('/reports/medical-services/monthly-accomplishment', {

    templateUrl: tmp + 'reports__medical_services__monthly_accomplishment',

    controller: 'MedicalMonthlyAccomplishmentController',

  })

  .when('/reports/medical-services/monthly-consumption', {

    templateUrl: tmp + 'reports__medical_services__monthly_consumption',

    controller: 'MedicalMonthlyConsumptionController',

  })

  .when('/reports/medical-services/daily-treatments', {

    templateUrl: tmp + 'reports__medical_services__daily_treatments',

    controller: 'MedicalDailyTreatmentController',

  })

  .when('/reports/medical-services/property-equipment', {

    templateUrl: tmp + 'reports__medical_services__property_equipment',

    controller: 'PropertyEquimentReportController',

  })

});