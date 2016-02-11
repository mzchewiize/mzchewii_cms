		<div id="box_<?php echo $number;?>">
		<div class="row form-group">
			<div class="col-sm-10"></div>
			<div class="col-sm-2"><input class="btn btn-danger" type="button" value="Delete" onclick="delete_lang('<?php echo $number;?>','<?php echo $language['language_id'];?>');"></div>
		</div>
		<input type="hidden" class="form-control" name="lang_code_<?php echo $number;?>" value="<?php echo $language['language_id'];?>">
		<div class="form-group">
			<label for="comment">Title: (<?php echo $language['language_short'];?>)</label>
			<input type="text" class="form-control" name="title_<?php echo $number;?>" >
		</div>
		<div class="form-group">
			<label for="comment">Description: (<?php echo $language['language_short'];?>)</label>
			<textarea class="form-control"  rows="5"  name="long_description_<?php echo $number;?>"></textarea>
		</div>
		<div class="form-group">
			<label for="comment">Rules: (<?php echo $language['language_short'];?>)</label>
			<textarea class="form-control"  rows="5" name="rule_description_<?php echo $number;?>"></textarea>
		</div>
		<hr>
		</div>