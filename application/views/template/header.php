<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Admin Dashboard Template">
	<meta name="keywords" content="admin,dashboard">
	<meta name="author" content="stacks">
	<!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- Title -->
	<title><?php echo @$title; ?>  - IDO Printing</title>

	<!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>plugins/icomoon/style.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>plugins/uniform/css/default.css" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/'); ?>plugins/switchery/switchery.min.css" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/'); ?>plugins/nvd3/nv.d3.min.css" rel="stylesheet">  

	<!-- Theme Styles -->
	<link href="<?php echo base_url('assets/'); ?>css/space.min.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/'); ?>css/custom.css" rel="stylesheet">

	<!-- Datatables --> 

	<!-- Js -->
	<script type="text/javascript">
		var base_url = "<?php echo site_url('/')?>";   
		var app_url = "<?php echo site_url('/')?>"; 
	</script>  


	<link rel="stylesheet" href="http://ido.awanesia.com/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" />
	<link rel="stylesheet" href="http://ido.awanesia.com/assets/plugins/select2/select2.min.css" type="text/css" />




	<link rel="stylesheet" href="http://ido.awanesia.com/assets/plugins/datatables/datatables.bootstrap.css" type="text/css" />
	
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/jquery/jquery-cookie.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/datatables/jquery.datatables.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/datatables/datatables.bootstrap.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/datatables/datatables.responsive.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/select2/select2.full.min.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/dateformat/dateformat.js"></script>
	<script type="text/javascript" src="http://ido.awanesia.com/assets/plugins/bootbox/bootbox.min.js"></script>

	<!-- Javascripts --> 
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/uniform/js/jquery.uniform.standalone.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/switchery/switchery.min.js"></script> 
	<script src="<?php echo base_url('assets/'); ?>js/space.min.js"></script> 

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
