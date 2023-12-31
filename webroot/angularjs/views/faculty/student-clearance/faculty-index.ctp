<?php if (hasAccess('student clearance/index', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">STUDENT CLEARANCE</h4>
        <div class="clearfix"></div>
        <hr>
        <!-- nav tab start -->
        <div class="col-lg-12">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                <?php if (hasAccess('student clearance/add', $currentUser)): ?>
                <a href="#/faculty/student-clearance/faculty-add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                <?php endif ?>
                <?php if (hasAccess('student clearance/print', $currentUser)): ?>
                <button ng-click="print()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
                <?php endif ?>
                <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
              </div>
              <div class="col-md-4 col-xs-12 pull-right">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control search" ng-enter="searchy(searchTxt)" placeholder="SEARCH HERE" ng-model="searchTxt">
                </div>
                <sup style="font-color:gray">Press Enter to search</sup>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div class="single-table mb-5">
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <thread>
                  <tr class="bg-info">
                    <th class="text-center w30px">#</th>
                    <th class="text-center"> STUDENT NAME </th>
                    <th class="text-center"> STATUS CLEARED </th>
                    <th class="text-center"> REMARKS </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datas">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-left">{{ data.student_name }}</td>
                    <td class="text-center">CLEARED</td>
                    <td class="text-center">INC</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <?php if (hasAccess('student clearance/view', $currentUser)): ?>
                        <a href="#/faculty/student-clearance/faculty-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datas == null || datas == ''">
                    <td colspan="10">No available data</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                </li>
                <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                  <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page - 1, search: searchTxt })">&laquo;</a>
                </li>
                <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}">
                  <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                </li>
                <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                  <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page + 1, search: searchTxt })">&raquo;</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                </li>
              </ul>
              <div class="clearfix"></div>
              <div class="text-center" ng-show="paginator.pageCount > 0">
                <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<?php echo $this->element('modals/advance-search/advance-search-date') ?>