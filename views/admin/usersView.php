					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Gérer les utilisateurs</h1>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href=#><span class="nc-icon nc-simple-add"></span></a>
								</div>
							</div>
                        </div>
                    
                        <div class="row">
                            <div class="card col container align-self-center">
                                <div class="card-header ">
									<h4 class="card-title">Ajouter un utilisateur</h4>
								</div>
                                <form action="admin.php?url=users" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="text" name="firstName" placeholder="Prénom" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="text" name="lastName" placeholder="Nom" required>
                                        </div>
                                    </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="text" name="login" placeholder="Identifiant" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="text" name="email" placeholder="E-mail" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Rôle</label>
                                            <select name="role" class="form-control">
                                                <option value="admin">Admin</option>
                                                <option value="reader" selected>Lecteur</option>
                                            </select>
                                        </div>
                                    </div>

                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </form>
                            </div>
                        </div>

                        <div class="row">
							<div class="col">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Liste des utilisateurs</h4>
									</div>
									<div class="card-body ">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Identifiant</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">Rôle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user): ?>
                                                    <tr>
                                                        <td><?= $user->userFirstName() ?></td>
                                                        <td><?= $user->userLastName() ?></td>
                                                        <td><?= $user->userLogin() ?></td>
                                                        <td><?= $user->userEmail() ?></td>
                                                        <td><?= $user->userRole() ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>

                        
					</div>