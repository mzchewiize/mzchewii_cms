<style>
    .dash_profile_page .dash_left ul li a
    {
        color:black;
        text-decoration: none;
    }
    a:link {
        text-decoration: none;
    }
</style>
<?php if($header_user[0]['user_group']==5) { ?>
<nav>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
             <ul class="nav" id="side-menu">       
                <li>
                    <a href="<?php echo site_url('wizcationadmin/website'); ?>"><i class="fa fa-bar-chart-o fa-fw"></i> Website Setting<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('wizcationadmin/amenities'); ?>"><i class="fa fa-wrench fa-fw"></i>Group items & customize</a></li> 
                     <!--        <li><a href="<?php echo site_url('wizcationadmin/catergory'); ?>"><i class="fa fa-wrench fa-fw"></i>Catergory & customize</a></li>          
                      -->       <li><a href="<?php echo site_url('wizcationadmin/static_page'); ?>"><i class="fa fa-wrench fa-fw"></i> Static page</a></li>
                        </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Content Quality<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('wizcationadmin/content_accomodation'); ?>"><i class="fa fa-files-o fa-fw"></i> All Accomodation</a></li>
                    <li><a href="<?php echo site_url('wizcationadmin/content_partner'); ?>"><i class="fa fa-files-o fa-fw"></i> All Partner</a></li>
                     </ul>
                </li>
                <li><a href="<?php echo site_url('wizcationadmin/member'); ?>"><i class="fa fa-sitemap fa-fw"></i>Member management</a></li>
                <li><a href="<?php echo site_url('wizcationadmin/broadcast'); ?>"><i class="fa fa-sitemap fa-fw"></i>Broadcast message</a></li>
                <li><a href="<?php echo site_url('wizcationadmin/partner'); ?>"><i class="fa fa-sitemap fa-fw"></i>Partner Infomation</a></li>
                <li><a href="<?php echo site_url('wizcationadmin/setting'); ?>"><i class="fa fa-money fa-fw"></i> Payment setting</a></li>
                <li><a href="<?php echo site_url('main/logout'); ?>"><i class="fa fa-edit fa-fw"></i> Sign out</a></li>
               
            </ul>
        </div>
    </div>
</nav>

<?php } else if(in_array($header_user[0]['user_group'] , array('2','3','4'))) { ?>
<nav>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
             <ul class="nav" id="side-menu">       
                <li><a href="<?php echo site_url('malongyeradmin/main_content'); ?>"><i class="fa fa-sitemap fa-fw"></i>ALBUM Management</a></li>
              <li><a href="<?php echo site_url('main/logout'); ?>"><i class="fa fa-edit fa-fw"></i> Sign out</a></li>
               
            </ul>
        </div>
    </div>
</nav>
<?php } else { ?>
<div class="dash_left" style="height:805px;margin-top:40px;">
    <ul>
        <li style="background-color:blue;color:white;"><span class="glyphicon glyphicon-stats"></span>Menu</li>
        <a href="<?php echo site_url('main/overview'); ?>"><li><span class="glyphicon glyphicon-stats"></span>Accomodation overview</li></a>
        <?php if(in_array($header_user[0]['user_group'],array("2", "3", "4"))) {  ?>        
        <a href="<?php echo site_url('property/appinfomation'); ?>"><li><span class="glyphicon glyphicon-info-sign"></span> Infomation</li></a>
        <?php } else {?>
        <a href="<?php echo site_url('infomation/description'); ?>"><li><span class="glyphicon glyphicon-info-sign"></span>Description</li></a>
        <a href="<?php echo site_url('property/infomation'); ?>"><li><span class="glyphicon glyphicon-info-sign"></span>Accommodation Info</li></a> 
        <a href="<?php echo site_url('profile/room'); ?>"><li><span class="glyphicon glyphicon-th"></span>Room listing</li></a>
         <?php } ?>
        <a href="<?php echo site_url('report/self_report'); ?>"><li><span class="glyphicon glyphicon-calendar"></span>Report</li></a>
       
        <a href="<?php echo site_url('miscellaneous/policy'); ?>"><li><span class="glyphicon glyphicon-text-width"></span>Policy</li></a>
        <!-- <a href="<?php echo site_url('guest/transaction'); ?>"><li><span class="glyphicon glyphicon-calendar"></span>My guests</li></a>
         --><a href="<?php echo site_url('main/logout'); ?>"><li><span class="glyphicon glyphicon-off"></span>Sign out</li></a>
    </ul>
</div>
<?php } ?>

