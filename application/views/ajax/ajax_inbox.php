
	<div class="form-group">
	<label for="comment"></label>
		<table class="table">
			<thead>
				<tr>
					<th data-field="inbox_title" data-halign="right" data-align="center">Item ID</th>
					<th data-field="inbox_detail" data-halign="center" data-align="left">Item Detail</th>
				</tr>
			</thead>
			<?php for($i=0;$i<count($content);$i++){ ?>
			<tr id="tr_box_<?php echo $i;?>" onclick="read_inbox(<?php echo $i;?>,<?php echo $content[$i]['inbox_id'];?>);" class="<?php echo ($content[$i]['status'] == 0 )? "bg-not-read": "";?>">
				<td id="td_title_<?php echo $i;?>"><?php echo $content[$i]['inbox_title'];?></td>
				<td id="td_detail_<?php echo $i;?>"><?php echo $content[$i]['inbox_detail'];?></td>
			</tr>
			<?php } ?>
		</table>
	</div>