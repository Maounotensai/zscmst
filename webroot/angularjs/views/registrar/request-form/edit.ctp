
  <div class="row">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">EDIT REQUEST FORM</div>
          <div class="clearfix"></div>
          <hr>
          <form id="form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label> CONTROL NO. </label>
                  <input disabled type="text" class="form-control" ng-model="data.RequestForm.code">
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
                      <td style="{{ data.RequestForm.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.RequestForm.student_name }}</td>
                      <td style="{{ data.RequestForm.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.RequestForm.student_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.RequestForm.student_name = null; data.RequestForm.student_id = null;" ng-init="data.RequestForm.student_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> OFFICIAL RECEIPT #: <i class="required">*</i></label>
                  <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.or_no" data-validation-engine="validate[required]"></input>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> COURSE <i class="required">*</i></label>
                  <select selectize ng-model="data.RequestForm.course_id" ng-options="opt.id as opt.value for opt in course" ng-change="getCourse(data.RequestForm.course_id)" data-validation-engine="validate[required]">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label> YEAR LEVEL <i class="required">*</i></label>
                  <select class="form-control" ng-model="data.RequestForm.year" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                    <option value=""></option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    </option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label> DATE <i class="required">*</i></label>
                  <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.RequestForm.date" data-validation-engine="validate[required]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> PURPOSE <i class="required">*</i></label>
                  <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.purpose" data-validation-engine="validate[required]"></input>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> REMARKS <i class="required">*</i></label>
                  <textarea rows="1" class="form-control" autocomplete="false" ng-model="data.RequestForm.remarks" data-validation-engine="validate[required]"></textarea>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
              <hr>
              <div class="col-md-12 mt-4">
                <div class="form-group">
                  <label> PLEASE CHECK NATURE OF REQUEST <i class="required">*</i></label>
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.otr"> Transcript of Record (TOR)
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cav"> Certification Authentication Verification (CAV)
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cert"> Certification
                    </div>
                  </div>
                  <div class="row py-3" ng-show="data.RequestForm.otr !=true"></div>
                  <div class="row">
                    <div class="col-md-2 text-right" ng-show="data.RequestForm.otr ==true">
                      Number of Pages (TOR):
                    </div>
                    <div class="col-md-1" ng-show="data.RequestForm.otr ==true">
                      <input type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.otrVal">
                    </div>
                  </div>

                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.hon"> Honorable Dismissal
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authGrad"> Authentication ( Graduate )
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authUGrad"> Authentication ( UnderGraduate )
                    </div>
                  </div>
                  <div class="row py-3"></div>
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.dip"> Diploma
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.rr"> Red Ribbon
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.lg"> List of Graduates
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 text-right pb-4 mb-3" ng-show="data.RequestForm.lg !=true">
                    </div>
                    <div class="col-md-7"></div>
                    <div class="col-md-2 text-right" ng-show="data.RequestForm.lg ==true">
                      Photocopy:
                    </div>
                    <div class="col-md-1 py-0" ng-show="data.RequestForm.lg ==true">
                      <input type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.lgVal">
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-2 mb-4">
                      <input icheck type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.other"> Others: <em>(please specify)</em>
                    </div>
                    <div class="col-md-2" ng-show="data.RequestForm.other ==true">
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.otherVal">
                    </div>
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
  <?php echo $this->element('modals/search/searched-student-modal') ?>

<style type="text/css">
  th {
    white-space: nowrap;
  }

  td {
    white-space: nowrap;
  }
</style>