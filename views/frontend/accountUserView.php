<?php $this->title = "Mon espace personnel - Site de Jean Forteroche"; ?>

<section class="banner-area relative">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					Mon espace personnel
				</h1>
			</div>
		</div>
	</div>
</section>

<div class="container auth-forms">
	<div class="row">

		<div class="col">
			<div class="card">
				<div class="card-header account">
					<h3>Bonjour <?= $_SESSION['user']['firstName']. ' ' . $_SESSION['user']['lastName']?> !</h3>
					<p>Bienvenue sur votre espace utilisateur.<br>Vous pouvez ici consulter et modifier vos informations personnelles.</p>
					<div class="card admin-link">
                        <a href="admin.php?url=posts&action=create" data-toggle="tooltip" data-placement="left" title="Nouvel article"><span class="nc-icon nc-simple-add"></span></a>
					</div>
 				</div>
				<div class="card-body row text-center">
					<div class="col-md-8">
						<form action="" method="POST" class="form-signin">
							<h2 class="h3 mb-3 font-weight-normal">Mes informations personnelles</h2>
							<div class="form-group">
								<label for="userLastName" class="sr-only">Nom</label>
								<input type="text" name="lastName" id="userLastName" class="form-control" value="<?= $_SESSION['user']['lastName'] ?>" required autofocus>
							</div>
							<div class="form-group">
								<label for="userFirstName" class="sr-only">Prénom</label>
								<input type="text" name="firstName" id="userFirstName" class="form-control" value="<?= $_SESSION['user']['firstName'] ?>" required autofocus>
							</div>
							<div class="form-group">
								<label for="userEmail" class="sr-only">E-mail</label>
								<input type="email" name="email" id="userEmail" class="form-control" value="<?= $_SESSION['user']['email'] ?>" required autofocus>
							</div>
							<div class="form-group">
								<label for="userLogin" class="sr-only">Identifiant</label>
								<input type="text" name="login" id="userLogin" class="form-control" value="<?= $_SESSION['user']['login'] ?>" required autofocus>
							</div>
							<button class="btn btn-warning" type="submit">Enregistrer</button>
						</form>
					</div>
					<div class="col-md-4">
						<form action="" method="POST" class="form-signin">
							<h2 class="h3 mb-3 font-weight-normal">Mon mot de passe</h2>
							<?php if (isset($errorSignupMsg) && $errorSignupMsg !== null): ?>
								<div class="alert alert-danger">
									<?= $errorSignupMsg ?>
								</div>
							<?php elseif(isset($successMsg) && $successMsg !== null): ?>
								<div class="alert alert-success">
									<?= $successMsg ?>
								</div>
							<?php endif ?>
							<div class="form-group">
								<label for="userPassword" class="sr-only">Mot de passe</label>
								<input type="password" name="password" id="userPassword" class="form-control" placeholder="Votre nouveau mot de passe" required>
							</div>
							<div class="form-group">
								<label for="confirmPassword" class="sr-only">Mot de passe</label>
								<input type="password" name="passwordConfirm" id="confirmPassword" class="form-control" placeholder="Confirmez votre saisie" required>
							</div>
							<button class="btn btn-warning" type="submit">Enregistrer</button>
						</form>
					</div>
				</div>
				<div>
					Dernière connexion : <?= $_SESSION['user']['lastConnexion'] ?>
				</div>
			</div>
		</div>
		
	</div>
</div>