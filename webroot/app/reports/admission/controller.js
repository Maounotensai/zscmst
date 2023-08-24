app.controller('ListStudentController', function($scope,Select, ListStudent) {

  $scope.today = Date.parse('today').toString('MM/dd/yyyy');

  $('.datepicker').datepicker({
   
    format: 'mm/dd/yyyy',
   
    autoclose: true,
   
    todayHighlight: true
  
  });

  Select.get({ code: 'year-term-list' },function(e){

    $scope.year_terms = e.data;

  });

  $scope.getData = function(year_term_id){

    $scope.year_term_id = year_term_id;

    $scope.load({

      year_term_id: $scope.year_term_id

    });

  }

  $scope.datas = '';

  // load data

  $scope.load = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    ListStudent.query(options, function(e) {

      if (e.ok) {

        $scope.datas = e.data; 

        $scope.conditionsPrint = e.conditionsPrint;     

        //paginator

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);   

      }

    });

  }
  
  // $scope.load(); 

  $scope.reload = function(options) {
  
    $scope.search = {};
 
    $scope.advanceSearch = false;
 
    $scope.position_id = null;
 
    $scope.office_id = null;
 
    $scope.employmentStatusId = null;

    $scope.strSearch = '';

    $scope.load();

  }

  $scope.searchy = function(search) {
    
    search = typeof search !== 'undefined' ?  search : '';

    $scope.searchTxts = search;

    if (search.length > 0){

      $scope.load({

        search    : search,

        date      : $scope.dateToday,

        startDate : $scope.startDate,

        endDate   : $scope.endDate,

        year_term_id: $scope.year_term_id

      });

    }else{

      $scope.load({

        date      : $scope.dateToday,

        startDate : $scope.startDate,

        endDate   : $scope.endDate,

        year_term_id: $scope.year_term_id

      });
    
    }
  
  }

  $scope.advanceSearch = false;
  
  $scope.advance_search = function() {
  
    $scope.search = {};
 
    $scope.advanceSearch = false;
 
    $('.monthpicker').datepicker({format: 'MM', autoclose: true, minViewMode: 'months',maxViewMode:'months'});
 
    $('.input-daterange').datepicker({
 
      format: 'mm/dd/yyyy'

    });

    $('#advance-search-modal').modal('show');

  }

  $scope.searchFilter = function(search) {
  
    $scope.filter = false;
   
    $scope.advanceSearch = true;
   
    $scope.searchTxt = '';
   
    $scope.dateToday = null;
   
    $scope.startDate = null;
   
    $scope.endDate = null;
 
    $scope.position_id = null;
 
    $scope.office_id = null;
 
    $scope.employmentStatusId = null;

    if (search.filterBy == 'today') {
     
      $scope.dateToday = Date.parse($scope.today).toString('yyyy-MM-dd');
    
    }else if (search.filterBy == 'date') {
    
      $scope.dateToday = Date.parse(search.date).toString('yyyy-MM-dd');
   
    }else if (search.filterBy == 'month') {
   
      date = $('.monthpicker').datepicker('getDate');
   
      year = date.getFullYear();
   
      month = date.getMonth() + 1;
   
      lastDay = new Date(year, month, 0);

      if (month < 10) month = '0' + month;
      
      $scope.startDate = year + '-' + month + '-01';
      
      $scope.endDate = year + '-' + month + '-' + lastDay.getDate();
    
    }else if (search.filterBy == 'this-month') {
      
      date = new Date();
      
      year = date.getFullYear();
      
      month = date.getMonth() + 1;
      
      lastDay = new Date(year, month, 0);

      if (month < 10) month = '0' + month;
      
      $scope.startDate = year + '-' + month + '-01';
      
      $scope.endDate = year + '-' + month + '-' + lastDay.getDate();
   
    }else if (search.filterBy == 'custom-range') {
    
      $scope.startDate = search.startDate;
    
      $scope.endDate = search.endDate;
    
    }

    $scope.load({

      date         : $scope.dateToday,

      startDate    : $scope.startDate,

      endDate      : $scope.endDate,

      year_term_id : $scope.year_term_id

    });

    $('#advance-search-modal').modal('hide');
  
  } 

  $scope.print = function(){

    if ($scope.conditionsPrint !== ''){

      printTable(base + 'print/list_students?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/list_students');

    }

  }

  $scope.export = function(){

    if ($scope.conditionsPrint !== undefined && $scope.conditionsPrint !== ''){

      printTable(base + 'print/export_registered_students?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/export_registered_students?print=1');

    }

    // Select.get({code: 'daily-list-collection-export'}, function(e){});

  }

});

app.controller('ListApplicantsController', function($scope, ListApplicant) {

  $scope.today = Date.parse('today').toString('MM/dd/yyyy');

  $('.datepicker').datepicker({
   
    format: 'mm/dd/yyyy',
   
    autoclose: true,
   
    todayHighlight: true
  
  });

  $scope.pending = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 0;

    options['rate'] = 1;

    ListApplicant.query(options, function(e) {

      if (e.ok) {

        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);

      }

    });

  }

  $scope.approved = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 1;

    options['rate'] = 1;

    ListApplicant.query(options, function(e) {

      if (e.ok) {

        $scope.datasApproved = e.data;

        $scope.conditionsPrintApproved = e.conditionsPrint;

        // paginator

        $scope.paginatorApproved  = e.paginator;

        $scope.pagesApproved = paginator($scope.paginatorApproved, 5);

      }

    });

  }

  $scope.disapproved = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 2;

    options['rate'] = 1;

    ListApplicant.query(options, function(e) {

      if (e.ok) {

        $scope.datasDisapproved = e.data;

        $scope.conditionsPrintDisapproved = e.conditionsPrint;

        // paginator

        $scope.paginatorDisapproved  = e.paginator;

        $scope.pagesDisapproved = paginator($scope.paginatorDisapproved, 5);

      }

    });

  }

  $scope.load = function(options) {

    $scope.pending(options);

    $scope.approved(options);

    $scope.disapproved(options);

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

  $scope.remove = function(data) {

    bootbox.confirm('Are you sure you want to delete application?', function(c) {

      if (c) {

        ListApplicant.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            $scope.load();

          }

        });

      }

    });

  }

  $scope.print = function(){

    if ($scope.conditionsPrintPending !== '') {
    
      printTable(base + 'print/student_application?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/student_application?print=1');

    }

  }

  $scope.printApproved = function(){

    if ($scope.conditionsPrintApproved !== '') {
    
      printTable(base + 'print/student_application?print=1' + $scope.conditionsPrintApproved);

    }else{

      printTable(base + 'print/student_application?print=1');

    }

  }

  $scope.printDisapproved = function(){

    if ($scope.conditionsPrintDisapproved !== '') {
    
      printTable(base + 'print/student_application?print=1' + $scope.conditionsPrintDisapproved);

    }else{

      printTable(base + 'print/student_application?print=1');

    }

  }

});

app.controller("ScholarshipEvaluationsController", function ($scope, ScholarshipEvaluation) {
  
  $scope.today = Date.parse("today").toString("MM/dd/yyyy");

  $(".datepicker").datepicker({

    format: "mm/dd/yyyy",

    autoclose: true,

    todayHighlight: true,

  });

  $scope.confirmed = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['status'] = 4;

    ScholarshipEvaluation.query(options, function(e) {

      if (e.ok) {

        $scope.datasConfirmed = e.data;

        $scope.conditionsPrintConfirmed = e.conditionsPrint;

        // paginator

        $scope.paginatorConfirmed  = e.paginator;

        $scope.pagesConfirmed = paginator($scope.paginatorConfirmed, 5);

      }

    });

  }


  $scope.load = function(options) {

    $scope.confirmed(options);
  }

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

    bootbox.confirm("Are you sure you want to delete " + data.code + " ?", function (c) {

      if (c) {

        ScholarshipEvaluation.remove({ id: data.id }, function (e) {

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

  $scope.printConfirmed = function(){

    if ($scope.conditionsPrintApproved !== '') {
    
      printTable(base + 'print/student_applications?print=1' + $scope.conditionsPrintConfirmed);

    }else{

      printTable(base + 'print/student_applications?print=1');

    }

  }


});