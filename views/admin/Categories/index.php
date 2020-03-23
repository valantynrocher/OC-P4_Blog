                    <div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes catégories</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=categories">Catégories</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=categories&action=create" data-toggle="tooltip" data-placement="left" title="Nouvelle catégorie"><span class="nc-icon nc-simple-add"></span></a>
								</div>
							</div>
                        </div>

                        <div class="row">
							<div class="col">
								<div class="card strpied-tabled-with-hover">
									<div class="card-header">
										<h4 class="card-title">Mes catégories</h4>
									</div>
									<div class="card-body table-full-width table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Nom</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($categories as $category): ?>
                                                    <tr>
                                                        <td><?= $category->categoryId() ?></td>
                                                        <td><?= $category->categoryTitle() ?></td>
                                                        <td class="action-cell"><a class="action-link action-link--external" href="index.php?url=category&categoryId=<?=$category->categoryId()?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Voir la catégorie en ligne"><i class="fas fa-external-link-alt"></i></a></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=categories&action=edit&categoryId=<?=$category->categoryId()?>" data-toggle="tooltip" data-placement="top" title="Modifier la catégorie"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=categories&action=delete&categoryId=<?=$category->categoryId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer la catégorie" onclick="return confirm('ATTENTION : tous les articles et les commentaires associés à cette catégorie seront également supprimés. Êtes-vous certain de vouloir supprimer cette catégorie ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>
					</div>