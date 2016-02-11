    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">  
                    <div class="row" style="margin-top:50px;">
                        <h3 class="page-header" style="margin-top:-10px">Profile<br/>
                            <small>Update your personal profile</small>
                        </h3>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form class="form-horizontal dash_pro_home"  id="dashProfile" method="post" action="<?php echo site_url('wizcationpartner/submit_partner_profile') ?>" role="form">
            <div class="form-group" >
                <label class="control-label">First Name</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" onkeyup="javascript:not_number(this.value);" name="first_name" id="first_name" value="<?php echo @$user_data[0]['first_name'];?>" >
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Last Name</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" onkeyup="javascript:not_number(this.value);" name="last_name" id="last_name"  value="<?php echo @$user_data[0]['last_name'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Email</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" readonly name="email" value="<?php echo @$user_data[0]['email'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Nationality</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" onkeyup="javascript:not_number(this.value);" name="nationality" id="nationality" value="<?php echo @$user_data[0]['nationality'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Country</label>
                <div class="control_inputs">
                    <select id="country_id" name="country_id" class="form-control"  style="width:370px">
                        <option value="">Please select country</option>
                        <?php for($i=0;$i<count($country);$i++){  ?>
                            <option <?php echo ($country[$i]['country_id']==$user_data[0]['country_id']) ? "selected" : "";?> value="<?php echo $country[$i]['country_id'];?>"><?php echo $country[$i]['country_name'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Backup Email</label>
                <div class="control_inputs">
                    <input type="email" class="form-control" style="width:50%" name="backup_email" value="<?php echo $user_data[0]['backup_email'];?>">
             
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Mobile</label>
                <div class="control_inputs">
                    <input type="text" disabled value="+66" class="form-control" style="width:10%; margin-right:2%; text-align:center;">
                    <input type="text" class="form-control" name="mobile"  style="width:25%" value="<?php echo $user_data[0]['mobile'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Address</label>
                <div class="control_inputs">
                    <textarea class="form-control" name="address"><?php echo $user_data[0]['address'];?></textarea>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">City/District</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" name="city" value="<?php echo $user_data[0]['city'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Province</label>
                <select name="province" class="form-control"  style="width:370px">
                    <option value="">Province select</option>
                    <?php foreach ($partner_province as $key) { ?>
                        <option value="<?php echo $key['PROVINCE_ID'];?>" <?php echo (@$user_data[0]['province'] == $key['PROVINCE_ID']) ? "selected" : "" ;?>  ><?php echo $key['PROVINCE_NAME_EN']; ?></option>
                    <?php } ?>
                </select>

                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">Postcode</label>
                <div class="control_inputs">
                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $user_data[0]['postcode'];?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="control-label">External number</label>
                <div class="control_inputs">
                    <div class="width50">
                        <input type="text" style="width:75%; float:left;" class="form-control" name="external_number" value="<?php echo $user_data[0]['external_number'];?>" >
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
               <div class="form-group">
                <label class="control-label">Password</label>
                <div class="control_inputs">
                    <div class="width50">
                        <input type="password" style="width:75%; float:left;" class="form-control" name="password" value="<?php echo $user_data[0]['password'];?>" >
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
             <div class="form-group">
                <label class="control-label">Content Qouta limit</label>
                <div class="control_inputs">
                    <div class="width50">
                        <input type="number" style="width:75%; float:left;" readonly class="form-control" value="<?php echo $user_data[0]['qouta'];?>" >
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix space15"></div>
                 <input type="submit" class="btn btn-primary" value="Save" >
              <div id="outputsample"></div>
        </form>

          <br/>
          <hr/>
                    <!-- /.panel -->
                   
                    <!-- /.panel .chat-panel -->
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

<style>
table.dataTable thead .sorting {background: white;}
</style> 

<script>
$(document).ready( function () {
    $('#example').DataTable( {
        searchHighlight: true
    } );
} );

function admin_remmove(id)
{   
    var r = confirm('Confirm to removed this partner?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/delete_partner',
            data: { 'id' : id},
        }) 
        .done(function() {
            alert('Partner account has been removed');
            window.location.reload();
        });
    }
}

function updateStatus(pcode)
{
    var r = confirm('Confirm to approve this partner?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/admin_approve',
            data: { "pcode": pcode },
        })
        .done(function( msg ) {
             alert('Partner account has been approved');
            window.location.reload();
        });
    }
}
</script>