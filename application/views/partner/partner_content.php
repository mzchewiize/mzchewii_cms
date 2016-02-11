    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Album management<br/>
                    <button class="btn btn-primary" onclick="javascript:load_addItem();">[+] new album </button> 
                    <label><input type="text" onchange="add_item_submit();" placeholder="สร้างชื่ออัลบัม" name="add_item" id="add_item" style="display:none"/></label> </h1>
                </div>
            </div>

        <label>Album management</label><br/><br/>            
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Album name</th>
                        <th>Catergories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($partner_content as $content) {?>
                    <tr>
                        <td><?php echo $content['item_id'];?></td>
                        <td><a href="<?php echo base_url();?>index.php/malongyeradmin/add_photo_album/<?php echo $content['item_id'];?>"><?php echo $content['item_name'];?></a></td>
                        <td>
                            <select class="form-control" id="catergories" onchange="update_catergories('<?php echo $content['item_id'];?>',catergories)">
                                    <option>select catergories</option>
                                    <option value="pre_wedding">Pre-wedding</option>
                                    <option value="wedding_presentation">Wedding-Presentation</option>
                                    <option value="engagement">Engagement</option>
                                    <option value="wedding_reception">Wedding-reception</option>
                                    <option value="wedding_cinema">Wedding-cinema</option>
                                    <option value="event_video">Party Event (video) </option>
                                    <option value="event_photo">Party Event (photo)</option>
                                    <option value="presentation">Presentation</option>
                                    <option value="graphic_design">Graphic design</option>
                            </select>
                       </td>
                        <td><button class="btn btn-danger" onclick="javascript:content_remove(<?php echo $content['item_id'];?>)">Delete album</button></td>
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
function load_addItem()
{
    $('#add_item').show();
}

function add_item_submit()
{
     var add_item = $('#add_item').val();
     $.ajax({
        method: "GET",
        url: '<?php echo base_url();?>index.php/malongyeradmin/add_item_new',
        data: { 
            'table': 'item_type', 
            'pcode_value' : add_item , 
            'key' : 'item_id',
            'reload_page' : 'main_content'
        },
    }) 
    .done(function() {
        alert('completed !!');
        window.location.reload();
    });
}

function update_catergories(item_id,catergories)
{   
    var new_cat = catergories.value;
    $.ajax({
        method: "GET",
        url: '<?php echo base_url();?>index.php/malongyeradmin/set_catergories',
        data: { 
            'item_id': item_id, 
            'catergories' : new_cat
        },
    }) 
    .done(function() {
        alert('completed !!');
        window.location.reload();
    });

}
</script>