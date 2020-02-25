                    <div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes catégories</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=categories&action=list">Catégories</a></li>
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

                        <?php if(!empty($categoryToUpdate)): ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header ">
                                            <h4 class="card-title">Modifier une catégorie</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="admin.php?url=categories&action=update&categoryId=<?= $categoryToUpdate[0]->categoryId() ?>" method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="categoryTitle">Titre</label>
                                                        <input type="text" class="form-control" name="categoryTitle" id="categoryTitle" value="<?= $categoryToUpdate[0]->categoryTitle() ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="categoryImage">Image</label>
                                                        <input type="text" class="form-control" name="categoryImage" id="categoryImage" value="<?= $categoryToUpdate[0]->categoryImage() ?>" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

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
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=categories&action=delete&categoryId=<?=$category->categoryId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer la catégorie" onclick="return confirm('Êtes-vous certain de vouloir supprimer cet article ? Cette action est définitive. Si cette catégorie contient des articles, vous devez d\'abord supprimer ces articles.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>
					</div>