					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Gestion des articles</h1>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=posts&action=create"><span class="nc-icon nc-simple-add"></span></a>
								</div>
							</div>
                        </div>
                        
                        <?php if(!empty($postToRead)): ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header ">
                                            <h4 class="card-title">Consulter un article</h4>
                                        </div>
                                        <div class="card-body ">
                                            <h3><?= $postToRead[0]->postTitle()?></h3>
                                            <?php if($postToRead[0]->postUpdateDateFr() === null): ?>
                                                <p>Article créé le <?= $postToRead[0]->postCreationDateFr() ?></p>
                                            <?php else: ?>
                                                <p>Article modifié le <?= $postToRead[0]->postUpdateDateFr() ?></p>
                                            <?php endif ?>
                                            
                                            <p><?= $postToRead[0]->postContent()?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if(!empty($postToUpdate)): ?>
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
                                                    <label for="postId">Id</label>
                                                    <input class="form-control" name="postId" type="text" placeholder="<?= $postToUpdate[0]->postId()?>" id="postId" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="postTitle">Titre</label>
                                                    <input type="text" class="form-control" name="postTitle" id="postTitle" value="<?= $postToUpdate[0]->postTitle()?>" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="postCategory">Catégorie</label>
                                                    <select name="categoryId" class="form-control" id="postCategory" required>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= $category->categoryId()?>" <?php if ($postToUpdate[0]->categoryTitle() === $category->categoryTitle()): echo 'selected' ?><?php endif ?> > <?= $category->categoryTitle()?> </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <label for="postContent">Contenu de l'article</label>
                                                    <textarea class="form-control" name="postContent" id="postContent" rows="19" required><?= $postToUpdate[0]->postContent()?></textarea>
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
										<h4 class="card-title">Mes articles</h4>
									</div>
									<div class="card-body table-full-width table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Titre</th>
                                                    <th scope="col">Catégorie</th>
                                                    <th scope="col">Dernière modification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($posts as $post): ?>
                                                    <tr>
                                                        <td><?= $post->postId() ?></td>
                                                        <td><?= $post->postTitle() ?></td>
                                                        <td><?= $post->categoryTitle() ?></td>
                                                        <?php if($post->postUpdateDateFr() === null): ?>
                                                            <td><?= $post->postCreationDateFr() ?></td>
                                                        <?php else: ?>
                                                            <td><?= $post->postUpdateDateFr() ?></td>
                                                        <?php endif ?>
                                                        <td class="action-cell"><a class="action-link action-link--external" href="index.php?url=post&postId=<?=$post->postId()?>" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=posts&action=read&postId=<?=$post->postId()?>"><i class="far fa-eye"></i></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=posts&action=edit&postId=<?=$post->postId()?>"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=posts&action=delete&postId=<?=$post->postId()?>" onclick="return confirm('Êtes-vous certain de vouloir supprimer cet article ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>
					</div>