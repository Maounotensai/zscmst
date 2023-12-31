<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">SCHOLARSHIP APPLICATION</h4>
        <div class="clearfix"></div>
        <hr>
        <!-- nav tab start -->
        <div class="col-lg-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" data-target ="#pending" role="tab">PENDING</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" data-target ="#for_processing" role="tab">FOR PROCESSING</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" data-target ="#confirmed" role="tab">CONFIRMED</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" data-target ="#disapproved" role="tab">DISAPPROVED</a>
            </li>
          </ul>

          <div class="tab-content mt-3" id="myTabContent">
            <div class="clearfix"></div><hr>
            <div class="tab-pane fade show active" id="pending">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                    <a href="#/registrar/scholarship-application/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                    <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                    <button ng-click="print()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                        <th class="text-center"> CONTROL NO. </th>
                        <th class="text-center"> STUDENT NAME </th>
                        <th class="text-center"> DATE APPLIED </th>
                        <th class="text-center"> PROGRAM </th>
                        <th class="text-center"> AGE </th>
                        <th class="text-center"> SEX </th>
                        <th class="text-center"> STATUS </th>
                        <th class="w90px"></th>
                      </tr>
                    </thread>
                    <tbody>
                      <tr ng-repeat="data in datas">
                        <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                        <td class="text-center">{{ data.code }}</td>
                        <td class="text-center">{{ data.student_name }}</td>
                        <td class="text-center">{{ data.date }}</td>
                        <td class="text-center">{{ data.program }}</td>
                        <td class="text-center">{{ data.age }}</td>
                        <td class="text-center">{{ data.sex }}</td>
                        <td class="text-center">PENDING</td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            <a href="#/registrar/scholarship-application/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                            <a href="#/registrar/scholarship-application/edit/{{ data.id }}" class="btn btn-primary" ng-disabled="data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled="data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr ng-show="datas == null || datas == ''">
                        <td colspan="9">No available data</td>
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

            <div class="tab-pane fade show" id="for_processing">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                    <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                    <button ng-click="printApproved()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                        <th class="text-center"> CONTROL NO. </th>
                        <th class="text-center"> STUDENT NAME </th>
                        <th class="text-center"> DATE APPLIED </th>
                        <th class="text-center"> PROGRAM </th>
                        <th class="text-center"> AGE </th>
                        <th class="text-center"> SEX </th>
                        <th class="text-center"> STATUS </th>
                        <th class="w90px"></th>
                      </tr>
                    </thread>
                    <tbody>
                      <tr ng-repeat="data in datasApproved">
                        <td class="text-center">{{ (paginatorApproved.page - 1 ) * paginatorApproved.limit + $index + 1 }}</td>
                        <td class="text-center">{{ data.code }}</td>
                        <td class="text-center">{{ data.student_name }}</td>
                        <td class="text-center">{{ data.date }}</td>
                        <td class="text-center">{{ data.program }}</td>
                        <td class="text-center">{{ data.age }}</td>
                        <td class="text-center">{{ data.sex }}</td>
                        <td class="text-center">FOR PROCESSING</td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            <a href="#/registrar/scholarship-application/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr ng-show="datasApproved == null || datasApproved == ''">
                        <td colspan="9">No available data</td>
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
                    <li class="page-item prevPage {{ !paginatorApproved.prevPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.page - 1, search: searchTxt })">&laquo;</a>
                    </li>
                    <li ng-repeat="page in pagesApproved" class="page-item {{ paginatorApproved.page == page.number ? 'active':''}}">
                      <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                    </li>
                    <li class="page-item nextPage {{ !paginatorApproved.nextPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.page + 1, search: searchTxt })">&raquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                  <div class="text-center" ng-show="paginatorApproved.pageCount > 0">
                    <sup class="text-primary">Page {{ paginatorApproved.pageCount > 0 ? paginatorApproved.page : 0 }} out of {{ paginatorApproved.pageCount }}</sup>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade show" id="confirmed">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                    <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                    <button ng-click="printApproved()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                        <th class="text-center"> CONTROL NO. </th>
                        <th class="text-center"> STUDENT NAME </th>
                        <th class="text-center"> DATE APPLIED </th>
                        <th class="text-center"> PROGRAM </th>
                        <th class="text-center"> AGE </th>
                        <th class="text-center"> SEX </th>
                        <th class="text-center"> STATUS </th>
                        <th class="w90px"></th>
                      </tr>
                    </thread>
                    <tbody>
                      <tr ng-repeat="data in datasConfirmed">
                        <td class="text-center">{{ (paginatorConfirmed.page - 1 ) * paginatorConfirmed.limit + $index + 1 }}</td>
                        <td class="text-center">{{ data.code }}</td>
                        <td class="text-center">{{ data.student_name }}</td>
                        <td class="text-center">{{ data.date }}</td>
                        <td class="text-center">{{ data.program }}</td>
                        <td class="text-center">{{ data.age }}</td>
                        <td class="text-center">{{ data.sex }}</td>
                        <td class="text-center">CONFIRMED</td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            <a href="#/registrar/scholarship-application/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr ng-show="datasConfirmed == null || datasConfirmed == ''">
                        <td colspan="9">No available data</td>
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
                    <li class="page-item prevPage {{ !paginatorConfirmed.prevPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorConfirmed.page - 1, search: searchTxt })">&laquo;</a>
                    </li>
                    <li ng-repeat="page in pagesConfirmed" class="page-item {{ paginatorConfirmed.page == page.number ? 'active':''}}">
                      <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                    </li>
                    <li class="page-item nextPage {{ !paginatorConfirmed.nextPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorConfirmed.page + 1, search: searchTxt })">&raquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorConfirmed.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                  <div class="text-center" ng-show="paginatorConfirmed.pageCount > 0">
                    <sup class="text-primary">Page {{ paginatorConfirmed.pageCount > 0 ? paginatorConfirmed.page : 0 }} out of {{ paginatorConfirmed.pageCount }}</sup>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade show" id="disapproved">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                    <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                    <button ng-click="printDisapproved()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                        <th class="text-center"> CONTROL NO. </th>
                        <th class="text-center"> STUDENT NAME </th>
                        <th class="text-center"> DATE APPLIED </th>
                        <th class="text-center"> PROGRAM </th>
                        <th class="text-center"> AGE </th>
                        <th class="text-center"> SEX </th>
                        <th class="text-center"> STATUS </th>
                        <th class="w90px"></th>
                      </tr>
                    </thread>
                    <tbody>
                      <tr ng-repeat="data in datasDisapproved">
                        <td class="text-center">{{ (paginatorDisapproved.page - 1 ) * paginatorDisapproved.limit + $index + 1 }}</td>
                        <td class="text-center">{{ data.code }}</td>
                        <td class="text-center">{{ data.student_name }}</td>
                        <td class="text-center">{{ data.date }}</td>
                        <td class="text-center">{{ data.program }}</td>
                        <td class="text-center">{{ data.age }}</td>
                        <td class="text-center">{{ data.sex }}</td>
                        <td class="text-center">DISAPPROVED</td>
                        <td>
                          <div class="btn-group btn-group-xs">
                            <a href="#/registrar/scholarship-application/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                          </div>
                        </td>
                      </tr>
                      <tr ng-show="datasDisapproved == null || datasDisapproved == ''">
                        <td colspan="9">No available data</td>
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
                    <li class="page-item prevPage {{ !paginatorDisapproved.prevPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.page - 1, search: searchTxt })">&laquo;</a>
                    </li>
                    <li ng-repeat="page in pagesDisapproved" class="page-item {{ paginatorDisapproved.page == page.number ? 'active':''}}">
                      <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                    </li>
                    <li class="page-item nextPage {{ !paginatorDisapproved.nextPage? 'disabled':'' }}">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.page + 1, search: searchTxt })">&raquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                  <div class="text-center" ng-show="paginatorDisapproved.pageCount > 0">
                    <sup class="text-primary">Page {{ paginatorDisapproved.pageCount > 0 ? paginatorDisapproved.page : 0 }} out of {{ paginatorDisapproved.pageCount }}</sup>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('modals/advance-search/advance-search-date') ?>