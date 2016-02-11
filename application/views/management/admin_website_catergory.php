
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Search catergory & customize <br/>
                        <button class="btn btn-primary" onclick="javascript:load_addItem();">Add catergory[+] </button>  
                        <label><input type="text" onchange="add_item_submit();" placeholder="Album name" name="add_item" id="add_item" style="display:none"/></label> </h1>
                </div>
            </div>
             <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>catergory</th>
                    <th></th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($catergory as $amenitiesItem) {?>
                    <tr>
                        <td><?php echo $amenitiesItem['category_id'];?></td>
                        <td><?php echo $amenitiesItem['value'];?></td>
                        <td><input type="text" id="edit_amenities_<?php echo $amenitiesItem['category_id'];?>" onchange="javascript:confirm_update('<?php echo $amenitiesItem['category_id'];?>')" name="edit_amenities" value="<?php echo $amenitiesItem['value'];?>" style="display:none"/>
                        <td><button class="btn btn-info"  onclick="javascript:load_update('<?php echo $amenitiesItem['category_id'];?>');">edit</button> 
                            <button class="btn btn-danger" onclick="javascript:confirm_delete('<?php echo $amenitiesItem['category_id'];?>')">delete</button>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
                </div>

                
            </div>
        </div>
    </div>
</body>

</html>

<style>
table.dataTable thead .sorting {background: white;}
</style> 
<script type="text/javascript">

$(document).ready(function(){
    $('#example').DataTable();
});

function add_customize()
{
    window.location='<?php echo site_url("wizcationadmin/amenities_customize"); ?>';
}

function load_update(pcode)
{
   $('#edit_amenities_'+pcode).show();
}
function load_addItem()
{
    $('#add_item').show();
}

function add_item_submit()
{
     var add_item = $('#add_item').val();
     $.ajax({
        method: "GET",
        url: '<?php echo base_url();?>index.php/wizcationadmin/add_item_new',
        data: { 'table': 'item_type', 'pcode_value' : add_item , 'key' : 'item_id','reload_page' : 'content'},
    }) 
    .done(function() {
        alert('completed !!');
        window.location.reload();
    });
}

function confirm_update(pcode)
{
     var edit_amenities= $('#edit_amenities_'+pcode).val();
     $.ajax({
        method: "GET",
        url: '<?php echo base_url();?>index.php/wizcationadmin/update_custom',
        data: { 'table': 'item_type', 'pcode_value' : edit_amenities, 'update_field':'item_name', 'id' : pcode , 'key' : 'item_id','reload_page' : 'amenities'},
    }) 
   .done(function() {
        alert('completed !!');
        window.location.reload();
    });
}

function confirm_delete(pcode)
{
    var r = confirm('Confirm to delete this item?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/update_deleteItem',
            data: { 'table': 'item_type', 'pcode_value' : pcode, 'id' : pcode , 'key' : 'item_id','reload_page' : 'amenities'},
        })
        .done(function( msg ) {
            alert('completed !!');
            window.location.reload();
        });
    }
    else
    {
        return false;
    }
}
</script>