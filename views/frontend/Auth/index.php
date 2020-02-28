<?php $this->title = "Espace utilisateur - Site de Jean Forteroche"; ?>

<section class="banner-area relative">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Espace utilisateur
				</h1>
			</div>
		</div>
	</div>
</section>

<div class="container auth-forms">
	<div class="row">
		<div class="col-md-6">
			<div class="card text-center">
				<div class="card-header">
					Vous êtes déjà un fidèle lecteur ?<br> Munissez vous de votre login et de votre mot de passe et connectez-vous !
				</div>
				<div class="card-body">
					<form action="auth&action=login" method="POST" class="form-signin">
						<h2 class="h3 mb-3 font-weight-normal">Se connecter</h2>
						<?php if ($errorLoginMsg !== null): ?>
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
						<button class="btn btn-warning" name="signIn" type="submit">Connexion</button>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card text-center">
				<div class="card-header">
					Vous ne comptez pas parmis mes fidèles lecteurs ?<br> Inscrivez-vous en quelques clics !
				</div>
				<div class="card-body">
					<form action="auth&action=signup" method="POST" class="form-signin">
						<h2 class="h3 mb-3 font-weight-normal">S'inscrire</h2>
						<?php if ($errorSignupMsg !== null): ?>
							<div class="alert alert-danger">
								<?= $errorSignupMsg ?>
							</div>
						<?php elseif($successMsg !== null): ?>
							<div class="alert alert-success">
								<?= $successMsg ?>
							</div>
						<?php endif ?>
						<div class="form-group">
							<label for="userLastName" class="sr-only">Nom</label>
							<input type="text" name="lastName" id="userLastName" class="form-control" placeholder="Votre nom" required autofocus>
						</div>
						<div class="form-group">
							<label for="userFirstName" class="sr-only">Prénom</label>
							<input type="text" name="firstName" id="userFirstName" class="form-control" placeholder="Votre prénom" required autofocus>
						</div>
						<div class="form-group">
							<label for="userEmail" class="sr-only">E-mail</label>
							<input type="email" name="email" id="userEmail" class="form-control" placeholder="Votre e-mail" required autofocus>
						</div>
						<div class="form-group">
							<label for="userLogin" class="sr-only">Identifiant</label>
							<input type="text" name="login" id="userLogin" class="form-control" placeholder="Votre identifiant" required autofocus>
						</div>
						<div class="form-group">
							<label for="userPassword" class="sr-only">Mot de passe</label>
							<input type="password" name="password" id="userPassword" class="form-control" placeholder="Votre mot de passe" required>
						</div>
						<div class="form-group">
							<label for="confirmPassword" class="sr-only">Mot de passe</label>
							<input type="password" name="passwordConfirm" id="confirmPassword" class="form-control" placeholder="Confirmez votre mot de passe" required>
						</div>
						<button class="btn btn-warning" name="signUp" type="submit">Inscription</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>