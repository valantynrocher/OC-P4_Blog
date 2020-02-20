
<div class="container-fluid">
	<div class="row">
		<div class="card col-6 container align-self-center">
			<h2>Bienvenue sur votre espace d'administration !</h2>
			<h4>Veuillez vous connecter</h4>
			<form action="" method="POST">
				<?php if ($error !== null): ?>
					<div class="alert alert-danger">
						<?= $error ?>
					</div>
				<?php endif ?>
				<div class="form-group">
					<input class="form-control" type="text" name="userLogin" placeholder="Votre login">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="userPassword" placeholder="Votre mot de passe">
				</div>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
		</div>
	</div>
</div>