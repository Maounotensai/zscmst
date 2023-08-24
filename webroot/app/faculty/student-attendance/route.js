app.config(function($routeProvider) {

  $routeProvider

  .when('/faculty/student-attendance', {

    templateUrl: tmp + 'faculty__student_attendance__index',

    controller: 'StudentAttendanceController',

  })

  .when('/faculty/student-attendance/add/:id/:sub_id/:course_id', {

    templateUrl: tmp + 'faculty__student_attendance__add',

    controller: 'StudentAttendanceAddController',

  })

  .when('/faculty/student-attendance/view-attendance/:id/:sub_id/:course_id', {

    templateUrl: tmp + 'faculty__student_attendance__view_attendance',

    controller: 'StudentAttendanceViewDetailController',

  })

  .when('/faculty/student-attendance/edit/:id', {

    templateUrl: tmp + 'faculty__student_attendance__edit',

    controller: 'StudentAttendanceEditController',

  })

 .when('/faculty/student-attendance/view/:id', {

    templateUrl: tmp + 'faculty__student_attendance__view',

    controller: 'StudentAttendanceViewController',

  }); 

});


