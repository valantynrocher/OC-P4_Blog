					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes utilisateurs</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=users&action=create" data-toggle="tooltip" data-placement="left" title="Nouvel utilisateur"><span class="nc-icon nc-simple-add"></span></a>
								</div>
							</div>
                        </div>

                        <div class="row">
							<div class="col">
								<div class="card ">
									<div class="card-header ">
                                        <h4 class="card-title">Liste des utilisateurs "admin"</h4>
									</div>
									<div class="card-body ">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Rôle</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Identifiant</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">Inscription</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($admins as $admin): ?>
                                                    <tr>
                                                        <td><span class="badge badge-primary">Admin</span></td>
                                                        <td><?= $admin->userFirstName() ?></td>
                                                        <td><?= $admin->userLastName() ?></td>
                                                        <td><?= $admin->userLogin() ?></td>
                                                        <td><?= $admin->userEmail() ?></td>
                                                        <td><?= $admin->userCreationDateFr() ?></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=users&action=edit&userId=<?=$admin->userId()?>" data-toggle="tooltip" data-placement="top" title="Modifier l'utilisateur"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=users&action=delete&userId=<?=$admin->userId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer l'utilisateur" onclick="return confirm('Vouslez-vous vraiment supprimer cet utilisateur ? ATTENTION : Cette action est irréversible.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>

                        <div class="row">
							<div class="col">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Liste des utilisateurs "lecteur"</h4>
									</div>
									<div class="card-body ">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Rôle</th>
                                                    <th scope="col">Prénom</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Identifiant</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">Inscription</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($readers as $reader): ?>
                                                    <tr>
                                                        <td><span class="badge badge-secondary">Lecteur</span></td>
                                                        <td><?= $reader->userFirstName() ?></td>
                                                        <td><?= $reader->userLastName() ?></td>
                                                        <td><?= $reader->userLogin() ?></td>
                                                        <td><?= $reader->userEmail() ?></td>
                                                        <td><?= $reader->userCreationDateFr() ?></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=users&action=edit&userId=<?=$reader->userId()?>" data-toggle="tooltip" data-placement="top" title="Modifier l'utilisateur"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=users&action=delete&userId=<?=$reader->userId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer l'utilisateur" onclick="return confirm('Vouslez-vous vraiment supprimer cet utilisateur ? ATTENTION : Cette action est irréversible.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>

                        
					</div>