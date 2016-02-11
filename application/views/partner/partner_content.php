    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Content Management 
                        <?php  if(count($partner_content)!=$header_user[0]['qouta']) { ;?>
                        <button class="btn btn-primary" onclick="content_added()">[+]New content</button></h1>
                        <?php } ?>
                </div>
            </div>

        <label>Content Management</label><br/><br/>            
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th width="40%">Subject</th>
                        <th>Price</th>
                        <th>Discount</th>
                     
                        <th>Content status</th>
                        <th>Created</th>
                        <th width="40%">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($partner_content as $content) {?>
                    <tr>
                        <td><?php echo $content['id'];?></td>
                        <td><?php echo $content['content_subject'];?></td>
                        <td><?php echo $content['content_price'];?></td>
                        <td><?php echo $content['content_discount'];?></td>
                                         <td>
                        <?php if($content['content_status']==0) { ?>
                            Content not publish
                        <?php } else  { echo "Content published"; }?>
                        </td>
                         <td><?php echo timeAgo($content['created']);?></td>
                         <td> 
                            <button class="btn btn-success" onclick="javascript:content_edit(<?php echo $content['id'];?>)">Edit</button>
                            <button class="btn btn-info" onclick="javascript:view_comment('<?php echo $content['ref_code'];?>')">Comment & Rating</button>
                            <button class="btn btn-danger" onclick="javascript:content_remove(<?php echo $content['id'];?>)">Delete</button></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
          <br/>
          <hr/>
                </div>
            </div>
        </div>
    </div>

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
function content_added()
{
    window.location='content_add';
}

function content_remove(id)
{   
    var r = confirm('Confirm to removed this content?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationpartner/submit_removed_content',
            data: { 'id' : id},
        }) 
        .done(function() {
            alert('Content has been removed');
            window.location.reload();
        });
    }
}

function content_edit(id)
{
 window.location='content_edit/'+id;
}

function view_comment(ref_code)
{
    window.location='view_comment/'+ref_code;
}

</script>