<style>
    .navbar-default .navbar-nav>li>a
    {
        color:white;
    }
    .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus
    {
        background: #018ad3;
        color: #FFF;	
    }
    .span4 { width:370px; float:left;margin-top:3px;}
    .span5 { width:370px; float:right;margin-top:3px;}

</style>
<script>
    $('.textarea').wysihtml5();
    $(document).ready(function (e) {
        $('#country').flagStrap();

        var ww = $(window).width();
        if (ww > 550) {
            var ht = $(".dash_profile_page").height();
            $(".dash_left").height(ht);
        }
        else {
            $(".dash_left").height("auto");
        }

        $(window).on("resize", function () {
            $(".dash_left").height("auto");
            var ww = $(window).width();
            if (ww > 540) {
                var ht = $(".dash_profile_page").height();
                $(".dash_left").height(ht);
            }
            else {
                $(".dash_left").height("auto");
            }
        });
    });
</script>
<div class="header after_login container">

            <div class="navbar-header">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="#" class="navbar-brand"><img src="<?php echo base_url(); ?>webroot/img/logo.png"></a>
            </div>
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
          <?php if($header_user[0]['user_group']==1) { ?>
                <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php echo $header_user[0]['login_name']; ?> <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo site_url('user/profile'); ?>">Profile</a></li>
                                    <li><a href="<?php echo site_url('miscellaneous/inbox'); ?>">Inbox</a></li>
                                    <li><a href="<?php echo site_url('guest/transaction'); ?>">My guests</a></li>
                                    <li><a href="<?php echo site_url('miscellaneous/setting'); ?>">Account setting</a></li>
                                    <li><a href="<?php echo site_url('main/logout'); ?>">Logout</a></li>
                                </ul>
                    </li>
                </ul>
               <?php } else if(in_array($header_user[0]['user_group'], array('2','3','4'))) { ?>
       
            <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <?php echo $header_user[0]['login_name']; ?> <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="<?php echo site_url('wizcationpartner/main_inbox'); ?>"><i class="fa fa-sitemap fa-fw"></i>Inbox</a></li>
                                <li><a href="<?php echo site_url('wizcationpartner/main_setting'); ?>"><i class="fa fa-money fa-fw"></i> Account Setting</a></li>
                                <li><a href="<?php echo site_url('main/logout'); ?>">Logout</a></li>
                            </ul>
                    </li>
                </ul>
            <?php } else { ?>
            <ul class="nav navbar-nav navbar-right">
                   <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php echo $header_user[0]['login_name']; ?> <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                             <li><a href="<?php echo site_url('main/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
            </div>
        </div>
    </nav>
</div>
