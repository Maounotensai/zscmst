app.controller('CatController', function($scope, Select, StudentApplication, StudentApplicationRate, StudentApplicationEmail, StudentApplicationBulkEmail, StudentApplicationSchedule) {

  $scope.today = Date.parse('today').toString('MM/dd/yyyy');

  $('.datepicker').datepicker({
   
    format: 'mm/dd/yyyy',
   
    autoclose: true,
   
    todayHighlight: true
  
  });

  $('.clockpicker').clockpicker({

    donetext: 'Done',

    twelvehour:  true,

    placement: 'bottom',

  });

  Select.get({ code: 'room-list' }, function(e) {

    $scope.rooms = e.data;

  });

  $scope.for_rate = function(options) {

    options = typeof options !== 'undefined' ?  options : {}; 

    options['status'] = 0;

    StudentApplication.query(options, function(e) {

      if (e.ok) {

        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);

      }

    });

  }

  $scope.disqualified = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 3;

    StudentApplication.query(options, function(e) {

      if (e.ok) {

        $scope.datasDisapproved = e.data;

        $scope.conditionsPrintDisapproved = e.conditionsPrint;

        // paginator

        $scope.paginatorDisapproved  = e.paginator;

        $scope.pagesDisapproved = paginator($scope.paginatorDisapproved, 5);

      }

    });

  }

  $scope.interview = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 1;

    StudentApplication.query(options, function(e) {

      if (e.ok) {

        $scope.datasInterview = e.data;

        $scope.conditionsPrintInterview = e.conditionsPrint;

        // paginator

        $scope.paginatorInterview  = e.paginator;

        $scope.pagesInterview = paginator($scope.paginatorInterview, 5);

      }

    });

  }

  $scope.qualified = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 2;

    StudentApplication.query(options, function(e) {

      if (e.ok) {

        $scope.datasAssessed = e.data;

        $scope.conditionsPrintAssessed = e.conditionsPrint;

        // paginator

        $scope.paginatorAssessed  = e.paginator;

        $scope.pagesAssessed = paginator($scope.paginatorAssessed, 5);

      }

    });

  }

  $scope.load = function(options) {

    $scope.for_rate(options);

    $scope.interview(options);

    $scope.qualified(options);

    $scope.disqualified(options);

  }

  $scope.orderRating = 'studentRateDesc';

  $scope.orderPaginator = $scope.orderRating;

  $scope.studentRating = function() {

    $scope.orderPaginator = $scope.orderRating;

    if($scope.orderRating == 'studentRateAsc'){

      $scope.load({

        order: $scope.orderRating,

        search: $scope.searchTxt,

        date        : $scope.dateToday,

        startDate   : $scope.startDate,

        endDate     : $scope.endDate

      });

      $scope.orderRating = 'studentRateDesc';

    }else{

      $scope.load({

        order: $scope.orderRating,

        search: $scope.searchTxt,

        date        : $scope.dateToday,

        startDate   : $scope.startDate,

        endDate     : $scope.endDate

      });

      $scope.orderRating = 'studentRateAsc';

    }

  }

  $scope.load();
  
  $scope.reload = function(options) {
  
    $scope.search = {};
 
    $scope.searchTxt = '';
   
    $scope.dateToday = null;
   
    $scope.startDate = null;
   
    $scope.endDate = null;

    $scope.load();

  }

  $scope.searchy = function(search) {

    search = typeof search !== 'undefined' ? search : '';

    if (search.length > 0){

      $scope.load({

        search: search

      });

    }else{

      $scope.load();
    
    }

  }

  $scope.advance_search = function() {

    $scope.search = {};

    $scope.advanceSearch = false;
 
    $scope.position_id = null;
 
    $scope.office_id = null;

    $('.monthpicker').datepicker({

      format: 'MM',

      autoclose: true,

      minViewMode: 'months',

      maxViewMode: 'months'

    });

    $('.input-daterange').datepicker({

      format: 'yyyy-mm-dd'

    });

    $('.datepicker').datepicker('setDate', '');

    $('.monthpicker').datepicker('setDate', '');

    $('.input-daterange').datepicker('setDate', '');

    $('#advance-search-modal').modal('show');

  }

  $scope.searchFilter = function(search) {

    $scope.filter = false;

    $scope.advanceSearch = true;

    $scope.searchTxt = '';

    $scope.dateToday = null;

    $scope.startDate = null;

    $scope.endDate = null;

    if (search.filterBy == 'today') {

      $scope.dateToday = Date.parse('today').toString('yyyy-MM-dd');

      $scope.today = Date.parse('today').toString('yyyy-MM-dd');


      $scope.dateToday = $scope.today;

      $scope.load({

        date: $scope.dateToday

      });

    }else if (search.filterBy == 'date') {

      $scope.dateToday = Date.parse(search.date).toString('yyyy-MM-dd');

      $scope.load({

        date: $scope.dateToday

      });

    }else if (search.filterBy == 'month') {

      date = $('.monthpicker').datepicker('getDate');

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = '0' + month;

      $scope.startDate = year + '-' + month + '-01';

      $scope.endDate = year + '-' + month + '-' + lastDay.getDate();

      $scope.load({

        startDate: $scope.startDate,

        endDate: $scope.endDate

      });

    }else if (search.filterBy == 'this-month') {

      date = new Date();

      year = date.getFullYear();

      month = date.getMonth() + 1;

      lastDay = new Date(year, month, 0);

      if (month < 10) month = '0' + month;

      $scope.startDate = year + '-' + month + '-01';

      $scope.endDate = year + '-' + month + '-' + lastDay.getDate();

      $scope.load({

        startDate: $scope.startDate,

        endDate: $scope.endDate

      });

    }else if (search.filterBy == 'custom') {

      $scope.startDate = Date.parse(search.startDate).toString('yyyy-MM-dd');

      $scope.endDate =  Date.parse(search.endDate).toString('yyyy-MM-dd');


    }

    $scope.load({

      date        : $scope.dateToday,

      startDate   : $scope.startDate,

      endDate     : $scope.endDate,

    });

    $('#advance-search-modal').modal('hide');

  }

  $scope.rate = function(data){  

    bootbox.confirm('Are you sure you want to rate examinee?', function(b){

      if(b) {

        bootbox.prompt('RATE', function(result){

          if(isNaN(result)){

            $.gritter.add({

              title : 'Warning!',

              text: 'Please input numbers only.'

            });

          }else{

            if(result){

              $scope.data = {

                rate : result

              };

              StudentApplicationRate.update({id:data.id},$scope.data, function(e){

                if(e.ok){

                  $.gritter.add({

                    title : 'Successful!',

                    text: e.msg

                  });

                  $scope.load();

                }

              });

            }

          }

        });

      }

    });

  }

  $scope.sendMail = function(data) {

    $('#form-mail').validationEngine('attach');

    $scope.mail = {

      reference_id : data.id

    };

    $("#send-mail-modal").modal('show');

  } 

  // SEND EMAIL 

  $scope.sendEmailFinal = function(data) {

    valid = $("#form-mail").validationEngine('validate');

    if(valid){

      StudentApplicationEmail.save({ id : data.id },$scope.mail, function(e){

        if(e.ok){

          $scope.reload();

          $.gritter.add({

            title: 'Successful!',

            text: 'Email notification has been sent.'

          });

          $("#send-mail-modal").modal('hide');

        }

      });

    }

  } 

  $scope.selectall = function() {

    if ($scope.selectAll) {

      bool = true;

    } else {

      bool = false;

    }

    for (i in $scope.datas) {

      $scope.datas[i].check = bool;

    }

  }

  $scope.emailSelected = function(){

    $('#form-bulk-mail').validationEngine('attach');

    $scope.mail = {};

    $("#send-bulk-mail-modal").modal('show');

  }

  $scope.sendSelected = function(data){

    valid = $("#form-bulk-mail").validationEngine('validate');

    if(valid){

      forEmail = [];

      if($scope.datas.length > 0){

        $.each($scope.datas,function(i,value){

          if(value.check){

            forEmail.push({

              student_id : value.id,

              date : data.date,

              time : data.time,

              place : data.place,

              room : data.room

            });

          }

        });

      }

      bootbox.confirm('Are you sure you want to email all selected applicant?', function(b){

        if(b) {

          StudentApplicationBulkEmail.update(forEmail, function(e){

            if(e.ok){

              $.gritter.add({

                title: 'Successful!',

                text: 'Email notification has been sent.'

              });

              $("#send-bulk-mail-modal").modal('hide');

            }   

          });

        }

      });

    }

  }

  $scope.viewInterviewRequest = function(data) {

    $scope.student_id = data.id;

    $scope.request = {

      request_purpose : data.request_purpose

    };

    $("#view-request-modal").modal('show');

  }

  $scope.setSchedule = function(data) {

    $('#form-schedule').validationEngine('attach');

    $scope.schedule = {};

    $("#send-schedule-modal").modal('show');

  }

  $scope.sendSchedule = function(data) {

    valid = $("#form-schedule").validationEngine('validate');

    if(valid){

      if(data.room !== '' && data.room !== null && data.room !== undefined){

        StudentApplicationSchedule.save({ id : $scope.student_id },$scope.schedule, function(e){

          if(e.ok){

            $scope.reload();

            $.gritter.add({

              title: 'Successful!',

              text: 'Email notification has been sent.'

            });

            $("#send-schedule-modal").modal('hide');

            $("#view-request-modal").modal('hide');

          }

        });

      }else{

        $.gritter.add({

          title: 'Warning!',

          text: 'Please select room.'

        });

      }

    }

  }

  $scope.print = function(){

    if ($scope.conditionsPrint !== '') {
    
      printTable(base + 'print/cats?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/cats?print=1');

    }

  }

  $scope.printAssessed = function(){

    if ($scope.conditionsPrintAssessed !== '') {
    
      printTable(base + 'print/cats_assessed?print=1' + $scope.conditionsPrintAssessed);

    }else{

      printTable(base + 'print/cats_assessed?print=1');

    }

  }

  $scope.printDisapproved = function(){

    if ($scope.conditionsPrintDisapproved !== '') {
    
      printTable(base + 'print/student_application?print=1' + $scope.conditionsPrintDisapproved);

    }else{

      printTable(base + 'print/student_application?print=1');

    }

  }

  $scope.printInterview = function(){

    if ($scope.conditionsPrintInterview !== '') {
    
      printTable(base + 'print/student_application?print=1' + $scope.conditionsPrintInterview);

    }else{

      printTable(base + 'print/student_application?print=1');

    }

  }

  $scope.printData = function (id) {
  
    printTable(base + "print/cat_rating_result/" + id);
  
  };

});

app.controller("CatViewController", function ($scope, $routeParams, StudentApplication,StudentApplicationQualify,StudentApplicationUnqualify) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load

  $scope.load = function () {
   
    StudentApplication.get({ id: $scope.id }, function (e) {
   
      $scope.data = e.data;

      $scope.applicationImage = e.applicationImage;
   
    });
  
  };

  $scope.print = function (id) {

      printTable(base + "print/cat_application_form/" + $scope.id); 

    };

  $scope.load();

  $scope.qualify = function(data){  

    bootbox.confirm('Are you sure you want to qualify application?', function(b){

      if(b) {

        StudentApplicationQualify.update({id:data.id},$scope.data, function(e){

          if(e.ok){

            $.gritter.add({

              title : 'Successful!',

              text: e.msg

            });

            window.location = '#/admission/cat';

          }

        });

      }

    });

  }

  $scope.unqualify = function(data){  

    bootbox.confirm('Are you sure you want to unqualify application?', function(b){

      if(b) {

        bootbox.prompt('REASON ?', function(result){

          if(result){

            $scope.data = {

              explanation : result

            };

            StudentApplicationUnqualify.update({id:data.id},$scope.data, function(e){

              if(e.ok){

                $.gritter.add({

                  title : 'Successful!',

                  text: e.msg

                });

                window.location = "#/admission/cat";

              }

            });

          }

        });

      }

    });

  }

});