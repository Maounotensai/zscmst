

<div class="row">
<div class="col-lg-12 mt-3">
  <div class="card">
    <div class="card-body">
      <h4 class="header-title">DENTAL</h4>
      <div class="clearfix"></div><hr>
      <!-- nav tab start -->
        <div class="col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" data-target ="#pending" role="tab">PENDING</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" data-target ="#approve" role="tab">APPROVE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " data-toggle="tab" data-target ="#disapprove" role="tab">DISAPPROVE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" data-target ="#treated" role="tab">TREATED</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" data-target ="#referred" role="tab">REFERRED</a>
          </li>
        </ul>

        <div class="tab-content mt-3" id="myTabContent">

          <div class="tab-pane fade show active" id="pending">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <a href="#/medical-services/dental/student-add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
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
                    <th class="text-center"> PATIENT NAME </th>
                    <th class="text-center"> DATE </th>
                    <th class="text-center"> PROGRAM </th>
                    <th class="text-center"> YEAR </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datas">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-left">{{ data.patient_name }}</td>
                    <td class="text-center">{{ data.date }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-center">{{ data.year }}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <a href="#/medical-services/dental/student-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                    
                        <a href="#/medical-services/dental/student-edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                  
                        <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                   
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datas == null || datas == ''">
                    <td colspan="8">No available data</td>
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
                    <a class="page-link" href="javascript:void(0)"ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginator.pageCount > 0">
                  <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show " id="approve">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                
                  <a href="#/medical-services/dental/student-add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
             
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <button ng-click="printApprove()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                    <th class="text-center"> PATIENT NAME </th>
                    <th class="text-center"> DATE </th>
                    <th class="text-center"> COURSE </th>
                    <th class="text-center"> YEAR </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datasApprove">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-left">{{ data.patient_name }}</td>
                    <td class="text-center">{{ data.date }}</td>
                    <td class="text-center">{{ data.course }}</td>
                    <td class="text-center">{{ data.year }}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <a href="#/medical-services/dental/student-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                    
                        <a href="#/medical-services/dental/student-edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                  
                        <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                   
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datasApprove == null || datasApprove == ''">
                    <td colspan="8">No available data</td>
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
                    <a class="page-link" href="javascript:void(0)"ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginator.pageCount > 0">
                  <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show " id="disapprove">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
               
                  <a href="#/medical-services/dental/student-add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
            
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <button ng-click="printDisapprove()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                    <th class="text-center"> PATIENT NAME </th>
                    <th class="text-center"> DATE </th>
                    <th class="text-center"> COURSE </th>
                    <th class="text-center"> YEAR </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datasDisapprove">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-left">{{ data.patient_name }}</td>
                    <td class="text-center">{{ data.date }}</td>
                    <td class="text-center">{{ data.course }}</td>
                    <td class="text-center">{{ data.year }}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <a href="#/medical-services/dental/student-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                    
                        <a href="#/medical-services/dental/student-edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                  
                        <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                   
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datasDisapprove == null || datasDisapprove == ''">
                    <td colspan="8">No available data</td>
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
                    <a class="page-link" href="javascript:void(0)"ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginator.pageCount > 0">
                  <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="treated">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <button ng-click="printTreated()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                    <th class="text-center"> PATIENT NAME </th>
                    <th class="text-center"> DATE </th>
                    <th class="text-center"> COURSE </th>
                    <th class="text-center"> YEAR </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datasTreated">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-left">{{ data.patient_name }}</td>
                    <td class="text-center">{{ data.date }}</td>
                    <td class="text-center">{{ data.course }}</td>
                    <td class="text-center">{{ data.year }}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <a href="#/medical-services/dental/student-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                    
                        <a href="#/medical-services/dental/student-edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                  
                        <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                   
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datasTreated == null || datasTreated == ''">
                    <td colspan="8">No available data</td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="treated({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorTreated.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="treated({ page: paginatorTreated.page - 1, search: searchTxt })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesTreated" class="page-item {{ paginatorTreated.page == page.number ? 'active':''}}">
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="treated({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorTreated.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="treated({ page: paginatorTreated.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"ng-click="treated({ page: paginatorTreated.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorTreated.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorTreated.pageCount > 0 ? paginatorTreated.page : 0 }} out of {{ paginatorTreated.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="referred">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <button ng-click="printReferred()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i>PRINT</button>
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
                    <th class="text-center"> PATIENT NAME </th>
                    <th class="text-center"> DATE </th>
                    <th class="text-center"> COURSE </th>
                    <th class="text-center"> YEAR </th>
                    <th class="w90px"></th>
                  </tr>
                </thread>
                <tbody>
                  <tr ng-repeat="data in datasReferred">
                    <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                    <td class="text-center">{{ data.code }}</td>
                    <td class="text-left">{{ data.patient_name }}</td>
                    <td class="text-center">{{ data.date }}</td>
                    <td class="text-center">{{ data.course }}</td>
                    <td class="text-center">{{ data.year }}</td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <a href="#/medical-services/dental/student-view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                    
                        <a href="#/medical-services/dental/student-edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                  
                        <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                   
                      </div>
                    </td>
                  </tr>
                  <tr ng-show="datasReferred == null || datasReferred == ''">
                    <td colspan="8">No available data</td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="referred({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorReferred.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="referred({ page: paginatorReferred.page - 1, search: searchTxt })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesReferred" class="page-item {{ paginatorReferred.page == page.number ? 'active':''}}">
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="referred({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorReferred.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="referred({ page: paginatorReferred.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"ng-click="referred({ page: paginatorReferred.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorReferred.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorReferred.pageCount > 0 ? paginatorReferred.page : 0 }} out of {{ paginatorReferred.pageCount }}</sup>
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