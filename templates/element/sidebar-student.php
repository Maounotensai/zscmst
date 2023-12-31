<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="#/dashboard" class="site_title">&nbsp;<img width="49" height="49" src="<?php echo $base ?>/assets/img/zam.png"> <span>ZSCMST</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <?php if (is_null( $currentUser->image) &&  $currentUser->image == "" || !file_exists('uploads/users/'.$currentUser->id.'/'. $currentUser->image )) { ?>

          <img class="img-circle profile_img" src="<?= $base ?>assets/img/user.jpg">

        <?php } else { ?>

          <img class="img-circle profile_img" src="<?php echo $base . '/uploads/users/'.$currentUser->id.'/'. $currentUser->image  ?>">

        <?php  }?>
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $currentUser->first_name.' '. $currentUser->last_name ?> </h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">  
        <ul class="nav side-menu">

          <li class="nav-link-side nav-dashboard"><a href="#/dashboard" onclick="change('dashboard')"><i class="fa fa-dashboard"></i> Dashboard </a></li>

          <li class="nav-link-side nav-enrollment"><a href="#/enrollment" onclick="change('enrollment')"><i class="fa fa-user-plus"></i> Enrollment </a></li>

          <li class="nav-link-side nav-enrolled-course"><a href="#/registrar/prospectus/view-student/<?php echo $currentUser->studentId ?>" onclick="change('enrolled-course')"><i class="fa fa-list-alt"></i> Enrolled Courses </a></li>

          <li class="nav-link-side nav-scholarship-application"><a href="#/admission/scholarship-application" onclick="change('scholarship-application')"><i class="ti ti-write"></i> Scholarship Application </a></li>

          <li class="nav-link-side nav-request-form"><a><i class="fa fa-briefcase"></i> Registrar </a>
            <ul class="nav child_menu collapse collapse-request-form ">
              
              <li class="nav-link-side nav-request-form">
                  <a href="#/registrar/request-form" onclick="change('request-form')">Request Form</a>
              </li>

              <li class="nav-link-side nav-adding-dropping-subject">
                <a href="#/registrar/adding-dropping-subject" onclick="change('adding-dropping-subject')">Adding/Dropping Subject</a>
              </li>
              
              <li class="nav-link-side nav-student-club">
                <a href="#/registrar/student-club" onclick="change('student-club')">Student Clubs Application</a>
              </li>

            </ul>
          </li>

          <li class="nav-link-side nav-counseling-appointment nav-gco-evaluation"><a><i class="fa fa-users"></i> Guidance & Counseling </a>
            <ul class="nav child_menu collaps collapse-counseling-appointment collapse-gco-evaluation">
              <li class="nav-link-side nav-counseling-appointment">
                <a href="#/guidance/counseling-appointment" onclick="change('counseling-appointment')">Counseling Appointment</a>
              </li>
              <li class="nav-link-side nav-gco-evaluation">
                <a href="#/guidance/gco-evaluation" onclick="change('gco-evaluation')">GCO Evaluation</a>
              </li>
            </ul>
          </li> 

          <li class="nav-link-side nav-medical-consent"><a><i class="fa fa-medkit"></i> Health & Medical Services </a>
            <ul class="nav child_menu collaps collapse-medical-consent">

             <!--  <li class="nav-link-side nav-medical-student-log">
                <a href="#/medical-services/student-log/student-index" onclick="change('student-log')">Log</a>
              </li>  -->
              
              <li class="nav-link-side nav-medical-consent">
                <a href="#/medical-services/medical-consent" onclick="change('medical-consent')">Medical Consent</a>
              </li>

              <li class="nav-link-side nav-consultation">
                <a href="#/medical-services/consultation/student-index" onclick="change('consultation')">Consultation</a>
              </li>

              <li class="nav-link-side nav-dental">
                <a href="#/medical-services/dental/student-index" onclick="change('dental')">Dental</a>
              </li>

              
              <li class="nav-link-side nav-medical-certificate">
                <a href="#/medical-services/medical-certificate/student-index" onclick="change('medical-certificate')">Medical Certificate Request</a>
              </li>
              <li class="nav-link-side nav-referral-recommendation">
                <a href="#/medical-services/referral-recommendation/student-index" onclick="change('referral-recommendation')">Referral Recommendation</a>
              </li>


            </ul>
          </li>
          
          <li class="nav-link-side nav-bibliography">
            <a href="#/learning-resource-center/bibliography" onclick="change('bibliography')"><i class="ti ti-book"></i> Bibliography</a>
          </li>

          <li class="nav-link-side nav-apartelle-registration"><a href="#/corporate-affairs/apartelle-registration" onclick="change('apartelle-registration')"><i class="fa fa-building"></i> Apartelle Registration </a></li>
        
  
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->
  </div>
</div>