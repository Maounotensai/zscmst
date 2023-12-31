<?php if (hasAccess('student clearance/edit', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">EDIT STUDENT CLEARANCE</div>
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
                    <td style="{{ data.StudentClearance.student_name == undefined ? 'padding:15px':'padding:5px !important'}}"
                      class="w30px" ng-hide="data.StudentClearance.student_name == undefined">
                      <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.StudentClearance.student_name = null; data.StudentClearance.student_id = null;" ng-init="data.StudentClearance.student_id = null"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- <div class="col-md-6">
              <div class="form-group">
                <label> COURSE <i class="required">*</i></label>
                <select selectize ng-model="data.StudentClearance.course_id" ng-options="opt.id as opt.value for opt in course" ng-change="getCourse(data.StudentClearance.course_id)" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div> -->

            <div class="col-md-6">
                <div class="form-group">
                  <label> PROGRAM <i class="required">*</i></label>
                  <select selectize ng-options="opt.id as opt.value for opt in college_program" ng-model="data.StudentClearance.course_id" data-validation-engine="validate[required]">
                  <option value=""></option></select>
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
                <input type="text" class="form-control uppercase" autocomplete="off" ng-model="data.StudentClearance.sa_number" data-validation-engine="validate[required]">
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
              <button class="btn btn-primary btn-min" id="save" ng-click="update();"><i class="fa fa-save"></i> UPDATE </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="searched-student-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADVANCE SEARCH</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered vcenter table-striped table-condensed">
              <thead>
                <tr>
                  <th class="w30px">#</th>
                  <th class="text-center">STUDENT NUMBER</th>
                  <th class="text-center">NAME</th>
                  <th class="w30px"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="student in students">
                  <td>{{ (paginator.page - 1) * paginator.limit + $index + 1 }}</td>
                  <td class="uppercase text-center">{{ student.code }}</td>
                  <td class="uppercase text-center">{{ student.name }}</td>
                  <td>
                    <input icheck type="radio" ng-init="student.selected = false" ng-model="student.selected" name="iCheck" ng-selected="student.selected = true" ng-change="selectedStudent(student)">
                  </td>
                </tr>
              </tbody>
              <tfoot ng-show="paginator.pageCount > 0">
                <tr>
                  <td colspan="4" class="text-center">
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="pagination justify-content-center">
                          <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})"><sub>&laquo;&laquo;</sub></a>
                          </li>
                          <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">&laquo;</a>
                          </li>
                          <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                            <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">{{ page.number }}</a>
                          </li>
                          <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">&raquo;</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})"><sub>&raquo;&raquo;</sub> </a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="text-center" ng-show="paginator.pageCount > 0">
                          <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>  
      </div> 

      <div class="modal-footer">
        <div class="pull-right">
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"><i class="fa fa-close"></i> CLOSE</button>
          <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="studentData(employee.id)" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
        </div> 
        
      </div>
    </div>  
  </div><!-- /.modal-content -->
</div>

<?php endif ?>
<style type="text/css">
th {
    white-space: nowrap;
}

td {
    white-space: nowrap;
}
</style>