<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="Elements/Frontend/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="Valentin Rocher">
	<!-- Meta Description -->
	<meta name="description" content="Bienvenue sur le blog de Jean Forteroche,
	écrivain et aventurier pour découvrir son dernier roman 'Billet simple pour l'Alaska'
	au fil de son écriture !">
	<!-- Meta Keyword -->
	<meta name="keywords" content="blog, auteur, écrivain, Alaska, roman, édition,
	Jean, Forteroche, Jean Forteroche">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title><?= $title ?></title>

	<!-- GOOGLE FONTS ==================================== -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700|Roboto:400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
	
	<!-- CSS ============================================= -->
	<link rel="stylesheet" href="Elements/Frontend/css/linearicons.css">
	<link rel="stylesheet" href="Elements/Frontend/css/font-awesome.min.css">
	<link rel="stylesheet" href="Elements/Frontend/css/bootstrap.css">
	<link rel="stylesheet" href="Elements/Frontend/css/magnific-popup.css">
	<link rel="stylesheet" href="Elements/Frontend/css/nice-select.css">
	<link rel="stylesheet" href="Elements/Frontend/css/animate.min.css">
	<link rel="stylesheet" href="Elements/Frontend/css/owl.carousel.css">
	<link rel="stylesheet" href="Elements/Frontend/css/main.css">

	<!-- KIT FONT AWESOME ================================= -->
	<script src="https://kit.fontawesome.com/a7e4cf03d5.js" crossorigin="anonymous"></script>

	<!-- COOKIES PRIVACY -->
	<link rel="stylesheet" type="text/css" href="//wpcc.io/lib/1.0.2/cookieconsent.min.css"/>
	<script src="//wpcc.io/lib/1.0.2/cookieconsent.min.js"></script>
</head>

	<body>

		<!-- Start header Area -->
		<header id="header">
			<div class="container box_1170 main-menu">
				<div class="row align-items-center justify-content-between d-flex">
					<div id="logo">
						<a href="home"><img src="Elements/Frontend/img/logo.png" alt="Logo" title="Logo"/></a>
					</div>
					<nav id="nav-menu-container">
						<ul class="nav-menu">
							<li class="menu-active"><a href="home">Accueil</a></li>
							<?php if (!empty($categories)): ?>
								<li><a href="static&action=about">Qui suis-je</a></li>
								<li class="menu-has-children"><a href="#">Chapitres</a>
									<ul>
										<?php foreach ($categories as $category): ?>
											<li><a href="category&categoryId=<?=$category->categoryId()?>"><?= $category->categoryTitle() ?></a></li>
										<?php endforeach ?>
									</ul>
								</li>
							<?php endif ?>
							<li><a href="static&action=contact">Contact</a></li>
							<li class="btn btn-warning" ><a href="auth"><i class="fas fa-user"></i> Espace personnel</a></li>
						</ul>
					</nav>
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
							<div>
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
								<?php if (isset($_SESSION['connected'])): ?>
									<li>Connecté en tant que <b><?=strtoupper($_SESSION['user']['login'])?></b></li>
									<li><a href="auth&action=account">Gérer mon compte</a></li>
									<li><a href="auth&action=logout">Déconnexion</a></li>
								<?php else: ?>
								<li><a href="auth">S'inscrire/Se connecter</a></li>
								<?php endif ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget f_social_wd">
							<h6 class="footer_title">Restez connectés</h6>
							<p>Je parle de mon livre et de mes aventures sur les réseaux sociaux !</p>
							<div class="f_social">
								<a href="#"><i class="fab fa-facebook-square"></i></a>
								<a href="#"><i class="fab fa-twitter-square"></i></a>
								<a href="#"><i class="fab fa-instagram-square"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="row footer-bottom d-flex justify-content-between align-items-center">
					<div class="col-lg-4 footer-text text-center">
						 <a href="static&action=legals">Mentions légales</a>
						 |
						 <a href="static&action=cookies">Cookies</a>
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

		<!-- SCRIPTS LOADING -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
		
		<script src="Elements/Frontend/js/vendor/jquery-2.2.4.min.js"></script>
		<script src="Elements/Frontend/js/vendor/bootstrap.min.js"></script>

		<script src="Elements/Frontend/js/superfish.min.js"></script>
		<script src="Elements/Frontend/js/owl.carousel.min.js"></script>
		<script src="Elements/Frontend/js/main.js"></script>
	</body>

</html>