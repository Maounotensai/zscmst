<?php if (hasAccess('property & equipment/index', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">PROPERTY & EQUIPMENT LOG MANAGEMENT</h4>
        <div class="clearfix"></div><hr>
        <!-- nav tab start -->
          <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" data-target ="#medical-equipment" role="tab">MEDICAL EQUIPMENT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#dental-equipment" role="tab">DENTAL EQUIPMENT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#medical-supplies" role="tab">MEDICAL SUPPLIES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#dental-supplies" role="tab">DENTAL SUPPLIES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#medicine" role="tab">MEDICINE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#others" role="tab">OTHERS</a>
              </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">

          <div class="tab-pane fade show active" id="medical-equipment">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printMedicalEquipment()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasMedicalEquipment">
                      <td class="text-center">{{ (paginatorDentalEquipment.page - 1 ) * paginatorDentalEquipment.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('counseling appointment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('counseling appointment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasMedicalEquipment == null || datasMedicalEquipment == ''">
                      <td colspan="12">No available data</td>
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
                  <li class="page-item prevPage {{ !paginatorDentalEquipment.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorMedicalEquipment.page - 1, search: searchTxt })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesMedicalEquipment" class="page-item {{ paginatorMedicalEquipment.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorMedicalEquipment.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorMedicalEquipment.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorMedicalEquipment.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorMedicalEquipment.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorMedicalEquipment.pageCount > 0 ? paginatorMedicalEquipment.page : 0 }} out of {{ paginatorMedicalEquipment.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="dental-equipment">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printDentalEquipment()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasDentalEquipment">
                      <td class="text-center">{{ (paginatorDentalEquipment.page - 1 ) * paginatorDentalEquipment.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('property & equipment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasDentalEquipment == null || datasDentalEquipment == ''">
                      <td colspan="12">No available data</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorDentalEquipment.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalEquipment.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesDentalEquipment" class="page-item {{ paginatorDentalEquipment.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="medicine({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorDentalEquipment.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalEquipment.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalEquipment.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorDentalEquipment.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorDentalEquipment.pageCount > 0 ? paginatorDentalEquipment.page : 0 }} out of {{ paginatorDentalEquipment.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="medical-supplies">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printMedicalSupplies()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasMedicalSupplies">
                      <td class="text-center">{{ (paginatorMedicalSupplies.page - 1 ) * paginatorMedicalSupplies.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('property & equipment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasMedicalSupplies == null || datasMedicalSupplies == ''">
                      <td colspan="12">No available data</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorMedicalSupplies.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicalSupplies.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesMedicalSupplies" class="page-item {{ paginatorMedicalSupplies.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="medicine({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorMedicalSupplies.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicalSupplies.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicalSupplies.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorMedicine.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorMedicalSupplies.pageCount > 0 ? paginatorMedicalSupplies.page : 0 }} out of {{ paginatorMedicalSupplies.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="dental-supplies">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printDentalSupplies()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasDentalSupplies">
                      <td class="text-center">{{ (paginatorDentalSupplies.page - 1 ) * paginatorDentalSupplies.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('property & equipment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasDentalSupplies == null || datasDentalSupplies == ''">
                      <td colspan="12">No available data</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorDentalSupplies.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalSupplies.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesDentalSupplies" class="page-item {{ paginatorDentalSupplies.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="medicine({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorDentalSupplies.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalSupplies.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorDentalSupplies.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorDentalSupplies.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorDentalSupplies.pageCount > 0 ? paginatorDentalSupplies.page : 0 }} out of {{ paginatorDentalSupplies.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="medicine">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printMedicine()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasMedicine">
                      <td class="text-center">{{ (paginatorMedicine.page - 1 ) * paginatorMedicine.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('property & equipment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasMedicine == null || datasMedicine == ''">
                      <td colspan="12">No available data</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorMedicine.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicine.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesMedicine" class="page-item {{ paginatorMedicine.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="medicine({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorMedicine.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicine.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine({ page: paginatorMedicine.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorMedicine.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorMedicine.pageCount > 0 ? paginatorMedicine.page : 0 }} out of {{ paginatorMedicine.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="others">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <?php if (hasAccess('property & equipment/add', $currentUser)): ?>
                    <a href="#/medical-services/property-log/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                  <?php endif ?>
                  <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                  <?php if (hasAccess('property & equipment/print', $currentUser)): ?>
                    <button ng-click="printOthers()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
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
            <div class="clearfix"></div><hr>
            <div class="single-table mb-5">
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                  <thread>
                    <tr class="bg-info">
                      <th class="text-center w30px">#</th>

                      <th class="text-center"> PROPERTY NAME </th>
                      <th class="text-center"> TYPE </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> MANUFACTURING DATE </th>
                      <th class="text-center"> BATCH NUMBER </th>
                      <th class="text-center"> EXPIRATION DATE </th>
       
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasOthers">
                      <td class="text-center">{{ (paginatorOthers.page - 1 ) * paginatorOthers.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.property_name }}</td>
                      <td class="text-center">{{ data.type }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.manufacturing_date }}</td>
                      <td class="text-center">{{ data.batch_no }}</td>
                      <td class="text-center">{{ data.expiration_date }}</td>
                        <span ng-if="data.type == 'equipment'" class="label label-success"> PROPERTY NAME </span>
                        <span ng-if="data.type == 'medicine'" class="label label-danger"> TYPE </span>
                        <span ng-if="data.type == 'medicine_kit'" class="label label-danger"> DATE </span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('property & equipment/view', $currentUser)): ?>
                          <a href="#/medical-services/property-log/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/edit', $currentUser)): ?>
                          <a href="#/medical-services/property-log/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('property & equipment/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasOthers == null || datasOthers == ''">
                      <td colspan="12">No available data</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine_kit({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
                  </li>
                  <li class="page-item prevPage {{ !paginatorOthers.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine_kit({ page: paginatorOthers.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesOthers" class="page-item {{ paginatorOthers.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="medicine_kit({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorOthers.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine_kit({ page: paginatorOthers.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="medicine_kit({ page: paginatorOthers.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorOthers.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorOthers.pageCount > 0 ? paginatorOthers.page : 0 }} out of {{ paginatorOthers.pageCount }}</sup>
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