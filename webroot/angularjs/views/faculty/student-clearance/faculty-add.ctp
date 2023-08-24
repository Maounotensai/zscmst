<?php if (hasAccess('student clearance/add', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">ADD NEW STUDENT CLEARANCE</div>
        <div class="clearfix"></div>
        <hr>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label> CONTROL NO. </label>
                <input disabled type="text" class="form-control" ng-model="data.StudentClearance.code">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> SEARCH STUDENT </label><label style="font-size:10px;color:gray;" class="pull-right">Press Enter to search</label>
                <input type="text" class="form-control search uppercase" placeholder="TYPE STUDENT HERE" ng-model="searchTxt" ng-enter="searchStudent({ search: searchTxt })">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> STUDENT <i class="required">*</i></label>
                <table class="table table-bordered">
                  <tr>
                    <td style="{{ data.StudentClearance.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.StudentClearance.student_name }}</td>
                    <td style="{{ data.StudentClearance.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.StudentClearance.student_name == undefined">
                      <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.StudentClearance.student_name = null; data.StudentClearance.student_id = null;" ng-init="data.StudentClearance.student_id = null"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> COURSE <i class="required">*</i></label>
                <select selectize ng-model="data.StudentClearance.course_id" ng-options="opt.id as opt.value for opt in course" ng-change="getCourse(data.StudentClearance.course_id)" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> MAJOR <i class="required">*</i></label>
                <input type="text" class="form-control uppercase" autocomplete="off" ng-model="data.StudentClearance.major" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> SEMESTER <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentClearance.semester" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                  <option value=""></option>
                  <option value="First Semester">First Semester</option>
                  <option value="Second Semester">Second Semester</option>
                  <option value="Summer">Summer</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> YEAR LEVEL <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentClearance.year" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                  <option value=""></option>
                  <option value="First Year">First Year</option>
                  <option value="Second Year">Second Year</option>
                  <option value="Third Year">Third Year</option>
                  <option value="Fourth Year">Fourth Year</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> SA Number <i class="required">*</i></label>
                <input type="text" class="form-control uppercase" autocomplete="off" ng-model="data.StudentClearance.sa_number"data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> SCHOOL YEAR <i class="required">*</i></label>
                <input type="text" class="form-control uppercase" autocomplete="off" ng-model="data.StudentClearance.school_year" data-validation-engine="validate[required]">
              </div>
            </div>
          </div>
        </form>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-primary btn-min" id="save" ng-click="save();"><i class="fa fa-save"></i> SAVE </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->element('modals/search/searched-student-modal') ?>
<?php endif ?>
<style type="text/css">
th {
    white-space: nowrap;
}

td {
    white-space: nowrap;
}
</style>