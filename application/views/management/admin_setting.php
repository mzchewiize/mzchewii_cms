
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Payment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <h3 class="page-header" style="margin-top:-10px;text-align:right">Paysbuy setting<br/>
                <small>Setting for payment paysbuy</small>
            </h3>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 text-left"> 
                    <form id="edit_account"  method="post" action="<?php echo site_url('wizcationadmin/update_paysbuy');?>" class="form-horizontal">
                   
                        <div class="form-group">
                            <label for="nameText" class="control-label col-sm-3">Paysbuy PSDID<span class="text-danger">*</span> : </label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="paysbuy_psb" name="paysbuy_psb" value="<?php echo @$paysbuy[0]['paysbuy_psb'];?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="nameText" class="control-label col-sm-3">Paysbuy username<span class="text-danger">*</span> : </label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="paysbuy_username" name="paysbuy_username" value="<?php echo @$paysbuy[0]['paysbuy_username'];?>"></div>
                        </div>
                        <div class="form-group">
                            <label for="nameText" class="control-label col-sm-3">Paysbuy secure code<span class="text-danger">*</span> : </label>
                            <div class="col-sm-9"><input type="text" class="form-control" id="paysbuy_secure_code" name="paysbuy_secure_code" value="<?php echo @$paysbuy[0]['paysbuy_secure_code'];?>"></div>
                        </div>
                       
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Submit</button>
                        </div> 
                    </form> 
                </div>
            </div>
            <hr/>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
