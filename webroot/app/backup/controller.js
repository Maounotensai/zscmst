app.controller('BackupController', function($scope,Backup ){

  $('.datepicker').datepicker({format: 'yyyy-mm-dd', autoclose: true,today: true,

  todayHighlight: true,});

  $scope.load = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    Backup.query(options, function(e) {

      $scope.datas = e.datas;

      // paginator

      $scope.paginator = e.paginator;

      $scope.pages = paginator($scope.paginator, 5);

    });

  };

  $scope.load();
  
  $scope.search = function(search) {

    search = typeof search !== 'undefined' ?  search : '';

    if (search.length > 0) $scope.load({date: search});

    else $scope.load();

  }

  $scope.remove = function(data, index) {

    bootbox.confirm('Are you sure you want to delete backup file <strong>' + data.filename + '</strong>?', function(b) {

      if (b) {

        Backup.remove({

          id: data.id

        }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text: e.msg

            });

            $scope.datas.splice(index, 1);

          } else {

            $.gritter.add({

              title: 'Warning!',

              text: e.msg

            });

          }

        });

      }

    });

  }
 
});