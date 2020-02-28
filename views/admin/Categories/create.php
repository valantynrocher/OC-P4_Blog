					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes catégories</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=categories&action=list">Catégories</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
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
                                        <h4 class="card-title">Créer une nouvelle catégorie</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="admin.php?url=categories&action=insert" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="categoryChapter">Nom</label>
                                                    <input type="text" class="form-control" name="chapter" id="categoryChapter" placeholder="Nom de la catégorie" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="categoryImage">Image</label>
                                                    <input type="url" class="form-control" name="image" id="categoryImage" placeholder="URL de l'image" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    
					</div>