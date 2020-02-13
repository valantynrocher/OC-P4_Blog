					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Ajouter un article</h1>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=posts&action=list"><span class="nc-icon nc-stre-left"></span></a>
								</div>
							</div>
                        </div>

                        <!-- show form to create a post -->
                        
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header ">
                                        <h4 class="card-title">Ajouter un nouvel article</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="admin.php?url=posts&action=insert" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="postTitle">Titre</label>
                                                    <input type="text" class="form-control" name="title" id="postTitle" placeholder="Titre de l'article" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="postCategory">Catégorie</label>
                                                    <select name="categoryId" class="form-control" id="postCategory" required>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= $category->id()?>"> <?= $category->name()?> </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="postContent">Contenu de l'article</label>
                                                    <textarea class="form-control" name="content" id="postContent" rows="19" required></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Publier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    
					</div>