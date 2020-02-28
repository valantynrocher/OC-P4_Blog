					<div class="container-fluid">
						
						<div class="row">
							<!-- POSTS CARD-->
							<div class="col-md-6">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Mes articles</h4>
									</div>
									<div class="card-body ">

										<div class="card__keys">
											<div class="card card__keys__item card__keys__item--blue">
												<h4><?= $publicPostsNumber ?></h4>
												<p>articles en ligne</p>
											</div>
											<div class="card card__keys__item card__keys__item--orange">
												<h4><?= $progressPostsNumber ?></h4>
												<p>articles en cours de rédaction</p>
											</div>
										</div>

										<div class="strpied-tabled-with-hover dashboard-table">
											<div class="card-header">
												<h5 class="card-title">Mes 5 derniers articles publiés :</h5>
											</div>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th scope="col">Titre</th>
															<th scope="col">Catégorie</th>
															<th scope="col">Dernière modification</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($lastFivesPublicsPosts as $post): ?>
															<tr>
																<td><?= $post->postTitle() ?></td>
																<td><?= $post->categoryTitle() ?></td>
																<?php if($post->postUpdateDateFr() === null): ?>
																	<td><?= $post->postCreationDateFr() ?></td>
																<?php else: ?>
																	<td><?= $post->postUpdateDateFr() ?></td>
																<?php endif ?>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- COMMENTS CARD-->
							<div class="col-md-6">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Mes commentaires</h4>
									</div>
									<div class="card-body ">

										<div class="card__keys">
											<div class="card card__keys__item card__keys__item--red">
												<h4><?= $reportCommentsNumber ?></h4>
												<p>commentaires signalés</p>
											</div>
											<div class="card card__keys__item card__keys__item--orange">
												<h4><?= $waitingCommentsNumber ?></h4>
												<p>commentaires non lus</p>
											</div>
										</div>

										<div class="strpied-tabled-with-hover dashboard-table">
											<div class="card-header">
												<h5 class="card-title">Mes 5 derniers commentaires modérés :</h5>
											</div>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th scope="col">Article</th>
															<th scope="col">Auteur</th>
															<th scope="col">Dernière modification</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($lastFivePublicsComments as $comment): ?>
															<tr>
																<td><?= $comment->postTitle() ?></td>
																<td><?= $comment->commentAuthor() ?></td>
																<td><?= $comment->commentCreationDateFr() ?></td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>

						<div class="row">

							<!-- CATEGORIES CARD-->
							<div class="col-md-4">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Mes catégories</h4>
									</div>
									<div class="card-body ">

										<div class="card__keys">
											<div class="card card__keys__item card__keys__item--blue">
												<h4><?= $categoriesNumber ?></h4>
												<p>catégories</p>
											</div>
										</div>

										<div class="strpied-tabled-with-hover dashboard-table">
											<div class="card-header">
												<h5 class="card-title">Mes 5 dernières catégories :</h5>
											</div>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th scope="col">Titre</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($lastFiveCategories as $category): ?>
															<tr>
																<td><?= $category->categoryTitle() ?></td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- USERS CARD-->
							<div class="col-md-8">
								<div class="card ">
									<div class="card-header ">
										<h4 class="card-title">Mes utilisateurs</h4>
									</div>
									<div class="card-body ">

										<div class="card__keys">
											<div class="card card__keys__item card__keys__item--purple">
												<h4><?= $adminUsersNumber ?></h4>
												<p>administrateurs</p>
											</div>
											<div class="card card__keys__item card__keys__item--grey">
												<h4><?= $readerUsersNumber ?></h4>
												<p>lecteurs</p>
											</div>
										</div>

										<div class="strpied-tabled-with-hover dashboard-table">
											<div class="card-header">
												<h5 class="card-title">Mes 5 derniers utilisateurs inscrits :</h5>
											</div>
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th scope="col">Rôle</th>
															<th scope="col">Identifiant</th>
															<th scope="col">E-mail</th>
															<th scope="col">Inscription</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($lastFiveUsers as $user): ?>
															<tr>
																<?php if ($user->userRole() === 'admin'): ?>
																	<td><span class="badge badge-primary">Admin</span></td>
																<?php elseif ($user->userRole() === 'reader'): ?>
																	<td><span class="badge badge-secondary">Lecteur</span></td>
																<?php endif ?>
																<td><?= $user->userLogin() ?></td>
																<td><?= $user->userEmail() ?></td>
																<td><?= $user->userCreationDateFr() ?></td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>