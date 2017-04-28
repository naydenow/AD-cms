<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Dashboard I Admin Panel</title>
	
	<link rel="stylesheet" href="<?=$this->path();?>/css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?=$this->path();?>/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="<?=$this->path();?>/js/hideshow.js" type="text/javascript"></script>
	<script src="<?=$this->path();?>/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script src="<?=$this->path();?>/js/jquery.equalHeight.js" type="text/javascript"></script>

</head>



<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">CMS</a></h1>
			<h2 class="section_title"><?=$this->arData['bread_crumbs']['title']?></h2><div class="btn_view_site"><a href="/">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html">Website Admin</a>
			 <div class="breadcrumb_divider"></div> 
			 <a class="current"><?=$this->arData['bread_crumbs']['title']?></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3>Entities</h3>

		<ul class="toggle">
			<li class="icn_categories"><a href="/admin/collection/">Collections</a></li>
			<li class="icn_categories"><a href="/admin/models/">Models</a></li>
			<li class="icn_categories"><a href="/admin/tables/">Tables</a></li>
			<li class="icn_categories"><a href="/admin/controllers/">Controllers</a></li>
			<li class="icn_categories"><a href="/admin/templates/">Templates</a></li>
			<li class="icn_categories"><a href="/admin/views/">Views</a></li>
			<li class="icn_categories"><a href="/admin/views/">Routs</a></li>
		</ul>

		<h3>Components</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="#">Master</a></li>
			<li class="icn_view_users"><a href="#">Custom</a></li>
		</ul>

		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_jump_back"><a href="#">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2017 Naydenov Pavel</strong></p>
			<p>Powered by <a href="https://github.com/naydenow/AD">AD</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
