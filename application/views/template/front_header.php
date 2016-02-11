
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">3 adults 2 rooms</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          	<div class="col-sm-6 rooms">
            	<h3>Room1</h3>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Adults</h4>
                        <h5>(12+)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Children</h4>
                        <h5>(0 - 11)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 rooms">
            	<h3>Room2</h3>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Adults</h4>
                        <h5>(12+)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
                <div class="row">
                	<div class="col-xs-4">
                    	<h4>Children</h4>
                        <h5>(0 - 11)</h5>
                    </div>
                    <div class="col-xs-8">
                    	<input type="number">
                    </div>
                </div>
            </div>
        </div>
        <a class="pull-right" href="#"> + Add more </a>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="header">
<!-----navigation_menu_start------->
<nav role="navigation" class="navbar navbar-default custome_nav">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-brand"><img src="<?php echo base_url();?>webroot/img/logo.png"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url("mainpage/index")?>">Home</a></li>
            <li><a href="<?php echo site_url("mainpage/accomodation")?>">Accomodation</a></li>
          <li><a href="<?php echo site_url("mainpage/diningout")?>">Activity</a></li>
       <!--        <li><a href="<?php //echo site_url("mainpage/thingtodo")?>">Things to do</a></li>
            <li><a href="<?php //echo site_url("mainpage/localpackage")?>">E-locals and pacakages</a></li>  --> 
            <li><a href="<?php echo site_url("mainpage/promotion")?>">Promotions</a></li>
            <li><a href="<?php echo site_url("mainpage/privilege")?>">Privilege</a></li>
     <!--       <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">EN <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li>EN</a></li>
                <li>TH</a></li>
               
              </ul>
            </li> -->
            <li class="dropdown">
            	<div class="after_login_profile">
                    <div data-toggle="dropdown" class="profile_menu dropdown-toggle">
                        <h2>เข้าสู่ระบบ</h2>
                        <div class="pic"><img src="<?php echo base_url();?>webroot/img/man.jpg"></div>
                        <span class="caret"></span>
                        <div class="clearfix"></div>
                    </div>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</div>
