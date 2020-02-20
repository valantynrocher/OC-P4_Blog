                    <div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Gestion des catégories</h1>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=categories&action=create"><span class="nc-icon nc-simple-add"></span></a>
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
                                            <form action="admin.php?url=categories&action=update&id=<?= $categoryToUpdate[0]->id() ?>" method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="categoryName">Nom</label>
                                                        <input type="text" class="form-control" name="name" id="categoryName" value="<?= $categoryToUpdate[0]->chapter() ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="categoryImage">Image</label>
                                                        <input type="text" class="form-control" name="image" id="categoryImage" value="<?= $categoryToUpdate[0]->image() ?>" required>
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
                                                        <td><?= $category->id() ?></td>
                                                        <td><?= $category->chapter() ?></td>
                                                        <td class="action-cell"><a class="action-link action-link--external" href="index.php?url=category&id=<?=$category->id()?>" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=categories&action=edit&id=<?=$category->id()?>"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=categories&action=delete&id=<?=$category->id()?>" onclick="return confirm('Êtes-vous certain de vouloir supprimer cet article ? Cette action est définitive. Si cette catégorie contient des articles, vous devez d\'abord supprimer ces articles.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>
					</div>