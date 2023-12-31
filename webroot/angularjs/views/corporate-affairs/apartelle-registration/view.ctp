<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">VIEW APARTELLE APPLICATION INFORMATION</div>
        <div class="clearfix"></div><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped">

                <tr>
                  <th class="text-right"> CONTROL NO. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.code }}</td>
                </tr>

                <tr>
                  <th class="text-right" style="width:15%"> NICK NAME : </th>
                  <td class="italic">{{ data.ApartelleRegistration.nick_name }}</td>
                </tr>
                <tr>
                  <th class="text-right"> DATE OF BIRTH : </th>
                  <td class="italic">{{ data.ApartelleRegistration.date_of_birth }}</td>
                </tr>
                <tr>
                  <th class="text-right"> BIRTH PLACE : </th>
                  <td class="italic">{{ data.ApartelleRegistration.birth_place }}</td>
                </tr>
                <tr>
                  <th class="text-right"> ADDRESS : </th>
                  <td class="italic">{{ data.ApartelleRegistration.address }}</td>
                </tr>
                <tr>
                  <th class="text-right"> COURSE : </th>
                  <td class="italic">{{ data.Course.code }} - {{ data.Course.title }}</td>
                </tr>
                <tr>
                  <th class="text-right"> APARTELLE/DORMITORY : </th>
                  <td class="italic">{{ data.Apartelle.building_no }} - {{ data.Apartelle.room_no }}</td>
                </tr>
                <tr>
                  <th class="text-right"> YEAR LEVEL : </th>
                  <td class="italic">{{ data.YearLevelTerm.description }}</td>
                </tr>
                <tr>
                  <th class="text-right"> FATHER NAME : </th>
                  <td class="italic">{{ data.ApartelleRegistration.father_name }}</td>
                </tr>
                <tr>
                  <th class="text-right"> FATHER OCCUPATION : </th>
                  <td class="italic">{{ data.ApartelleRegistration.father_occupation }}</td>
                </tr>
                <tr>
                  <th class="text-right"> MOTHER NAME : </th>
                  <td class="italic">{{ data.ApartelleRegistration.mother_name }}</td>
                </tr>
                <tr>
                  <th class="text-right"> MOTHER OCCUPATION : </th>
                  <td class="italic">{{ data.ApartelleRegistration.mother_occupation }}</td>
                </tr>
                <tr>
                  <th class="text-right"> GUARDIAN : </th>
                  <td class="italic">{{ data.ApartelleRegistration.guardian }}</td>
                </tr>
                <tr>
                  <th class="text-right"> AGE : </th>
                  <td class="italic">{{ data.ApartelleRegistration.age }}</td>
                </tr>
                <tr>
                  <th class="text-right"> SEX : </th>
                  <td class="italic">{{ data.ApartelleRegistration.sex }}</td>
                </tr>
                <tr>
                  <th class="text-right"> RELIGION : </th>
                  <td class="italic">{{ data.ApartelleRegistration.religion }}</td>
                </tr>
                


              </table>
            </div> 
          </div>

          <h6>(For those not residing within 7 kilometers radius from the City Hall)</h6>

          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped">

                <tr>
                  <th class="text-right" style="width: 25%"> How often do you attend your religious duties? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.religious_duties }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Organizations where you are a member. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.organization_member }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Your forms of recreation. (List them) : </th>
                  <td class="italic">{{ data.ApartelleRegistration.recreation_list }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Hobbies : </th>
                  <td class="italic">{{ data.ApartelleRegistration.hobbies }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Type of reading material you enjoy. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.reading_materials }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Type of movies you enjoy. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.movies }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Games you play or you are interested in. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.games }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Do you have a boyfriend/gilfriend? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.bf_gf }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Address of boyfriend/gilfriend. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.bf_gf_address }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Do you know anybody in the College Community? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.anybody_cm }}</td>
                </tr>
                <tr>
                  <th class="text-right"> If yes, Please write his/her complete name. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.anybody_cm_name }}</td>
                </tr>
                <tr>
                  <th class="text-right"> If yes, Please write his/her complete address. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.anybody_cm_address }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Relationship with the person. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.anybody_cm_relationship }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Do you have relatives in the City? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.city_relatives }}</td>
                </tr>
                <tr>
                  <th class="text-right"> If yes, Please write his/her complete name. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.city_relatives_name }}</td>
                </tr>
                <tr>
                  <th class="text-right"> If yes, Please write his/her complete address. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.city_relatives_address }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Do you smoke? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.smoking_reason }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Why? : </th>
                  <td class="italic">{{ data.ApartelleRegistration.religion }}</td>
                </tr>
                <tr>
                  <th class="text-right"> Give your reason(s) for applying in the dormitory. : </th>
                  <td class="italic">{{ data.ApartelleRegistration.reasons }}</td>
                </tr>


              </table>
            </div> 
          </div>

         <!--  <div class="col-md-12">
            <div class="clearfix"></div><hr>
          </div>
          <div class="col-md-12">
            <h5>Uploaded Images</h5>
            <div class="clearfix"></div><hr>
          </div>
          <div class="col-md-12 table-wrapper">
            <div class="col-md-4" ng-repeat="image in apartelleImage">
              <img src="{{ image.imageSrc }}" width="100%" style="border-radius : 2px; margin-bottom : 10px; z-index: : 1;"  ng-click="viewImage(image.imageSrc)">
            </div>
          </div>

          <div class="col-md-12">
            <div class="clearfix"></div><hr>
          </div> -->
          <div class="col-md-12">
            <div class="pull-right">
             
                <a href="#/corporate-affairs/apartelle-registration/edit/{{ data.ApartelleRegistration.id }}" class="btn btn-primary btn-min"><i class="fa fa-edit"></i> EDIT </a>
             
              
             
                <button class="btn btn-danger btn-min" ng-click="remove(data.ApartelleRegistration)"><i class="fa fa-trash"></i> DELETE </button>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <style type="text/css">
  th {
    white-space: nowrap;
  }
  td {
    white-space: nowrap;
  }
</style>

<div class="modal fade" id="view-image-modal">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <img src="{{ image }}" width="100%" height="100%" style="border-radius : 2px; margin-bottom : 10px">
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-group-sm pull-right btn-min">
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"> CANCEL</button>
        </div>
      </div>
    </div>
  </div>
</div> -->