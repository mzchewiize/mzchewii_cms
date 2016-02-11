<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="padding:10px;"><?php echo $info;?></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo site_url('main/login');?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" name="user_login" id="user_login" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="password" id="password" type="password">
                                </div>
                               <!-- Change this to a button or input when using this as a form -->

                                <input type="submit" class="btn btn-default" value="Login">
                             
                            </fieldset>
                            <div class="danger"><?php echo @$danger;?></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
