<div class="container-fluid">
                        
    <div class="content-header">
        <div class="content-header__title">
            <h1>Mes utilisateurs</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php?url=users">Utilisateurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
                </ol>
            </nav>
        </div>
		<div class="content-header__button">
			<div class="card">
                <a href="admin.php?url=users" data-toggle="tooltip" data-placement="left" title="Retour à la liste des utilisateurs"><span class="nc-icon nc-stre-left"></span></a>
			</div>
		</div>
    </div>
                    
    <div class="row">
        <div class="card col container align-self-center">
            <div class="card-header ">
				<h4 class="card-title">Ajouter un utilisateur</h4>
            </div>
            
            <?php if (isset($errorInsertMsg) && $errorInsertMsg !== null): ?>
                <div class="alert alert-danger">
                    <?= $errorInsertMsg ?>
                </div>
            <?php endif ?>

            <form action="admin.php?url=users&action=insert" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Prénom</label>
                        <input class="form-control" type="text" name="firstName" placeholder="Prénom">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nom</label>
                        <input class="form-control" type="text" name="lastName" placeholder="Nom">
                    </div>
                </div>  
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Identifiant</label>
                        <input class="form-control" type="text" name="login" placeholder="Identifiant" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="email" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirmez le mot de passe</label>
                        <input class="form-control" type="password" name="passwordConfirm" placeholder="Mot de passe" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Rôle</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="reader" selected>Lecteur</option>
                        </select>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer"></input>
            </form>
        </div>
    </div>

</div>