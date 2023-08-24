<!DOCTYPE html>
<html>
<head>
  <title>Login >> Zamboanga State College of Marine Sciences and Technology - MCP INC. - Electronic Student Management Information System - Copyright <?php echo date('Y')?></title>
  <link rel="stylesheet" href="<?php echo $base ?>/assets/plugins/bootstrap-3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $base ?>/assets/css/login.css">
  <link rel="stylesheet" href="<?php echo $base ?>/assets/plugins/font-awesome-4.2.0/css/font-awesome.css">
  <script type="text/javascript" src="<?php echo $base ?>/assets/plugins/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $base ?>/assets/js/svg-icon.js"></script>
  <link rel="icon" href = "<?php echo $base ?>/assets/img/zam.png">
</head>
<body>
  <section id="login">
    <div class="row">
      <div class="col-md-3 col-md-offset-3" style="padding-top:-30px;">
        <img src="<?php echo $base ?>/assets/img/mcp-zam.png" width="100%" style="float:left;margin-left:0;"> 
        <div class="clearfix"></div>
      </div>
      <div class="col-md-6">
        <header>
          <p style="font-size:3rem;text-align: left;margin-top: 10%;margin-bottom: -5px"><font face="Times New Roman"></font></p>
          <h1 style="font-size:75px;text-align: left;"><font face="Times New Roman">ESMIS</font></h1>
          <p style="font-size:2rem;text-align: left;"><font face="Times New Roman">Electronic Student Management Information System</font></p>
        </header>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>
  <div class="col-md-12" style="margin:auto;padding:0px 0px 20px 0px">
  <div class="col-md-4" style="margin-top: 2%">
  </div>
  <div class="col-md-4" style="margin-top: 2%">
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

  </div>

  <div class="col-md-4" style="margin-top: 2%">

  </div>
</div>

    
  <div style="  color: #FFF;
    font-size:12px;
    width: 100%;
    position:fixed;
    margin-top:130px;

    bottom: 0px;
    padding: 0px;
    background: rgba(0,0,0,0.15);
">
        <div class="copyright">COPYRIGHT &copy <script>document.write(new Date().getFullYear())</script> | ALL RIGHTS RESERVED</div>
        <div class="poweredby">POWERED BY: <a href="http://mycreativepanda.com"> My Creative Panda Web Design and Development Consultancy Services</a></div>
    </div>

