app.controller("CompletionController", function ($scope, Completion) {
  $scope.today = Date.parse("today").toString("MM/dd/yyyy");

  $(".datepicker").datepicker({
    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,
  });

  $scope.load = function (options) {
    options = typeof options !== "undefined" ? options : {};

    Completion.query(options, function (e) {
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

  $scope.advance_search = function () {
    $scope.search = {};

    $scope.advanceSearch = false;

    $scope.position_id = null;

    $scope.office_id = null;

    $(".monthpicker").datepicker({
      format: "MM",

      autoclose: true,

      minViewMode: "months",

      maxViewMode: "months",
    });

    $(".input-daterange").datepicker({
      format: "yyyy-mm-dd",
    });

    $(".datepicker").datepicker("setDate", "");

    $(".monthpicker").datepicker("setDate", "");

    $(".input-daterange").datepicker("setDate", "");

    $("#advance-search-modal").modal("show");
  };

  $scope.searchFilter = function (search) {
    $scope.filter = false;

    $scope.advanceSearch = true;

    $scope.searchTxt = "";

    $scope.dateToday = null;

    $scope.startDate = null;

    $scope.endDate = null;

    if (search.filterBy == "today") {
      $scope.dateToday = Date.parse("today").toString("yyyy-MM-dd");

      $scope.today = Date.parse("today").toString("yyyy-MM-dd");

      $scope.dateToday = $scope.today;

      $scope.load({
        date: $scope.dateToday,
      });
    } else if (search.filterBy == "date") {
      $scope.dateToday = Date.parse(search.date).toString("yyyy-MM-dd");

      $scope.load({
        date: $scope.dateToday,
      });
    } else if (search.filterBy == "month") {
      date = $(".monthpicker").datepicker("getDate");

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = "0" + month;

      $scope.startDate = year + "-" + month + "-01";

      $scope.endDate = year + "-" + month + "-" + lastDay.getDate();

      $scope.load({
        startDate: $scope.startDate,

        endDate: $scope.endDate,
      });
    } else if (search.filterBy == "this-month") {
      date = new Date();

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = "0" + month;

      $scope.startDate = year + "-" + month + "-01";

      $scope.endDate = year + "-" + month + "-" + lastDay.getDate();

      $scope.load({
        startDate: $scope.startDate,

        endDate: $scope.endDate,
      });
    } else if (search.filterBy == "custom") {
      $scope.startDate = Date.parse(search.startDate).toString("yyyy-MM-dd");

      $scope.endDate = Date.parse(search.endDate).toString("yyyy-MM-dd");
    }

    $scope.load({
      date: $scope.dateToday,

      startDate: $scope.startDate,

      endDate: $scope.endDate,
    });

    $("#advance-search-modal").modal("hide");
  };

  $scope.remove = function (data) {
    bootbox.confirm(
      "Are you sure you want to delete " + data.student_name + " ?",
      function (c) {
        if (c) {
          Completion.remove({ id: data.id }, function (e) {
            if (e.ok) {
              $.gritter.add({
                title: "Successful!",

                text: e.msg,
              });

              $scope.load();
            }
          });
        }
      }
    );
  };

  $scope.print = function () {
    date = "";

    if ($scope.conditionsPrint !== "") {
      printTable(base + "print/completion?print=1" + $scope.conditionsPrint);
    } else {
      printTable(base + "print/completion?print=1");
    }
  };
});

app.controller("CompletionAddController",function ($scope, Completion, Select) {
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
      Completion: {},
    };

    Select.get({ code: "completions" }, function (e) {
      $scope.data.Completion.code = e.data;
    });

    // Select.get({ code: "course-list" }, function (e) {
    //   $scope.course = e.data;
    // });

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
      $scope.data.Completion.student_id = $scope.student.id;

      $scope.data.Completion.student_name = $scope.student.name;

      $scope.data.Completion.student_no = $scope.student.code;
    };

    $scope.save = function () {
      valid = $("#form").validationEngine("validate");

      if (valid) {
        Completion.save($scope.data, function (e) {
          if (e.ok) {
            $.gritter.add({
              title: "Successful!",

              text: e.msg,
            });

            window.location = "#/registrar/completion";
          } else {
            $.gritter.add({
              title: "Warning!",

              text: e.msg,
            });
          }
          console.log(e.msg);
        });
      }
    };
  }
);

app.controller("CompletionViewController",function ($scope, $routeParams, Completion) {
    $scope.id = $routeParams.id;

    $scope.data = {};

    // load

    $scope.load = function () {
      
      Completion.get({ id: $scope.id }, function (e) {
        $scope.data = e.data;
      });
    };

    $scope.load();

    $scope.print = function (id) {
      printTable(base + "print/completion_form/" + id);
    };

    // remove
    $scope.remove = function (data) {
      bootbox.confirm(
        "Are you sure you want to remove " + data.code + " ?",
        function (c) {
          if (c) {
            Completion.remove({ id: data.id }, function (e) {
              if (e.ok) {
                $.gritter.add({
                  title: "Successful!",

                  text: e.msg,
                });

                window.location =
                  "#/registrar/completion";
              }
            });
          }
        }
      );
    };
  }
);

app.controller(
  "CompletionEditController",
  function ($scope, $routeParams, Completion, Select) {
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
      Completion: {},
    };

    $scope.bool = [
      { id: true, value: "Yes" },
      { id: false, value: "No" },
    ];

    // Select.get({ code: "course-list" }, function (e) {
    //   $scope.course = e.data;
    // });

    // load

    $scope.load = function () {
      Completion.get({ id: $scope.id }, function (e) {
        $scope.data = e.data;
      });
    };
    $scope.load();

    $scope.searchStudent = function (options) {
      options = typeof options !== "undefined" ? options : {};

      options["code"] = "search-student";

      Select.query(options, function (e) {
        console.log(e);
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
      $scope.data.Completion.student_id = $scope.student.id;

      $scope.data.Completion.student_name = $scope.student.name;

      $scope.data.Completion.student_no = $scope.student.code;
    };

    $scope.update = function () {
      valid = $("#form").validationEngine("validate");

      if (valid) {
        Completion.update({ id: $scope.id }, $scope.data, function (e) {
          if (e.ok) {
            $.gritter.add({
              title: "Successful!",

              text: e.msg,
            });

            window.location = "#/registrar/completion";
          } else {
            $.gritter.add({
              title: "Warning!",

              text: e.msg,
            });
          }
        });
      }
    };
  }
);
