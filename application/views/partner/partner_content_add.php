    <div id="wrapper">
   <?php $this->load->view('subview/sidebar'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                      <div class="row" style="margin-top:50px;">
                         <h3 class="page-header" style="margin-top:-10px">Define content infomation<br/>
                        <small>A description of your space displayed on your public page.</small>
                         </h3>
                     </div>
                 </div>
            </div>
        <form method="post" action="<?php echo site_url('wizcationpartner/submit_information');?>" role="form" id="infoProfile"  enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="property_code" name="property_code" value="<?php echo $header_user[0]['property_code']; ?>">
        <input type="hidden" class="form-control" id="ref_code" name="ref_code" value="<?php echo generateRandomString(10);?>">
        
        <div class="form-group">
            <label for="Title">Subject:</label> <span>subject of your infomation property</span><br/>
            <input type="text" class="form-control"  name="content_subject"value="<?php echo @$content[0]['content_subject'];?>">
        </div>
         <div class="form-group">
            <label for="Title">Hilight:</label> <span>hilight of your infomation property</span><br/>
           <textarea name="content_hilight" data-provide="markdown" rows="10"><?php echo @$content[0]['content_hilight'];?></textarea>
        </div>
         <div class="form-group">
            <label for="Title">Detail:</label> <span>detail of your infomation property</span><br/>
           <textarea name="content_detail" data-provide="markdown" rows="10"><?php echo @$content[0]['content_detail'];?></textarea>
        </div>
        <div class="form-group">
            <label for="Title">Keyword or hashtag :</label> <span>hashtag or keryword of your property</span><br/>
            <input type="text" class="form-control"  data-role="tagsinput"  id="hashtag" name="hashtag"value="<?php echo @$content[0]['hashtag'];?>">
        </div>

         <div class="form-group">   
               <label style="text-decoration: underline;">Additional for search options</label>
                <div class="row" style="margin-left:10px;">
                <?php
                        $array_check = array();
                        for($j=0;$j<count(@$catergory_selected);$j++){
                            array_push($array_check,@$catergory_selected[$j]['cat_id']);
                        }
                   ?>
                <?php for($i=1;$i<=count($item_info);$i++){ ?>
                        <?php if($i%4==1){  echo '<div class="col-sm-4"><div class="checkbox">'; } ?>
                        <label>
                            <input <?php echo in_array($item_info[$i-1]['item_info_id'],$array_check) ? "checked" : "";?> type="checkbox" name="category[]" value="<?php echo $item_info[$i-1]['item_info_id'];?>"><?php echo $item_info[$i-1]['item_info_name'];?></label><br>
                        <?php if($i%4==0){  echo '</div></div>';} ?>
                <?php } ?>
                </div>
        </div><br/>
        <div style="clear:both"></div>
        <div class="row">
        <div class="col-xs-6 col-sm-4">
            <label>Price</label>
             <input type="number" class="form-control"  id="content_price" name="content_price"value="<?php echo @$content[0]['content_price'];?>">
        </div>
        <div class="col-xs-6 col-sm-4">
            <label>Discount</label>
                 <input type="number" class="form-control" id="content_discount" name="content_discount"value="<?php echo @$content[0]['content_discount'];?>">
        </div>
        <div class="col-xs-6 col-sm-4">
         <label for="Title">Price after discount:</label> <span></span>
            <input type="number" class="form-control"  id="content_price_discount" name="content_price_discount"value="<?php echo @$content[0]['content_price_discount'];?>">
           </div>
        </div>
        <div class="form-group">
            <label for="Title">Website :</label><br/>
           <input type="text" class="form-control" name="content_website" value="<?php echo @$content[0]['content_website'];?>"/>

        </div>
        <div class="form-group">
            <label for="Title">Location Address :</label> <span>Your exact address is private and only shared with guests after a reservation is confirmed.</span><br/>
           <textarea name="content_address" data-provide="markdown" rows="10"><?php echo @$content[0]['content_address'];?></textarea>

        </div>
   <!--      <div class="form-group">
            <label for="Title">Location Map :</label> <br/>
            <div id="map-canvas" style="height:300px;margin:auto;"> </div>
            <div style="display:none;">
                <input type="text" id="latitude_text" name="latitude_text" value="<?php echo @$content[0]['latitude'];?>">
                <input type="text" id="longitude_text" name="longitude_text" value="<?php echo @$content[0]['longitude'];?>">
            </div>
        </div> -->
               
        <div class="row">
            <label>Add a photo</label> <span>Guests love photos that highlight the features of your space.</span>
            <div class="col-lg-12">
        <script type="text/template" id="qq-simple-thumbnails-template">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>
     <div id="fine-uploader-gallery"></div>
            </div>
        </div>   
        <br/><br/>
            
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-primary" value="Save">
        <input type="button" class="btn btn-danger" value="Cancel">
        <br/><br/>
        </form>

               </div>   </div>
    </div>
    
</body>
</html>
  <script>
    $(document).ready(function(){
        $('#content_discount').on('change',function(){
            var price = $('#content_price').val();
            var content_discount = $(this).val()/100;
            var percent = price * content_discount;
            var price_after_discount = price - percent;
            $("#content_price_discount").val(Math.floor(price_after_discount));
        });
    });
    var property_code = $('#property_code').val();
    var ref_code = $('#ref_code').val();
    var galleryUploader = new qq.FineUploader({
        element: document.getElementById("fine-uploader-gallery"),      
        template: 'qq-simple-thumbnails-template',
        request: {
            endpoint: '../../webroot/endpoint.php?property_code='+property_code+'&ref_code='+ref_code
        },
        thumbnails: {
            placeholders: {
                waitingPath: '../../webroot/placeholders/waiting-generic.png',
                notAvailablePath: '../../webroot/placeholders/not_available-generic.png'
            }
        },
        deleteFile: {
            enabled: true,
            method: "DELETE",
            endpoint: '../../webroot/endpoint.php'
        },
        cors: {
            expected: true
        },
        chunking: {
            enabled: true
        },
        resume: {
            enabled: true
        },
        validation: {
            itemLimit: 5,
            sizeLimit: 15000000
        },
        forceMultipart: {
            enabled: true
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
        },
        failedUploadTextDisplay: {
            mode: 'default',
            responseProperty: 'error',
        }
    });
 </script>