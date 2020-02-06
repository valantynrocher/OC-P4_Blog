<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<title>BLOG PHP</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">


		<!-- Font -->

		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

		<script src="https://kit.fontawesome.com/a7e4cf03d5.js" crossorigin="anonymous"></script>

		<!-- Stylesheets -->
		<link href="public/css/bootstrap.css" rel="stylesheet">
		<link href="public/css/swiper.css" rel="stylesheet">
		<link href="public/css/ionicons.css" rel="stylesheet">

		<link href="public/css/frontend.css" rel="stylesheet">
		<link href="public/css/responsive.css" rel="stylesheet">

	</head>

	<body >

		<header>
			<div class="header-wrapper container-fluid position-relative">

				<a href="/home" class="logo"><h3>Jean Forteroche</h3></a>

				<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

				<!-- main-menu -->
				<nav class="main-menu visible-on-click" id="main-menu">
					<a href="/home">Accueil</a>
					<a href="/about">A propos</a>
				</nav>

				<div class="src-area">
					<form>
						<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
						<input class="src-input" type="text" placeholder="Type of search">
					</form>
				</div>

			</div>
			
		</header>
		
		
		<?= $content  ?>

		<footer>

			<div class="container">
				<div class="row">

					<div class="col-lg-4 col-md-6">
						<div class="footer-section">

							<a class="logo" href="admin.php" target="_blank">Administration</a>
							<p class="copyright">Bona @ 2017. All rights reserved.</p>
							<p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
							<ul class="icons">
								<li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
							</ul>

						</div><!-- footer-section -->
					</div><!-- col-lg-4 col-md-6 -->

					<div class="col-lg-4 col-md-6">
							<div class="footer-section">
							<h4 class="title"><b>CATEGORIES</b></h4>
							<ul>
								<li><a href="#">BEAUTY</a></li>
								<li><a href="#">HEALTH</a></li>
								<li><a href="#">MUSIC</a></li>
							</ul>
							<ul>
								<li><a href="#">SPORT</a></li>
								<li><a href="#">DESIGN</a></li>
								<li><a href="#">TRAVEL</a></li>
							</ul>
						</div><!-- footer-section -->
					</div><!-- col-lg-4 col-md-6 -->

					<div class="col-lg-4 col-md-6">
						<div class="footer-section">

							<h4 class="title"><b>SUBSCRIBE</b></h4>
							<div class="input-area">
								<form>
									<input class="email-input" type="text" placeholder="Enter your email">
									<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
								</form>
							</div>

						</div><!-- footer-section -->
					</div><!-- col-lg-4 col-md-6 -->

				</div><!-- row -->
			</div><!-- container -->
		</footer>
		

		<!-- SCIPTS -->

		<script src="public/js/jquery-3.1.1.min.js"></script>
		<script src="public/js/tether.min.js"></script>
		<script src="public/js/bootstrap.js"></script>
		<script src="public/js/swiper.js"></script>
		<script src="public/js/scripts.js"></script>

	</body>
</html>