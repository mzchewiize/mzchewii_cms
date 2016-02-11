
<div id="wrapper">
<?php $this->load->view('subview/sidebar'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Broadcast message</h1>
        <form method="post" action="<?php echo site_url('wizcationadmin/submit_new_broadcast');?>">
           <div class="form-group">
            <label>Subject </label> <input type="text" class="form-control" name="msg_subject"/><br/>
              <textarea name="msg_detail" data-provide="markdown" rows="10"></textarea><br/>
              <button class="btn btn-info">Save</button>
           </div>       
        </form>

        </div>

            <hr/>
        <label>Message from partner</label><br/><br/>            
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>From partner id</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($message_from_partner as $msg_partner) {?>
                            <tr>
                                <td><?php echo $msg_partner['property_code'];?></td>
                                <td><?php echo $msg_partner['inbox_title'];?></td>
                                <td><?php echo $msg_partner['inbox_detail'];?></td>
                                <td>
                                    <?php if($msg_partner['status']=='1') { ?>
                                    <button class="btn btn-success" onclick="admin_read_msg('<?php echo $msg_partner['inbox_id'];?>')">New</button> 
                                   <?php } else { ?>
                                    Read
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <br/>
                    <hr/>
        <label>Message broadcast to all partner</label><br/><br/>    
            <div class="panel-body">
                <ul class="chat">
                    <?php foreach ($message as $item) { ?>
                    <li class="right clearfix">
                        <span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <small class=" text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> <?php echo timeAgo($item['created']);?></small>
                                <strong class="pull-right primary-font"><?php echo $item['msg_subject'];?></strong>
                            </div>
                            <p>
                                <span style="word-break:break-all"><?php echo $item['msg_detail'];?></span><br/>
                                <span style="float:right">
                                  <?php if($item['status']=='new') { ?>
                                    <button class="btn btn-success" onclick="send_msg('<?php echo $item['id'];?>')">Send</button> 
                                   <?php } ?>
                                    <button class="btn btn-danger" onclick="delete_msg('<?php echo $item['id'];?>')">delete</button>
                                </span>
                            </p>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function(){
        $('#example').dataTable();
    });

    function admin_read_msg(id)
    {
        $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/submit_read_admin',
            data: { 'msg_id' : id},
        }) 
        .done(function() {
            alert('Mark message as read');
            window.location.reload();
        });
    }

    function send_msg(id)
    {
         $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/submit_send_msg',
            data: { 'msg_id' : id},
        }) 
        .done(function() {
            alert('Your message has been publish');
            window.location.reload();
        });
    }

    function delete_msg(id)
    {
       $.ajax({
            method: "GET",
            url: '<?php echo base_url();?>index.php/wizcationadmin/submit_delete_msg',
            data: { 'msg_id' : id},
        }) 
        .done(function() {
            alert('Your message has been delete');
            window.location.reload();
        });

    }

</script>