<?php if (hasAccess('room management/index', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">ROOM MANAGEMENT</h4>
        <div class="clearfix"></div><hr>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
              <?php if (hasAccess('room management/add', $currentUser)): ?>
                <a href="#/room/add" class="btn btn-primary btn-sm btn-min"><i class="fa fa-plus"></i> ADD RECORD </a>
              <?php endif ?> 
              <button type="button" class="btn btn-warning btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
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
            <table class="table table-bordered text-center">
              <thead>
                <tr class="bg-info">
                  <th class="w10px" style="width: 50px">#</th>
                  <th style="width: 150px">CODE</th>
                  <th>NAME</th>
									<th>BUILDING</th>
                  <th>SIZE</th>
									<th>CAPACITY</th>
             	    <th class="w90px"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="data in datas">
                  <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                  <td class="text-center">{{ data.code }}</td>
                  <td class="text-left">{{ data.name }}</td>
                  <td class="text-left">{{ data.building }}</td>
                  <td class="text-left">{{ data.size }}</td>
                  <td class="text-center">{{ data.capacity }}</td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <?php if (hasAccess('room management/view', $currentUser)): ?>
                      	<a href="#/room/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                      <?php endif ?> 
                      <?php if (hasAccess('room management/edit', $currentUser)): ?>
                      	<a href="#/room/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a>
                      <?php endif ?> 
                      <?php if (hasAccess('room management/delete', $currentUser)): ?>
                      <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                      <?php endif ?> 
                    </div>
                  </td> 
                </tr>
                <tr ng-show="datas == null || datas == ''">
                  <td colspan="7">No available data</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="clearfix"></div>
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
<?php endif ?>
