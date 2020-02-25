					<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mes articles</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Articles</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                                    </ol>
                                </nav>
                            </div>
							<div class="content-header__button">
								<div class="card">
                                    <a href="admin.php?url=posts&action=create" data-toggle="tooltip" data-placement="left" title="Nouvel article"><span class="nc-icon nc-simple-add"></span></a>
								</div>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col">
								<div class="card strpied-tabled-with-hover">
									<div class="card-header">
                                        <h4 class="card-title">Tous mes articles</h4>
									</div>
									<div class="card-body table-full-width table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">État</th>
                                                    <th scope="col">Titre</th>
                                                    <th scope="col">Catégorie</th>
                                                    <th scope="col">Dernière modification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($posts as $post): ?>
                                                    <tr>
                                                        <td><?= $post->postId() ?></td>
                                                        <?php if($post->postStatus() === 'progress'): ?>
                                                            <td><span class="badge badge-warning">Brouillon</span></td>
                                                        <?php elseif($post->postStatus() === 'public'): ?>
                                                            <td><span class="badge badge-success">Publié</span></td>
                                                        <?php elseif($post->postStatus() === 'trash'):?>
                                                            <td><span class="badge badge-danger">Corbeille</span></td>
                                                        <?php endif ?>
                                                        <td><?= $post->postTitle() ?></td>
                                                        <td><?= $post->categoryTitle() ?></td>
                                                        <?php if($post->postUpdateDateFr() === null): ?>
                                                            <td><?= $post->postCreationDateFr() ?></td>
                                                        <?php else: ?>
                                                            <td><?= $post->postUpdateDateFr() ?></td>
                                                        <?php endif ?>
                                                        <td class="action-cell"><a class="action-link action-link--external" href="index.php?url=post&postId=<?=$post->postId()?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Voir l'article en ligne"><i class="fas fa-external-link-alt"></i></a></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=posts&action=read&postId=<?=$post->postId()?>" data-toggle="tooltip" data-placement="top" title="Lire l'article"><i class="far fa-eye"></i></td>
                                                        <td class="action-cell"><a class="action-link" href="admin.php?url=posts&action=edit&postId=<?=$post->postId()?>" data-toggle="tooltip" data-placement="top" title="Modifier l'article"><i class="far fa-edit"></i></td>
                                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=posts&action=trash&postId=<?=$post->postId()?>" data-toggle="tooltip" data-placement="top" title="Mettre l'article à la corbeille" onclick="return confirm('Vouslez-vous vraiment mettre cet article à la corbeille ?')"><i class="far fa-trash-alt"></i></a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
									</div>
								</div>
							</div>
                        </div>
					</div>