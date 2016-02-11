<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<!-- <title>Wizcation Portal management : ADMIN</title> -->
<?php for($i=0;$i<count($css);$i++): ?>
<link rel="stylesheet" href="<?php echo base_url().$css[$i]; ?>">
<?php endfor; ?>

<?php if (strpos($_SERVER['PATH_INFO'],'infomation') !== false || strpos($_SERVER['PATH_INFO'],'overview') !== false) {?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&language=th" type="text/javascript"></script>
<?php } ?>

<?php for($i=0;$i<count($jscript);$i++): ?>
<script src="<?php echo base_url().$jscript[$i] ?>" type="text/javascript"></script>
<?php endfor; ?>

<link href='<?php echo base_url();?>webroot/css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>webroot/font-awesome/css/font-awesome.min.css' rel='stylesheet' />
<link href='<?php echo base_url();?>webroot/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url();?>webroot/js/moment.min.js'></script>

<script src='<?php echo base_url();?>webroot/js/fullcalendar.min.js'></script>


<link href="<?php echo base_url();?>webroot/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>webroot/css/jquery.dataTables.css" media="all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>webroot/css/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>webroot/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>webroot/js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>webroot/js/jquery.dataTables.js" type="text/javascript"></script>


<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/bootstrap-theme.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/my_style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>webroot/css/multiple-select.css" />
<link href="<?php echo base_url();?>webroot/css/jquery-ui.css" rel="stylesheet">
<script src="<?php echo base_url();?>webroot/js/jquery.multiple.select.js"></script>


<script type="text/javascript">
var base_url="<?php echo base_url();?>";
</script>
</head>
<body>
<?php $this->load->view('subview/header_navbar'); ?>
