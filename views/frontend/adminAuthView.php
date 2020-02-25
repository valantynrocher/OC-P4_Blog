<section class="banner-area relative">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Espace adminnistrateurs
				</h1>
			</div>
		</div>
	</div>
</section>

<div class="container auth-forms">
	<div class="row justify-content-center">
		<div class="col-md-6 ">
			<div class="card text-center">
				<div class="card-header">
					Vous êtes administrateur de ce site ?<br> Munissez vous de votre login et de votre mot de passe et connectez-vous !
				</div>
				<div class="card-body">
					<form action="auth&action=login&userType=admin" method="POST" class="form-signin">
						<h2 class="h3 mb-3 font-weight-normal">Connexion à l'espace d'administration</h2>
						<?php if (isset($errorLoginMsg) && $errorLoginMsg !== null): ?>
							<div class="alert alert-danger">
								<?= $errorLoginMsg ?>
							</div>
						<?php endif ?>
						<div class="form-group">
							<label for="userLogin" class="sr-only">Identifiant</label>
							<input type="text" name ="login" id="userLogin" class="form-control" placeholder="Votre identifiant" required autofocus>
						</div>
						<div class="form-group">
							<label for="userPassword" class="sr-only">Mot de passe</label>
							<input type="password" name="password" id="userPassword" class="form-control" placeholder="Votre mot de passe" required>
						</div>
						<button class="btn btn-warning" name="submit" type="submit">Connexion</button>
						<p>Vous n'êtes pas administrateur du site ? <a href="auth&action=reader">Connectez-vous ici</a></p>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>