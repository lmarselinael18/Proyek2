<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Admin - BIRUDEUN</title>

<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

<!-- page specific plugin styles -->

<!-- text fonts -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/fonts.googleapis.com.css" />

<!-- ace styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
<![endif]-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/css/ace-rtl.min.css" />

<!--[if lte IE 9]>
  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="<?php echo base_url(); ?>assets/assets/js/ace-extra.min.js"></script>

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

<!--[if lte IE 8]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->

    <!-- This is for  DataTable -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatable/datatables.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/datatable/datatables.min.js"></script>
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/homepage/images/favicon.png">

</head>

<body class="no-skin">

<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    BIRUDEUN
                    </small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey dropdown-modal">
							
						</li>

						<li class="purple dropdown-modal">
		
						</li>

						<li class="green dropdown-modal">
						
						</li>

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url(); ?>/assets/assets/images/avatars/user.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $this->session->userdata('nama_admin') ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li class="divider"></li>

								<li>
									<a href="<?=base_url()?>index.php/controllerlogin/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
 
				<ul class="nav nav-list">
					 <!-- <li class="">
						<a href="<?=base_url()?>index.php/admin/index">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>  -->

					<li class="">
						<a href="<?=base_url()?>index.php/admin/pesan">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text"> Data Pemesanan</span>
						</a>

						<b class="arrow"></b>
					</li> 

					<li class="">
						<a href="<?=base_url()?>index.php/admin/aktiv">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Data Ketua</span>
						</a>
					<b class="arrow"></b>
					</li>

					<li class="">
						<a href="<?=base_url()?>index.php/admin/ubahstatuspkl">
							<i class="menu-icon fa fa-pencil-square"></i>
							<span class="menu-text"> Ubah status </span>
						</a>
					<b class="arrow"></b>
					</li>

					<li class="">
						<a href="<?=base_url()?>index.php/admin/divisi">
							<i class="menu-icon fa fa-pencil-square"></i>
							<span class="menu-text"> Update Kuota </span>
						</a>
					<b class="arrow"></b>
					</li>

					<li class="">
						<a href="<?=base_url()?>index.php/admin/edituser/<?php echo $this->session->userdata('UAID') ?>">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> Edit Profil </span>
						</a>

						<b class="arrow"></b>
					</li>



					<!-- <li class="">
						<a id="addnew">
							<i class="menu-icon fa fa-plus"></i>
							<span class="menu-text"> Add New User </span>
						</a>

						<b class="arrow"></b>
					</li> -->

					
					</ul>
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>