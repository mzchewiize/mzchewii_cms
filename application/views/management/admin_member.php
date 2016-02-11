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
                    <h1 class="page-header">Member management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

             
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>username</th>
                        <th>lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Social Id</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($members as $member) {?>
                    <tr>
                        <td><?php echo $member['id'];?></td>
                        <td><?php echo $member['username'];?></td>
                        <td><?php echo $member['lastname'];?></td>
                        <td><?php echo $member['email'];?></td>
                        <td><?php echo $member['phone'];?></td>
                        <td><?php echo $member['address'];?></td>
                        <td><?php echo $member['social_id'];?></td>
                        <td><?php echo timeAgo($member['create']);?></td>
                    </tr>
                    <?php } ?>

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

</script>