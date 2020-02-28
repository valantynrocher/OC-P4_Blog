                    <div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes catégories</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=categories&action=list">Catégories</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=categories&action=list" data-toggle="tooltip" data-placement="left" title="Retour à la liste des catégorie"><span class="nc-icon nc-stre-left"></span></a>
								</div>
							</div>
                        </div>

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

					</div>