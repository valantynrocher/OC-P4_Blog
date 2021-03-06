					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes articles</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php?url=posts">Articles</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=posts" data-toggle="tooltip" data-placement="left" title="Retour à la liste des articles"><span class="nc-icon nc-stre-left"></span></a>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header ">
                                        <h4 class="card-title">Ajouter un nouvel article</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="admin.php?url=posts&action=insert" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <label>Rang</label>
                                                    <input type="number" class="form-control" name="postRank" id="postRank" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Titre</label>
                                                    <input type="text" class="form-control" name="postTitle" id="postTitle" placeholder="Titre de l'article" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Catégorie</label>
                                                    <select name="categoryId" class="form-control" id="postCategory" required>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= $category->categoryId()?>"> <?= $category->categoryTitle()?> </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>État</label>
                                                    <select name="postStatus" class="form-control" id="postStatus" required>
                                                        <option value="progress" selected>Brouillon</option>
                                                        <option value="public">Publié</option>
                                                        <option value="trash">Corbeille</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label>Contenu de l'article</label>
                                                    <textarea class="form-control" name="postContent" id="postContent" rows="19"></textarea>
                                                </div>
                                            </div>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Publier"></input>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

					</div>