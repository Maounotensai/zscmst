app.controller("StudentClearanceController", function ($scope, StudentClearance) {

  $scope.today = Date.parse("today").toString("MM/dd/yyyy");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $scope.load = function (options) {

    options = typeof options !== "undefined" ? options : {};

    StudentClearance.query(options, function (e) {

      if (e.ok) {

        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);

      }

    });

  };

  $scope.load();

  $scope.reload = function (options) {

    $scope.search = {};

    $scope.searchTxt = "";

    $scope.dateToday = null;

    $scope.startDate = null;

    $scope.endDate = null;

    $scope.load();

  };

  $scope.searchy = function (search) {

    search = typeof search !== "undefined" ? search : "";

    if (search.length > 0) {

      $scope.load({

        search: search,

      });

    } else {

      $scope.load();

    }

  };

  $scope.remove = function (data) {

    bootbox.confirm("Are you sure you want to delete " + data.code + " ?",function (c) {

      if (c) {

        StudentClearance.remove({ id: data.id }, function (e) {

          if (e.ok) {

            $.gritter.add({

              title: "Successful!",

              text: e.msg,

            });

            $scope.load();

          }

        });

      }

    });

  };

  $scope.print = function () {

    date = "";

    if ($scope.conditionsPrint !== "") {

      printTable(

        base + "print/student_clearance?print=1" + $scope.conditionsPrint

      );

    } else {

      printTable(base + "print/student_clearance?print=1");

    }

  };

});

app.controller("StudentClearanceAddController", function ($scope, StudentClearance, Select) {

  $("#form").validationEngine("attach");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $(".clockpicker").clockpicker({

    donetext: "Done",

    twelvehour: true,

    placement: "bottom",

  });

  $scope.data = {

    StudentClearance: {},

  };

  Select.get({ code: "student-clearance-code" }, function (e) {

    $scope.data.StudentClearance.code = e.data;

  });

  // Select.get({ code: "course-list" }, function (e) {

  //   $scope.course = e.data;

  // });

  Select.get({code: 'college-program-list-all'}, function(e) {

    $scope.college_program = e.data;

  });

  $scope.searchStudent = function (options) {

    options = typeof options !== "undefined" ? options : {};

    options["code"] = "search-student";

    Select.query(options, function (e) {

      $scope.students = e.data.result;

      $scope.student = {};

      // paginator

      $scope.paginator = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal("show");

    });

  };

  $scope.selectedStudent = function (student) {

    $scope.student = {

      id: student.id,

      code: student.code,

      name: student.name,

    };

  };

  $scope.studentData = function (id) {

    $scope.data.StudentClearance.student_id = $scope.student.id;

    $scope.data.StudentClearance.student_name = $scope.student.name;

    $scope.data.StudentClearance.student_no = $scope.student.code;

  };

  $scope.save = function () {

    valid = $("#form").validationEngine("validate");

    if (valid) {

      StudentClearance.save($scope.data, function (e) {

        if (e.ok) {

          $.gritter.add({

            title: "Successful!",

            text: e.msg,

          });

          window.location = "#/faculty/student-clearance";

        } else {

          $.gritter.add({

            title: "Warning!",

            text: e.msg,

          });

        }

      });

    }

  };

});

app.controller("StudentClearanceViewController", function ($scope, $routeParams, StudentClearance) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load

  $scope.load = function () {

    StudentClearance.get({ id: $scope.id }, function (e) {

      $scope.data = e.data;

    });

  };

  $scope.load();

  $scope.print = function (id) {

    printTable(base + "print/student_clearance_form/" + id);

  };

  // remove
  $scope.remove = function (data) {

    bootbox.confirm("Are you sure you want to remove " + data.code + " ?",function (c) {

      if (c) {

        StudentClearance.remove({ id: data.id }, function (e) {

          if (e.ok) {

            $.gritter.add({

              title: "Successful!",

              text: e.msg,

            });

            window.location = "#/faculty/student-clearance";
          }

        });

      }

    });

  };

});

app.controller("StudentClearanceEditController", function ($scope, $routeParams, StudentClearance, Select) {

  $scope.id = $routeParams.id;

  $("#form").validationEngine("attach");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $(".clockpicker").clockpicker({

    donetext: "Done",

    twelvehour: true,

    placement: "bottom",

  });

  $scope.data = {

    StudentClearance: {},

  };

  // Select.get({ code: "course-list" }, function (e) {

  //   $scope.course = e.data;

  // });

  Select.get({code: 'college-program-list-all'}, function(e) {

    $scope.college_program = e.data;

  });

  // load

  $scope.load = function () {

    StudentClearance.get({ id: $scope.id }, function (e) {

      $scope.data = e.data;

    });

  };

  $scope.searchStudent = function (options) {

    options = typeof options !== "undefined" ? options : {};

    options["code"] = "search-student";

    Select.query(options, function (e) {

      $scope.students = e.data.result;

      $scope.student = {};

      // paginator

      $scope.paginator = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal("show");

    });

  };

  $scope.selectedStudent = function (student) {

    $scope.student = {

      id: student.id,

      code: student.code,

      name: student.name,

    };

  };

  $scope.studentData = function (id) {

    $scope.data.StudentClearance.student_id = $scope.student.id;

    $scope.data.StudentClearance.student_name = $scope.student.name;

    $scope.data.StudentClearance.student_no = $scope.student.code;

  };

  $scope.load();

  $scope.update = function () {

    valid = $("#form").validationEngine("validate");

    if (valid) {

      StudentClearance.update({ id: $scope.id }, $scope.data, function (e) {

        if (e.ok) {

          $.gritter.add({

            title: "Successful!",

            text: e.msg,

          });

          window.location = "#/faculty/student-clearance";

        } else {

          $.gritter.add({

            title: "Warning!",

            text: e.msg,

          });

        }

      });

    }

  };

});

app.controller("StudentClearanceFacultyAddController", function ($scope, StudentClearance, Select) {

  $("#form").validationEngine("attach");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $(".clockpicker").clockpicker({

    donetext: "Done",

    twelvehour: true,

    placement: "bottom",

  });

  $scope.data = {

    StudentClearance: {},

  };

  Select.get({ code: "student-clearance-code" }, function (e) {

    $scope.data.StudentClearance.code = e.data;

  });

  Select.get({ code: "course-list" }, function (e) {

    $scope.course = e.data;

  });

  $scope.searchStudent = function (options) {

    options = typeof options !== "undefined" ? options : {};

    options["code"] = "search-student";

    Select.query(options, function (e) {

      $scope.students = e.data.result;

      $scope.student = {};

      // paginator

      $scope.paginator = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal("show");

    });

  };

  $scope.selectedStudent = function (student) {

    $scope.student = {

      id: student.id,

      code: student.code,

      name: student.name,

    };

  };

  $scope.studentData = function (id) {

    $scope.data.StudentClearance.student_id = $scope.student.id;

    $scope.data.StudentClearance.student_name = $scope.student.name;

    $scope.data.StudentClearance.student_no = $scope.student.code;

  };

  $scope.save = function () {

    valid = $("#form").validationEngine("validate");

    if (valid) {

      StudentClearance.save($scope.data, function (e) {

        if (e.ok) {

          $.gritter.add({

            title: "Successful!",

            text: e.msg,

          });

          window.location = "#/faculty/student-clearance/faculty-index";

        } else {

          $.gritter.add({

            title: "Warning!",

            text: e.msg,

          });

        }

      });

    }

  };

});

app.controller("StudentClearanceFacultyViewController", function ($scope, $routeParams, StudentClearance) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load

  $scope.load = function () {

    StudentClearance.get({ id: $scope.id }, function (e) {

      $scope.data = e.data;

    });

  };

  $scope.load();

  $scope.print = function (id) {

    printTable(base + "print/student_clearance_form/" + id);

  };

  // remove
  $scope.remove = function (data) {

    bootbox.confirm("Are you sure you want to remove " + data.code + " ?",function (c) {

      if (c) {

        StudentClearance.remove({ id: data.id }, function (e) {

          if (e.ok) {

            $.gritter.add({

              title: "Successful!",

              text: e.msg,

            });

            window.location = "#/faculty/student-clearance";
          }

        });

      }

    });

  };

});

app.controller("StudentClearanceDeanAddController", function ($scope, StudentClearance, Select) {

  $("#form").validationEngine("attach");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $(".clockpicker").clockpicker({

    donetext: "Done",

    twelvehour: true,

    placement: "bottom",

  });

  $scope.data = {

    StudentClearance: {},

  };

  Select.get({ code: "student-clearance-code" }, function (e) {

    $scope.data.StudentClearance.code = e.data;

  });

  Select.get({ code: "course-list" }, function (e) {

    $scope.course = e.data;

  });

  $scope.searchStudent = function (options) {

    options = typeof options !== "undefined" ? options : {};

    options["code"] = "search-student";

    Select.query(options, function (e) {

      $scope.students = e.data.result;

      $scope.student = {};

      // paginator

      $scope.paginator = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal("show");

    });

  };

  $scope.selectedStudent = function (student) {

    $scope.student = {

      id: student.id,

      code: student.code,

      name: student.name,

    };

  };

  $scope.studentData = function (id) {

    $scope.data.StudentClearance.student_id = $scope.student.id;

    $scope.data.StudentClearance.student_name = $scope.student.name;

    $scope.data.StudentClearance.student_no = $scope.student.code;

  };

  $scope.save = function () {

    valid = $("#form").validationEngine("validate");

    if (valid) {

      StudentClearance.save($scope.data, function (e) {

        if (e.ok) {

          $.gritter.add({

            title: "Successful!",

            text: e.msg,

          });

          window.location = "#/faculty/student-clearance/dean-index";

        } else {

          $.gritter.add({

            title: "Warning!",

            text: e.msg,

          });

        }

      });

    }

  };

});

app.controller("StudentClearanceDeanViewController", function ($scope, $routeParams, StudentClearance) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load

  $scope.load = function () {

    StudentClearance.get({ id: $scope.id }, function (e) {

      $scope.data = e.data;

    });

  };

  $scope.load();

  $scope.print = function (id) {

    printTable(base + "print/student_clearance_form/" + id);

  };

  // remove
  $scope.remove = function (data) {

    bootbox.confirm("Are you sure you want to remove " + data.code + " ?",function (c) {

      if (c) {

        StudentClearance.remove({ id: data.id }, function (e) {

          if (e.ok) {

            $.gritter.add({

              title: "Successful!",

              text: e.msg,

            });

            window.location = "#/faculty/student-clearance";
          }

        });

      }

    });

  };

});