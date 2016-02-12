<style>
li  { list-style: none }
</style>
<div class="dash_profile_page container">

    <?php $this->load->view('subview/sidebar'); ?>		

    <div class="dash_right">
        <div class="row">
            <h3 class="page-header" style="margin-top:-10px">Inbox<br/>
                <small>Broadcast message and personal message</small>
            </h3>
        </div>
       	<form method="post" action="<?php echo site_url('miscellaneous/submit_new_msg');?>">
		   <div class="form-group">
		    <label>Subject </label> <input type="text" class="form-control" name="msg_subject"/><br/>
		      <textarea name="msg_detail" data-provide="markdown" rows="10"></textarea><br/>
		      <button class="btn btn-info">Save</button>
		   </div>       
		</form>
		<hr/>
       <div class="panel-body">

        <ul class="chat">
            <?php foreach ($message as $item) {
            	if($item['status']!=2)
            	{
	            	if($item['type']=='inbox')
	            	{
	             ?>
		               <li class="left clearfix">
		                <span class="chat-img pull-left">
		                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
		                </span>
		                <div class="chat-body clearfix">
		                    <div class="header">
		                        <i class="fa fa-clock-o fa-fw"></i> <?php echo timeAgo(@$item['datetime_update']);?></small>
		                        <strong class="pull-right primary-font"><?php echo $item['inbox_title'];?></strong>
		                    </div>
		                    <p>
		                     	<span style="word-break:break-all"><?php echo $item['inbox_detail'];?></span><br/>
		                        <span style="float:right">
		                          <?php if($item['status']=='0') { ?>
		                            <button class="btn btn-success" onclick="read_msg('<?php echo $item['inbox_id'];?>')">Mark as read</button> 
		                           <?php } ?>
		                            <button class="btn btn-danger" onclick="delete_msg('<?php echo $item['inbox_id'];?>')">delete</button>
		                        </span>
		                    </p>
		                </div>
		            </li>
		            <hr/>
            <?php } else if($item['type']=='send') { /// type send ?>
		            <li class="right clearfix">
		                <span class="chat-img pull-right">
		                    <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
		                </span>
		                <div class="chat-body clearfix">
		                    <div class="header">
		                        <small class=" text-muted">
		                            <i class="fa fa-clock-o fa-fw"></i> <?php echo timeAgo(@$item['datetime_update']);?></small>
		                        <strong class="pull-right primary-font"><?php echo $item['inbox_title'];?></strong>
		                    </div>
		                    <p>
		                        <span style="word-break:break-all"><?php echo $item['inbox_detail'];?></span><br/>
		                        <span style="float:right">
		                          <?php if($item['status']=='0') { ?>
		                            <button class="btn btn-success" onclick="read_msg('<?php echo $item['inbox_id'];?>')">Mark as read</button> 
		                           <?php } ?>
		                            <button class="btn btn-danger" onclick="delete_msg('<?php echo $item['inbox_id'];?>')">delete</button>
		                        </span>
		                    </p>
		                </div>
		            </li>
            <?php 
        			}
        		}
            } 
            ?>
        </ul>
    </div>
        
    </div>
</div>
   
<script>
  function read_msg(id)
    {
         $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/miscellaneous/set_read_msg',
            data: { 'inbox_id' : id},
        }) 
        .done(function() {
            alert('Your message have been marked as read. ');
            window.location.reload();
        });
    }

    function delete_msg(id)
    {
       $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/miscellaneous/set_delete_msg',
            data: { 'inbox_id' : id},
        }) 
        .done(function() {
            alert('Your message has been delete');
            window.location.reload();
        });

    }
</script>