app.controller('DashboardController', function($scope,Setting,SettingType,Select,StudentApplicationMedicalRequest){
  
  $scope.data = {};

  $scope.load = function() {

    options = typeof options !== 'undefined' ?  options : {};

    // anychart.onDocumentReady(function() {

    //   var chart = anychart.pie3d([

    //     {x : 'Pending', value : 1},
    //     {x : 'Approved', value : 1},
    //     {x : 'Disapproved', value : 1},
    //     {x : 'Cancelled', value : 1},
    //     {x : 'Confirmed', value : 1},
        
    //   ]);

    //   chart.title('Counseling Appointment');
    //   chart.radius('50%');
    //   chart.sort('desc');

    //   chart.container('chartdiv');
    //   chart.draw();

    // });

  }

  $scope.load();

  $scope.tmpData = {};

  $scope.requestMedicalInterview = function(data){  

    valid = $("#medical_interview").validationEngine('validate');

    if(valid){

      bootbox.confirm('Are you sure you want to submit request?', function(b){

        if(b) {

          StudentApplicationMedicalRequest.save(data, function(e){

            if(e.ok){

              $.gritter.add({

                title: 'Successful!',

                text: e.msg

              });

              $("#medicalInterviewModal").modal('hide');

              $("#notifModal").modal('show');

            }

          });

        }

      });

    }

  }

});