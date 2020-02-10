<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 
 <!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="apple-touch-icon" sizes="76x76" href="../private/img/apple-icon.png">
		<link rel="icon" type="image/png" href="../private/img/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Administration - Jean Forteroche</title>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

		<!--     Fonts and icons     -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
		<!-- CSS Files -->
		<link href="../private/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../private/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
		<!-- CSS Just for demo purpose, don't include it in your project -->
		<link href="../private/css/demo.css" rel="stylesheet" />

		<script src="https://kit.fontawesome.com/a7e4cf03d5.js" crossorigin="anonymous"></script>

		<script src="https://cdn.tiny.cloud/1/he8as15x59uxbesh3g7jf5d0knmdtjs1z46ompdvcwoahoyt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	</head>

	<body>
		<div class="wrapper">

			<div class="sidebar" data-image="../private/img/jean-forteroche-sidebar.jpg">
				<div class="sidebar-wrapper">
					<div class="logo">
						<a href="admin.php?url=dashboard" class="simple-text">
							Billet simple pour l'Alaska
						</a>
					</div>
					<!-- <?php if($_SESSION['connected']): ?> -->
					<ul class="nav">
						<li class="nav-item active">
							<a class="nav-link" href="admin.php?url=dashboard">
								<i class="nc-icon nc-tv-2"></i>
								<p>Tableau de bord</p>
							</a>
						</li>
						<li>
							<a class="nav-link" href="admin.php?url=posts">
								<i class="nc-icon nc-single-copy-04"></i>
								<p>Articles</p>
							</a>
						</li>
						<li>
							<a class="nav-link" href="admin.php?url=comments">
								<i class="nc-icon nc-chat-round"></i>
								<p>Commentaires</p>
							</a>
						</li>
						<li>
							<a class="nav-link" href="admin.php?url=categories">
								<i class="nc-icon nc-bullet-list-67"></i>
								<p>Catégories</p>
							</a>
						</li>
						<li>
							<a class="nav-link" href="admin.php?url=users">
								<i class="nc-icon nc-single-02"></i>
								<p>Utilisateurs</p>
							</a>
						</li>
					</ul>
					<!-- <?php endif ?> -->
				</div>
			</div>

			<div class="main-panel">

				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg " color-on-scroll="500">
					<div class="container-fluid">
						<div class="show-username">
							<p>
								Bonjour
								<?php if($_SESSION['connected']): ?>
								<a href="#"><?=$_SESSION['userName']?></a>
								<?php endif ?>
								!
							</p>
						</div>
						<button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-bar burger-lines"></span>
							<span class="navbar-toggler-bar burger-lines"></span>
							<span class="navbar-toggler-bar burger-lines"></span>
						</button>

						<div class="collapse navbar-collapse justify-content-end" id="navigation">
							<!-- <?php if($_SESSION['connected']): ?> -->
							<ul class="navbar-nav ml-auto">
								<li class="nav-item">
									<a class="nav-link" href="#">
										<span class="no-icon">Mon profil</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="admin.php?url=logout">
										<span class="nc-icon nc-button-power"></span>
									</a>
								</li>
							</ul>
							<!-- <?php endif ?> -->
						</div>
					</div>
				</nav>
				<!-- End Navbar -->

				<div class="content">
					<?= $content ?>
				</div>
				<!-- End Content -->

				<footer class="footer">
					<div class="container-fluid">
						<p class="copyright text-center">
							©
							<script>
								document.write(new Date().getFullYear())
							</script>
							<a href="http://www.creative-tim.com">Tempalte by Creative Tim</a>. Site développé par <a href="http://valantyn.fr" target="_blank">Valentin Rocher</a>
						</p>
					</div>
				</footer>
				<!-- End Footer -->
				
			</div>
		</div>

		<!--   -->
		<!-- <div class="fixed-plugin">
		<div class="dropdown show-dropdown">
			<a href="#" data-toggle="dropdown">
				<i class="fa fa-cog fa-2x"> </i>
			</a>

			<ul class="dropdown-menu">
				<li class="header-title"> Sidebar Style</li>
				<li class="adjustments-line">
					<a href="javascript:void(0)" class="switch-trigger">
						<p>Background Image</p>
						<label class="switch">
							<input type="checkbox" data-toggle="switch" checked="" data-on-color="primary" data-off-color="primary"><span class="toggle"></span>
						</label>
						<div class="clearfix"></div>
					</a>
				</li>
				<li class="adjustments-line">
					<a href="javascript:void(0)" class="switch-trigger background-color">
						<p>Filters</p>
						<div class="pull-right">
							<span class="badge filter badge-black" data-color="black"></span>
							<span class="badge filter badge-azure" data-color="azure"></span>
							<span class="badge filter badge-green" data-color="green"></span>
							<span class="badge filter badge-orange" data-color="orange"></span>
							<span class="badge filter badge-red" data-color="red"></span>
							<span class="badge filter badge-purple active" data-color="purple"></span>
						</div>
						<div class="clearfix"></div>
					</a>
				</li>
				<li class="header-title">Sidebar Images</li>

				<li class="active">
					<a class="img-holder switch-trigger" href="javascript:void(0)">
						<img src="../private/img/sidebar-1.jpg" alt="" />
					</a>
				</li>
				<li>
					<a class="img-holder switch-trigger" href="javascript:void(0)">
						<img src="../private/img/sidebar-3.jpg" alt="" />
					</a>
				</li>
				<li>
					<a class="img-holder switch-trigger" href="javascript:void(0)">
						<img src="..//private/img/sidebar-4.jpg" alt="" />
					</a>
				</li>
				<li>
					<a class="img-holder switch-trigger" href="javascript:void(0)">
						<img src="../private/img/sidebar-5.jpg" alt="" />
					</a>
				</li>

				<li class="button-container">
					<div class="">
						<a href="http://www.creative-tim.com/product/light-bootstrap-dashboard" target="_blank" class="btn btn-info btn-block btn-fill">Download, it's free!</a>
					</div>
				</li>

				<li class="header-title pro-title text-center">Want more components?</li>

				<li class="button-container">
					<div class="">
						<a href="http://www.creative-tim.com/product/light-bootstrap-dashboard-pro" target="_blank" class="btn btn-warning btn-block btn-fill">Get The PRO Version!</a>
					</div>
				</li>

				<li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

				<li class="button-container">
					<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i class="fa fa-twitter"></i> · 256</button>
					<button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i class="fa fa-facebook-square"></i> · 426</button>
				</li>
			</ul>
		</div>
	</div>
	-->
	</body>


	<!--   Core JS Files   -->
	<script src="../private/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../private/js/core/popper.min.js" type="text/javascript"></script>
	<script src="../private/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="../private/js/plugins/bootstrap-switch.js"></script>
	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	<!--  Chartist Plugin  -->
	<script src="../private/js/plugins/chartist.min.js"></script>
	<!--  Notifications Plugin    -->
	<script src="../private/js/plugins/bootstrap-notify.js"></script>
	<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
	<script src="../private/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="../private/js/demo.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// Javascript method's body can be found in private/js/demos.js
			demo.initDashboardPageCharts();

		});
	</script>
	<script>
		tinymce.init({
        	selector: '#postContent'
      	});
	</script>

</html>