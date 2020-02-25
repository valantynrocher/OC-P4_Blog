					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes utilisateurs</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=users&action=list">Utilisateurs</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=users&action=list" data-toggle="tooltip" data-placement="left" title="Retour à la liste des utilisateurs"><span class="nc-icon nc-stre-left"></span></a>
								</div>
							</div>
                        </div>
                    
                        <div class="row">
                            <div class="card col container align-self-center">
                                <div class="card-header ">
                                    <h4 class="card-title">Modifier l'utilisateur</h4>
								</div>
                                <form action="admin.php?url=users&action=update&userId=<?=$userToUpdate[0]->userId()?>" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Prénom</label>
                                            <input class="form-control" type="text" name="firstName" value="<?=$userToUpdate[0]->userFirstName()?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Nom</label>
                                            <input class="form-control" type="text" name="lastName" value="<?=$userToUpdate[0]->userLastName()?>">
                                        </div>
                                    </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Identifiant</label>
                                            <input class="form-control" type="text" name="login" value="<?=$userToUpdate[0]->userLogin()?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Mot de passe</label>
                                            <input class="form-control" type="password" name="password" placeholder="Saisir un nouveau mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">E-mail</label>
                                            <input class="form-control" type="text" name="email" value="<?=$userToUpdate[0]->userEmail()?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Rôle</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" <?php if ($userToUpdate[0]->userRole() === 'admin') echo 'selected'?>>Admin</option>
                                                <option value="reader" <?php if ($userToUpdate[0]->userRole() === 'reader') echo 'selected'?>>Lecteur</option>
                                            </select>
                                        </div>
                                    </div>

                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
                            </div>
                        </div>

					</div>