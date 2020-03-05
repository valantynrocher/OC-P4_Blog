<div class="container-fluid">
                        
    <div class="content-header">
        <div class="content-header__title">
            <h1>Mes articles</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php?url=posts">Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
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
                    <h4 class="card-title">Modifier un article</h4>
                </div>
                <div class="card-body">
                    <form action="admin.php?url=posts&action=update&postId=<?= $postToUpdate[0]->postId()?>" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Rang</label>
                                <input type="number" class="form-control" name="postRank" id="postRank" value="<?= $postToUpdate[0]->postRank()?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Titre</label>
                                <input type="text" class="form-control" name="postTitle" id="postTitle" value="<?= $postToUpdate[0]->postTitle()?>" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Catégorie</label>
                                <select name="categoryId" class="form-control" id="postCategory" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->categoryId()?>" <?php if ($postToUpdate[0]->categoryTitle() === $category->categoryTitle()): echo 'selected' ?><?php endif ?> > <?= $category->categoryTitle()?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>État</label>
                                <select name="postStatus" class="form-control" id="postStatus" required>
                                    <option value="progress" <?php if ($postToUpdate[0]->postStatus() === 'progress'): echo 'selected' ?><?php endif ?>>Brouillon</option>
                                    <option value="public" <?php if ($postToUpdate[0]->postStatus() === 'public'): echo 'selected' ?><?php endif ?>>Publié</option>
                                    <option value="trash" <?php if ($postToUpdate[0]->postStatus() === 'trash'): echo 'selected' ?><?php endif ?>>Corbeille</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label>Contenu de l'article</label>
                                <textarea class="form-control" name="postContent" id="postContent" rows="19"><?= $postToUpdate[0]->postContent()?></textarea>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>