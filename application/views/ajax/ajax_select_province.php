
<option value="">Please select Business City or Province</option>
<?php for($i=0;$i<count($province);$i++){  ?>
	<option value="<?php echo $province[$i]['PROVINCE_ID'];?>"><?php echo $province[$i]['PROVINCE_NAME'];?></option>
<?php } ?>