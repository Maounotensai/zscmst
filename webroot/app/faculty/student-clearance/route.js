app.config(function ($routeProvider) {

  $routeProvider

  .when("/faculty/student-clearance", {

    templateUrl: 'angularjs/views/faculty/student-clearance/index.ctp',

    controller: "StudentClearanceController",

  })

  .when("/faculty/student-clearance/add", {

    templateUrl: 'angularjs/views/faculty/student-clearance/add.ctp',

    controller: "StudentClearanceAddController",

  })

  .when("/faculty/student-clearance/edit/:id", {

    templateUrl: 'angularjs/views/faculty/student-clearance/edit.ctp',

    controller: "StudentClearanceEditController",

  })

  .when("/faculty/student-clearance/view/:id", {

    templateUrl: 'angularjs/views/faculty/student-clearance/view.ctp',

    controller: "StudentClearanceViewController",

  })

  .when("/faculty/student-clearance/faculty-index", {

    templateUrl: tmp + "faculty__student_clearance__faculty_index",

    controller: "StudentClearanceController",

  })

  .when("/faculty/student-clearance/faculty-add", {

    templateUrl: tmp + "faculty__student_clearance__faculty_add",

    controller: "StudentClearanceFacultyAddController",

  })

  .when("/faculty/student-clearance/faculty-view/:id", {

    templateUrl: tmp + "faculty__student_clearance__faculty_view",

    controller: "StudentClearanceFacultyViewController",

  })

  .when("/faculty/student-clearance/dean-index", {

    templateUrl: tmp + "faculty__student_clearance__dean_index",

    controller: "StudentClearanceController",

  })

  .when("/faculty/student-clearance/dean-add", {

    templateUrl: tmp + "faculty__student_clearance__dean_add",

    controller: "StudentClearanceDeanAddController",

  })

  .when("/faculty/student-clearance/dean-view/:id", {

    templateUrl: tmp + "faculty__student_clearance__dean_view",

    controller: "StudentClearanceDeanViewController",

  });

});
