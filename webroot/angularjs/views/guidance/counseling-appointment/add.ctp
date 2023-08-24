<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">NEW COUSELING APPOINTMENT</div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info">
                      <th class = "text-center" colspan="2">STUDENT INFORMATION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-left" style="width: 15%"> STUDENT NUMBER </th>
                      <td class="text-left uppercase">{{ data.CounselingAppointment.student_no }}</td>   
                    </tr>
                    <tr>
                      <th class="text-left"> STUDENT NAME </th>
                      <td class="text-left uppercase">{{ data.CounselingAppointment.student_name }}</td>   
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-12">
              <div class="clearfix"></div><hr>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> CONTROL NO. </label>
                <input disabled type="text" class="form-control" ng-model="data.CounselingAppointment.code">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label> SEARCH COUNSELOR </label><label style="font-size:10px;color:gray;" class="pull-right">Press Enter to search</label>
                <input type="text" class="form-control search uppercase" placeholder="TYPE EMPLOYEE HERE" ng-model="searchTxtCounselor" ng-enter="searchEmployee({ search: searchTxtCounselor })">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> COUNSELOR <i class="required">*</i></label>
                <table class="table table-bordered">
                  <tr>
                    <td style="{{ data.CounselingAppointment.counselor_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.CounselingAppointment.counselor_name }}</td>
                    <td style="{{ data.CounselingAppointment.counselor_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.CounselingAppointment.counselor_name == undefined">
                      <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.CounselingAppointment.counselor_name = null; data.CounselingAppointment.counselor_id = null;" ng-init="data.CounselingAppointment.counselor_id = null"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>  
                </table>  
              </div>
            </div>
            <div class="col-md-3" >
              <div class="form-group">
                <label> COUNSELING TYPE <i class="required">*</i></label>
                <select selectize style="height: 100px" ng-model="data.CounselingAppointment.counseling_type_id" ng-options="opt.id as opt.value for opt in counseling_types" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> DATE <i class="required">*</i></label>
                <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.CounselingAppointment.date" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">  
              <div class="form-group">
                <label> TIME </label><i class="required">*</i>
                <div class="input-group clockpicker">
                  <input type="text" autocomplete = "false" class="form-control uppercase" ng-model="data.CounselingAppointment.time" id="time">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> DESCRIPTION <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.CounselingAppointment.description" data-validation-engine="validate[required]">
              </div>
            </div>
          </div>
        </form>
        <div class="clearfix"></div><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-min" id = "save" ng-click="save();"><i class="fa fa-save"></i> SAVE </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->element('modals/search/searched-student-modal') ?>
<?php echo $this->element('modals/search/searched-employee-modal') ?>
<style type="text/css">
  th {
    white-space: nowrap;
  }
  td {
    white-space: nowrap;
  }
</style>