
<div id="container">
	<div id="content">
		 <div class="flexslider">
		<div id="slider">
		<ul class="slides">
    		<?php foreach($image as $photo) { ?>
			
			 	<li data-thumb="<?php echo base_url();?>webroot/timthumb.php?src=<?php echo base_url();?>webroot/files/<?php echo @$photo['uuid'].'/'.@$photo['image'];?>&w=800&h=560&a=c">
       			<img  src="<?php echo base_url();?>webroot/timthumb.php?src=<?php echo base_url();?>webroot/files/<?php echo @$photo['uuid'].'/'.@$photo['image'];?>&w=800&h=560&a=c"/>
    				</li>

			<?php } ?>
          </ul>
        </div>
			</div>
		</div>
	</div>

   <style>
   .img_show{
	   max-width:900px;
	   width:auto;
   }

   </style>
	<script>

$(document).ready(function(){
	$(function(){
    	SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
   });
    </script>
