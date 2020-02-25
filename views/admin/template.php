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

		<!-- TinyMCE -->
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
					<ul class="nav">
						<li class="nav-item <?php if ($_GET['url'] === 'dashboard') echo 'active' ?>">
							<a class="nav-link" href="admin.php?url=dashboard">
								<i class="nc-icon nc-tv-2"></i>
								<p>Tableau de bord</p>
							</a>
						</li>
						<li class="nav-item <?php if ($_GET['url'] === 'posts') echo 'active' ?>">
							<a class="nav-link" href="admin.php?url=posts&action=list">
								<i class="nc-icon nc-single-copy-04"></i>
								<p>Articles</p>
							</a>
						</li>
						<li class="nav-item <?php if ($_GET['url'] === 'comments') echo 'active' ?>">
							<a class="nav-link" href="admin.php?url=comments&action=list">
								<i class="nc-icon nc-chat-round"></i>
								<p>Commentaires</p>
							</a>
						</li>
						<li class="nav-item <?php if ($_GET['url'] === 'categories') echo 'active' ?>">
							<a class="nav-link" href="admin.php?url=categories&action=list">
								<i class="nc-icon nc-bullet-list-67"></i>
								<p>Catégories</p>
							</a>
						</li>
						<li class="nav-item <?php if ($_GET['url'] === 'users') echo 'active' ?>">
							<a class="nav-link" href="admin.php?url=users&action=list">
								<i class="nc-icon nc-single-02"></i>
								<p>Utilisateurs</p>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="main-panel">

				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg " color-on-scroll="500">
					<div class="container-fluid">
						<div class="show-username">
							<p>
								Bonjour
								<?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === 1): ?>
									<?=$_SESSION['user']['firstName']?>
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
							<ul class="navbar-nav ml-auto">
								<li class="nav-item">
									<a class="nav-link" href="index.php" target="_blank">
										<i class="far fa-eye"></i>
										Voir le site
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										<i class="fas fa-user-circle"></i>
										Mon profil
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="index.php?url=auth&action=logout">
										<i class="fas fa-power-off"></i>
										Déconnexion
									</a>
								</li>
							</ul>
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
	<!-- Bootstrap Tooltip init -->
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>	
	<!-- TinyMCE init -->
	<script>
		tinymce.init({
			selector: '#postContent',
			language: 'fr_FR',
			language_url : 'private/js/tinyMCE/langs/fr_FR.js'
      	});
	</script>

</html>
