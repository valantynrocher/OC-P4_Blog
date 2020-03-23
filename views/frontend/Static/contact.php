<?php $this->title = "Me contacter - Site de Jean Forteroche"; ?>

	<section class="banner-area relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						Me contacter
					</h1>
					<p class="text-white link-nav">
						<a href="/home">Accueil</a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="#">Me contacter</a>
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="contact-page-area section-gap">
		<div class="container">
			<?php if (!empty($feedback)): ?>
			<div class="row">
				<?php if ($success): ?>
				<div class="col-md-12 genric-alert success">
					<?= $feedback ?>
				</div>
				<?php else: ?>
				<div class="col-md-12 genric-alert danger">
					<?= $feedback ?>
				</div>
				<?php endif ?>
			</div>
			<?php endif ?>
			<div class="row">
			<div class="col-lg-4 d-flex flex-column address-wrap">
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-home"></span>
						</div>
						<div class="contact-details">
							<h5>Jean Forteroche</h5>
							<p>15, rue des Vieilles Douves à Nantes</p>
						</div>
					</div>
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-phone-handset"></span>
						</div>
						<div class="contact-details">
							<h5>06 95 53 86 73</h5>
							<p>Joignable à tout moment</p>
						</div>
					</div>
					<div class="single-contact-address d-flex flex-row">
						<div class="icon">
							<span class="lnr lnr-envelope"></span>
						</div>
						<div class="contact-details">
							<h5>valantyn.r@gmail.com</h5>
							<p>Par e-mail ou grâce au formulaire !</p>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<form class="form-area " id="contact" action="static&action=email" method="post" class="contact-form text-right">
						<div class="row">
							<div class="col-lg-6 form-group">
								<input name="name" placeholder="Votre nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre nom'"
								 class="common-input mb-20 form-control" required type="text">

								<input name="email" placeholder="Votre e-mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
								 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre e-mail'" class="common-input mb-20 form-control"
								 required="" type="email">

								<input name="subject" placeholder="Objet" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Objet'"
								 class="common-input mb-20 form-control" required type="text">
							</div>
							<div class="col-lg-6 form-group">
								<textarea class="common-textarea form-control" name="message" placeholder="Message" onfocus="this.placeholder = ''"
								 onblur="this.placeholder = 'Message'" required></textarea>
							</div>
							<div class="col-lg-12 d-flex justify-content-between">
								<div class="alert-msg" style="text-align: left;"></div>
								<button class="genric-btn primary circle text-uppercase" style="float: right;" type="submit">Envoyer</button>
							</div>
						</div>
					</form>
				</div>
				<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
				
			</div>
		</div>
	</section>