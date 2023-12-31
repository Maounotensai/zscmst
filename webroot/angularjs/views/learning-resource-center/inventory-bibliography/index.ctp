<?php if (hasAccess('inventory bibliography/index', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">INVENTORY BIBLIOGRAPHY</h4>
        <div class="clearfix"></div><hr>
        <!-- nav tab start -->
          <div class="col-lg-12">
      
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('inventory-bibliography/print', $currentUser)): ?>
                    <button ng-click="print()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
                  <?php endif ?>
                  <?php if (hasAccess('inventory-bibliography/print', $currentUser)): ?>
                  <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                  <?php endif ?>
                  <?php if (hasAccess('inventory-bibliography management/print', $currentUser)): ?>
                  <!-- <button type="button" class="btn btn-primary  btn-min" ng-click="export()"><i class="fa fa-file-excel-o"></i> EXPORT </button> -->
                  <?php endif ?>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="myTable">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>
                      <th class="text-center"> CONTROL NO. </th>
                      <th class="text-center"> TITLE </th>
                      <th class="text-center"> AUTHOR </th>
                      <th class="text-center"> TERMS OF AVAILABILITY </th>
                      <th class="text-center"> QUANTITY </th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datas">
                      <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                      <td class="text-center"><a href="#/learning-resource-center/inventory-bibliography/view/{{ data.id }}" class="mydata" style="color:black;">{{ data.code }}</a></td>
                      <td class="text-center uppercase">{{ data.title }}</td>
                      <td class="text-center uppercase">{{ data.author }}</td>
                      <td class="text-center uppercase">{{ data.terms }}</td>
                      <td class="text-center">{{ data.quantity }}</td>
                    </tr>
                    <tr ng-show="datas == null || datas == ''">
                      <td colspan="7">No available data</td>
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
                  <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
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

<div class="modal fade" id="advance-search-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADVANCE SEARCH</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>FILTER BY</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
              </div>
              <select class="form-control input-sm" ng-model="search.filterBy">
                <option value="date">DATE</option>
                <option value="today">TODAY</option>
                <option value="month">MONTH</option>
                <option value="this-month">THIS MONTH</option>
                <option value="custom-range">CUSTOM RANGE</option>
              </select>
            </div>
          </div>
        </div>
        <div ng-show="search.filterBy == 'custom-range'">
          <div class="col-md-12">
            <div class="input-group input-daterange mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="text" class="form-control input-sm uppercase" ng-model="search.startDate">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="text" class="form-control input-sm uppercase" ng-model="search.endDate">
            </div>
          </div>  
        </div>  
        <div ng-show="search.filterBy == 'month'">
          <div class="col-md-12">
            <div class="form-group">
              <label>MONTH</label>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control monthpicker input-sm uppercase" ng-model="search.month">
              </div>
            </div>
          </div>
        </div>
        <div ng-show="search.filterBy == 'date'">
          <div class="col-md-12">
            <div class="form-group">
              <label>DATE</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control datepicker input-sm uppercase" ng-model="search.date">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <div class="btn-group btn-group-sm pull-right btn-min"> -->
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"> CANCEL</button>
          <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="searchFilter(search)"> SEARCH</button>
        <!-- </div>  -->
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>

<style>

  a.mydata {
     --c:linear-gradient(#000 0 0); /* update the color here */
  
    padding-bottom: .15em;
    background: var(--c), var(--c);
    background-size: .3em .1em;
    background-position:50% 100%;
    background-repeat: no-repeat;
    transition: .3s linear, background-size .3s .2s linear;    
  }
  a.mydata:hover {
    background-size: 40% .1em;
    background-position: 10% 100%, 90% 100%;    
  }
 
</style>