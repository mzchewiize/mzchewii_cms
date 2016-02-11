    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comment & review 
                     
                </div>
            </div>

        <label>Content Management</label><br/><br/>            
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Comment</th>
                        <th>Star</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($comments as $comment) {?>
                    <tr>
                        <td><?php echo $comment['id'];?></td>
                        <td><?php echo $comment['comment'];?></td>
                        <td><?php echo comment_star($comment['star']);?></td>
                        <td><?php echo $comment['update'];?></td>
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