
    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><!-- Amenities & customize  -->
                      Static page customize </h1>
                </div>
            </div>

       <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Company overview: </label>
                <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[0]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="1"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form>
   
        <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Private orivacy: </label>
               <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[1]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="2"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 
         <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Terms & Condition: </label>
               <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[2]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="3"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 
         <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Enquiry: </label>
              <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[3]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="4"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 
                 <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Carrer: </label>
           <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[4]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="5"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 
                   <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">FAQS: </label>
              <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[5]['description'];?></textarea> 
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="6"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 
                   <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">How wizcation works: </label>
               <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[6]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="7"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form> 

                   <div style="padding:10px;"></div>
        <form method="post" action="<?php echo site_url('wizcationadmin/update_static_content');?>" role="form">
            <div class="form-group">
                <label for="comment">Contact & support: </label>
             <textarea name="content" data-provide="markdown" rows="10"><?php echo $static_page[7]['description'];?></textarea>
            </div>  
            <div class="clearfix"></div>
            <input type="hidden" name="content_id" value="8"/>
            <input type="submit" class="btn btn-primary" value="Save" >
        </form>
          <div style="padding:10px;"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>