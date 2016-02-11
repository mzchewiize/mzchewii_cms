
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Amenities & customize 
                        <button class="btn btn-primary" onclick="javascript:go_back();">Amenities</button> 
                        <label><input type="text" onchange="add_item_submit();" name="add_item" id="add_item" style="display:none"/></label> </h1>
                </div>
            </div>
        
          <form method="post" action="<?php echo site_url('wizcationadmin/submit_item_info');?>" role="form">
            <div class="row">
                <div class="col-sm-4">
                    <label for="Title">Type </label>
                        <select class="form_control1" name="item_id" id="item_id" align="top">
                        <option value="">Please select type</option>
                        <?php for($i=0;$i<count($item_type);$i++){  ?>
                            <option  value="<?php echo @$item_type[$i]['item_id'];?>"><?php echo $item_type[$i]['item_name'];?></option>
                        <?php } ?>
                        </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <label for="Title">Item name</label>
                    <input name="item_info_name" id="item_info_name" class="form-control" type="text">
                </div>
            </div>

            <br/><br/>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" style="width:130px;" value="Save changes"/>
            </div>

            </form>

            <h2>Item </h2>

             <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>Item name</th>
                    <th>Sub-item</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($item_info as $amenitiesItem) {?>
                    <tr>
                        <td><?php echo $amenitiesItem['item_info_id'];?></td>
                        <td><?php echo $amenitiesItem['item_info_name'];?></td>
                        <td><?php echo subtypeTitle($amenitiesItem['item_id']);?></td>
                       
                        <td><button class="btn btn-danger" onclick="javascript:confirm_delete('<?php echo $amenitiesItem['item_info_id'];?>')">delete</button>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<style>
.form_control1 {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
</style>
<script type="text/javascript">

$(document).ready(function(){
    $('#example').DataTable();
});


function go_back()
{
    window.location='<?php echo site_url("wizcationadmin/amenities"); ?>';
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
        data: { 'table': 'item_type', 'pcode_value' : add_item , 'key' : 'item_id','reload_page' : 'amenities'},
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

function confirm_delete(id)
{
    var r = confirm('Confirm to delete this item?');
    if(r)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/submit_remove_item',
            data: { 'id' : id},
        }) 
        .done(function() {
            alert('Item has been removed');
            window.location.reload();
        });
    }
    else
    {
        return false;
    }
}
</script>