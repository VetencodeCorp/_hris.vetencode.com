<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>Starter Template - Materialize</title>

		<!-- CSS  -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="<?= base_url(); ?>assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="<?= base_url(); ?>assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	<body>
		<nav class="red darken-4" role="navigation">
			<div class="nav-wrapper">
				<a id="logo-container" href="#" class="brand-logo">vetencode</a>
				<ul class="right hide-on-med-and-down">
					<li>
						<a href="#">Navbar Link</a>
					</li>
				</ul>

				<ul id="nav-mobile" class="sidenav">
					<li>
						<a href="#">Navbar Link</a>
					</li>
				</ul>
				<a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			</div>
		</nav>
		
		<div class="section no-pad-bot">
			<div class="hide-on-med-and-down">
				<ul id="slide-out" class="sidenav sidenav-fixed">
					<li>
						<a href="#!">First Sidebar Link</a>
					</li>
					<li>
						<a href="#!">Second Sidebar Link</a>
					</li>
				</ul>
			</div>
			<div class="content">
				<div class="title">
					Dahsboard
				</div>
				<hr>
				<marquee><h5>SISTEM INFOMASI MANAJEMEN</h5></marquee>
			</div>
		
		</div>

		<!--  Scripts-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="<?= base_url(); ?>assets/js/materialize.js"></script>
		<script src="<?= base_url(); ?>assets/js/init.js"></script>
		<script>
			$(document).ready(function() {
				$('.datepicker').datepicker();
			});
		</script>

	</body>
</html>
