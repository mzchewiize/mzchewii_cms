<style>
table.dataTable span.highlight {
  background-color: #FFFF88;
}

</style>
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Partner Infomation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="row">
    <div class="col-xs-6 text-left"> 
    <label> Register new partner </label>
     
        <form id="checkout_form" class="form-horizontal" action="<?php echo site_url('wizcationadmin/submit_partner');?>" method="post">
            <div class="form-group">
                <label for="nameText" class="col-xs-12 col-sm-3 control-label">First name<span class="text-danger">*</span> : </label>
                <div class="col-xs-12 col-sm-9"><input type="text" class="form-control" id="first_name" name="first_name" ></div>
            </div>
            <div class="form-group">
                <label for="nameText" class="col-xs-12 col-sm-3 control-label">Last name<span class="text-danger">*</span> : </label>
                <div class="col-xs-12 col-sm-9"><input type="text" class="form-control" id="last_name" name="last_name" ></div>
            </div>
            <div class="form-group">
                <label for="nameText" class="col-xs-12 col-sm-3 control-label">Register as<span class="text-danger">*</span> : </label>
                <div class="col-xs-12 col-sm-9">
                <select name="user_group" id="user_group" class="form-control">
                    <?php foreach ( $user_group as $group) { ?>
                    <option value="<?php echo $group['id'];?>"><?php echo $group['user_group'];?></option>
                    <?php } ?>

                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="nameText" class="col-xs-12 col-sm-3 control-label">Email<span class="text-danger">*</span> : </label>
                <div class="col-xs-12 col-sm-9"><input type="text" class="form-control" id="email" name="email" ></div>
            </div>
            <div class="form-group">
                <label for="usernameText" class="col-xs-12 col-sm-3 control-label">Mobile<span class="text-danger">*</span> : </label>
                <div class="col-xs-12 col-sm-9"><input type="text" class="form-control" id="mobile" name="mobile"></div>
            </div>
            <div class="form-group">
                <label for="usernameText" class="col-xs-12 col-sm-3 control-label"></label>
                <div class="col-xs-12 col-sm-9"><input type="submit" class="btn btn-default" value="Register"></div>
            </div>
        </form> 
        </div>
</div>
<hr/>
<label>Partner information</label><br/><br/>            
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Login name</th>
                        <th>User group</th>
                        <th>Email</th>
                        <th>User verify</th>
                        <th>Admin approve </th>
                        <th>Last login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($user_profile as $partner) {
                    if($partner['user_group']!=5) {
                    ?>
                    <tr>
                        <td><?php echo $partner['property_code'];?></td>
                        <td><?php echo $partner['login_name'];?></td>
                        <td><?php echo userGroup($partner['user_group']);?></td>
                        <td><?php echo $partner['email'];?></td>
                        <td><?php echo status_user_verify($partner['user_verify']);?></td>
                        <td>
                        <?php if($partner['admin_approve']!=1) { ?>
                        <button class="btn btn-success" onclick="javascript:admin_approve_user_profile(<?php echo $partner['profile_id'];?>)">Approve</button>
                        <?php } else  { echo "approved"; }?>
                        </td>
                         <td><?php echo timeAgo($partner['last_login']);?></td>
                        <td> <button class="btn btn-success" onclick="javascript:admin_remmove(<?php echo $partner['profile_id'];?>)">Delete</button></td>
                       

                    </tr>
                    <?php  }}  ?>

                </tbody>
            </table>
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

function admin_approve_user_profile(profile_id)
{
    var r = confirm('Confirm to approve this partner?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/approve_user_profile',
            data: { "profile_id": profile_id },
        })
        .done(function( msg ) {
             alert('Partner account has been approved');
            window.location.reload();
        });
    }
}
</script>