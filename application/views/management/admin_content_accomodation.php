
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Content quality</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="row">

  <label style="text-decoration: underline;">Content from Accomoddation</label><br/><br/>            
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Property code</th>
                        <th>Type of room</th>
                        <th>Allotment</th>
                        <th>Price</th>
                        <th>Admin approve </th>
                        <th>Created </th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach($content_accomodation as $ccomoddation) {?>
                    <tr>
                        <td><?php echo $ccomoddation['property_code'];?></td>
                        <td><?php echo $ccomoddation['title_name'];?></td>
                        <td><?php echo $ccomoddation['allotment'];?></td>
                        <td><?php echo $ccomoddation['basic_night'];?></td>
                        <td>
                        <?php if($ccomoddation['status']==0) { ?>
                        <button class="btn btn-success" onclick="javascript:admin_accomodation_approve('<?php echo $ccomoddation['acc_id'];?>')">Approve</button>
                        <?php } else  { echo "approved"; }?>
                        </td>
                        <td><?php echo $ccomoddation['created'];?></td>

                    </tr>
                    <?php } ?>

                </tbody>
            </table>
          <br/>
          <hr/>
                    <!-- /.panel -->
                   
                    <!-- /.panel .chat-panel -->
              
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
$(document).ready(function(){
    $('#example').DataTable();
});

function admin_accomodation_approve(id)
{
    var r = confirm('Confirm to approve this content?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/admin_accomodation_approve_content',
            data: { "acc_id": id },
        })
        .done(function( msg ) {
             alert('Content has been approved !!');
            window.location.reload();
        });
    }
    else
    {
        return false;
    }
}
</script>