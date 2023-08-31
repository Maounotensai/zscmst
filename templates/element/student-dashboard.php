<?php $g=0; $rates=0; $counter=0;

  foreach($grades as $grade){

    if($grades[$counter]['StudentEnrolledCourse']['final_grade']==NULL){

      $g+=1;

    }

    if($grades[$counter]['StudentEnrolledCourse']['rate_by']==NULL){

      $rates+=1;

    }

    $counter+=1;

  }

  if($for_medical_interview == 1 && $for_schedule == 0){ ?>

    <div class="modal fade" id="medicalInterviewModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title uppercase"> Request Medical Interview </h5>
          </div>
          <div class="modal-body">
            <form id="medical_interview">  
              
              <div class="col-md-12">
                <div class="form-group">
                  <label> PURPOSE <i class="required">*</i></label>
                  <textarea class="form-control" autocomplete="off" ng-model="tmpData.purpose" data-validation-engine="validate[required]"></textarea>
                </div>
              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="requestMedicalInterview(tmpData)"><i class="fa fa-save"></i> SUBMIT </button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      
      function myFunction(){

        $('#medical_interview').validationEngine('attach');

        $("#medicalInterviewModal").modal('show');

      }

    </script>

    <script type="text/javascript">
      myFunction();
    </script>

    <div class="modal fade" id="notifModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title uppercase"> For Interview Schedule </h5>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <img src="<?php echo $base ?>/assets/img/come_back_later.png" width="100%">
            </div>
            <div class="col-md-12">
              <p>You have requested a medical interview. Wait for a interview schedule to be sent by Admission Office.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  
<?php }
  
  if($for_schedule == 1){ ?>

    <div class="modal fade" id="notifModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title uppercase"> For Interview Schedule </h5>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <img src="<?php echo $base ?>/assets/img/come_back_later.png" width="100%">
            </div>
            <div class="col-md-12">
              <p>You have requested a medical interview. Wait for a interview schedule to be sent by Admission Office.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      
      function notifModal(){

        $("#notifModal").modal('show');

      }

    </script>

    <script type="text/javascript">
      notifModal();
    </script>

<?php } ?>

<?php if($g == 0 && $rates > 0){?>
  <div class="d-flex aligns-items-center justify-content-center card text-center w-75 mx-auto">
    <div class="card-body">
      <h5 class="card-title">EVALUATION READY!</h5>
      <p class="card-text">Click Here to Evaluate your Instructors</p>
      <a href="#/faculty/faculty-evaluation" class="btn btn-success">EVALUATE</a>
    </div>
  </div>

<?php } else{ ?>
  <style type="text/css">
  .img-list {
    margin-bottom: 20px;
    height: 250px;
    width: 100%;
    overflow-x: auto;
  }
  #img-container {
    height: 100%;
    position: relative;
    white-space:nowrap;
  }

  #img-container img {
    height: 100%;
    display: inline-block;
    vertical-align:top; /*to remove unwanted whitespace */
    position: relative;
  }
</style>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="dashboard_graph">

      <div class="row x_title">
        <div class="col-md-6">
          <h3>Apartelles/Dormitory</small></h3>
        </div>
      </div>

      <div class="col-md-12 col-sm-12  bg-white">
          
        <div class="img-list">
          <div  id="img-container">

          <?php 

            if(!empty($datas)){

              foreach ($datas as $key => $value) { ?>
                
                <img src="<?php echo $value['imageSrc']; ?>" style="border-radius : 2px; margin-bottom : 10px; z-index: : 1;" onclick="showImageModal('<?php echo $value['imageSrc']; ?>')">
                
              <?php }

            }

          ?>
          </div>
        </div>
        
      </div>

      <div class="clearfix"></div>
    </div>
  </div>

</div>
<br />




<script type="text/javascript">
  function showImageModal(imageSrc){
    document.getElementById("myImg").src = imageSrc; 
    $('#view-image-modal').modal('show');
  }
</script>

<div class="modal fade" id="view-image-modal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <img src="" id="myImg" width="100%" height="100%" style="border-radius : 2px; margin-bottom : 10px">
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-group-sm pull-right btn-min">
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"> CANCEL</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php }?>