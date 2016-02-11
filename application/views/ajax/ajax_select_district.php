<option value="">Please select District</option>
<?php for($i=0;$i<count($district);$i++){  ?>
	<option value="<?php echo $district[$i]['AMPHUR_ID'];?>"><?php echo $district[$i]['AMPHUR_NAME'];?></option>
<?php } ?>