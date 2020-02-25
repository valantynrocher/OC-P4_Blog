<!DOCTYPE html>
<html lang="fr" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="public/public/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Jean Forteroche - Ecrivain</title>

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700|Roboto:400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
	
	<!-- CSS ============================================= -->
	<link rel="stylesheet" href="public/css/linearicons.css">
	<link rel="stylesheet" href="public/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/bootstrap.css">
	<link rel="stylesheet" href="public/css/magnific-popup.css">
	<link rel="stylesheet" href="public/css/nice-select.css">
	<link rel="stylesheet" href="public/css/animate.min.css">
	<link rel="stylesheet" href="public/css/owl.carousel.css">
	<link rel="stylesheet" href="public/css/main.css">

	<!-- KIT FONT AWESOME ============================================= -->
	<script src="https://kit.fontawesome.com/a7e4cf03d5.js" crossorigin="anonymous"></script>
</head>

	<body>

		<!-- Start header Area -->
		<header id="header">
			<div class="container box_1170 main-menu">
				<div class="row align-items-center justify-content-between d-flex">
					<div id="logo">
						<a href="/home"><img src="public/img/logo.png" alt="" title="" /></a>
					</div>
					<nav id="nav-menu-container">
						<ul class="nav-menu">
							<li class="menu-active"><a href="/home">Accueil</a></li>
							<?php if (!empty($categories)): ?>
								<li class="menu-has-children"><a href="">Chapitres</a>
									<ul>
										<?php foreach ($categories as $category): ?>
											<li><a href="category&categoryId=<?=$category->categoryId()?>"><?= $category->categoryTitle() ?></a></li>
										<?php endforeach ?>
									</ul>
								</li>
							<?php endif ?>
							<li><a href="/about">Qui suis-je</a></li>
							<li><a href="/contact">Contact</a></li>
							<li class="btn btn-warning" ><a href="auth&action=reader"><i class="fas fa-user"></i> Mon compte</a></li>
						</ul>
					</nav>
					
					<div class="search-widget">
						<form class="example" action="#">
							<input type="text" placeholder="Rechercher un article" name="search2">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>
		</header>
		<!-- End header Area -->

		<?= $content ?>

		<!-- Start footer Area -->
		<footer class="footer-area section-gap">
			<div class="container box_1170">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<h6 class="footer_title">Qui suis-je ?</h6>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
								magna aliqua.
							</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<h6 class="footer_title">Newsletter</h6>
							<p>Recevez les dernières pages du livre dans votre boîte mail</p>
							<div id="mc_embed_signup">
								<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
								method="get" class="subscribe_form relative">
									<div class="input-group d-flex flex-row">
										<input name="EMAIL" placeholder="Votre e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre e-mail '"
										required="" type="email">
										<button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>
									</div>
									<div class="mt-10 info"></div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget instafeed">
							<h6 class="footer_title">Espace utilisateurs</h6>
							<ul>
								<?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === 1): ?>
									<li>Connecté en tant que <?=$_SESSION['user']['login']?> (<?=$_SESSION['user']['role']?>)</li>
									<li><a href="auth&action=account">Gérer mon compte</a></li>
									<li><a href="auth&action=logout">Déconnexion</a></li>
								<?php endif ?>
								<li><a href="auth&action=reader">S'inscrire/Se connecter</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget f_social_wd">
							<h6 class="footer_title">Restez connectés</h6>
							<p>Je parle de mon livre et de mes aventures sur les réseaux sociaux !</p>
							<div class="f_social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="row footer-bottom d-flex justify-content-between align-items-center">
					<div class="col-lg-4 footer-text text-center">
						 <a href="/legals">Mentions légales</a>					
					</div>
					<p class="col-lg-8 footer-text text-center"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<a href="http://valantyn.fr" target=_blank>Valentin Rocher, www.valantyn.fr </a>
						Copyright &copy;<script>document.write(new Date().getFullYear());</script>
						Tous droits réservés |
						Template créée avec <i class="fa fa-heart-o" aria-hidden="true"></i>
						par <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</footer>
		<!-- End footer Area -->

		<script src="public/js/vendor/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
		<script src="public/js/vendor/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
		<script src="public/js/easing.min.js"></script>
		<script src="public/js/hoverIntent.js"></script>
		<script src="public/js/superfish.min.js"></script>
		<script src="public/js/jquery.ajaxchimp.min.js"></script>
		<script src="public/js/jquery.magnific-popup.min.js"></script>
		<script src="public/js/owl.carousel.min.js"></script>
		<script src="public/js/jquery.nice-select.min.js"></script>
		<script src="public/js/waypoints.min.js"></script>
		<script src="public/js/mail-script.js"></script>
		<script src="public/js/main.js"></script>
	</body>

</html>