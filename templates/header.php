<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">

        <?php if (isset($title)): ?>
            <title>rsTRACK.org: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>rsTRACK.org</title>
        <?php endif ?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Lato:100,400,700' rel='stylesheet' type='text/css'>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
		 
	</head>   

	<?php

		// get study name and username if logged in
		if (!empty($_SESSION))
		{
		    $study_name = query("SELECT study FROM users WHERE u_id = ?", $_SESSION["u_id"]);	
		    $user = query("SELECT username FROM users WHERE u_id = ?", $_SESSION["u_id"]);	
		}

		else
		{

			$study_name = null;
			$user = null;
		}
	?>
<body>
	<!-- start javascript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
	 <script>

		$(document).ready(function(){

		// jquery ui datepicker (added here for future versions of site that will use it more frequently)
		$('.datepick').datepicker({
			autoclose: true
		});

		// get active url for navbar (from http://stackoverflow.com/questions/11533542/twitter-bootstrap-add-active-class-to-li)
		var url = window.location;
		
		// Will only work if string in href matches with location
		$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

		// Will also work for relative and absolute hrefs
		$('ul.nav a').filter(function() {
		    return this.href == url;
		}).parent().addClass('active');

		// save study name as javascript var
		var $study_name = <?php echo json_encode($study_name) ?>;

		// hide study login info and logout link if no one is logged in
		if ($study_name === null)
		{
			$('#login_info, #signout, #navbar, #jumbo').hide();
		}

	  });
	</script>
	<!-- end javascript -->

	<div id="wrap">

	<div id="navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="container">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand hidden-xs" href="index.php">RS<strong>T</strong></a>
		    <a class="navbar-brand visible-xs" href="index.php">RS<strong>T</strong>: The <?= $study_name[0]['study'] ?> Study</a>		    
		  </div>
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="navbar-collapse">		
		    <ul class="nav navbar-nav">
		    	<li class="hidden-xs"><span class="navbar-text">Track My: </span></li>
		    	<li><a href="index.php">Appointments</a></li>
		    	<li><a href="mystudy.php">My Study</a></li>
			    <li><a href="subjects.php">Subjects</a></li>
			    <li><a href="resources.php">Resources</a></li>
		    </ul>

		    <ul id="signout" class="nav navbar-nav navbar-right">
			    <li><a href="signout.php">Log Out</a></li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
	  </div>
	</div>

	<div id="jumbo" class="jumbotron">
		<div class="container">
			<!--  cut jumbotron on mobile device  -->
			<h1><a href="index.php" class="hidden-xs">RS<b>TRACK</b>.org</a></h1>
			<div id="login_info" class="alert alert-info text-right hidden-xs">
				Welcome <strong><?= $user[0]['username'] ?></strong> -  
				You are tracking <strong>The <?= $study_name[0]['study'] ?> Study</strong>.
			</div>
		</div>	     			
	</div>

	<div class="container clear-top">
		<div id="middle">
			<!-- start content -->
