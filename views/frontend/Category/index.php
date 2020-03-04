<?php $this->title = $category[0]->categoryTitle()." - Site de Jean Forteroche"; ?>

<section class="banner-area relative">
	<div class="overlay overlay-bg"></div>
	<div class="container box_1170">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?= $category[0]->categoryTitle() ?>
				</h1>
				<p class="text-white link-nav">
					<a href="/home">Accueil</a>
					<span class="lnr lnr-arrow-right"></span>
					<a href="#">Chapitres</a>
					<span class="lnr lnr-arrow-right"></span>
					<a href="<?= 'category&categoryId=' . $category[0]->categoryId() ?>"><?= $category[0]->categoryTitle() ?></a></p>
			</div>
		</div>
	</div>
</section>

<div class="main-body section-gap">
	<div class="container box_1170">
		<div class="row">
			<div class="col-lg-8 post-list">
				<!-- Start Post Area -->
				<section class="post-area">
					<div class="row">
					<?php if (empty($posts)): ?>

						<div class="col-md-12">Il n'y a aucun article dans cette catégorie.</div>
					<?php else: ?>
						<?php foreach ($posts as $post): ?>
							<div class="col-lg-6 col-md-6">
								<div class="single-post-item short">
									<figure>
										<img class="post-img img-fluid" src="elements/frontend/img/category/c1.jpg" alt="">
									</figure>
									<h3>
										<a href="<?= 'post&postId=' . $post->postId() ?>"><?= $post->postTitle() ?></a>
									</h3>
									<p><?= substr($post->postContent(), 0, 150) . '...' ?></p>
									<a href="<?= 'post&postId=' . $post->postId() ?>" class="primary-btn text-uppercase mt-15">Lire la suite</a>
									<div class="post-box">
										<div class="d-flex">
											<div>
												<a href="#">
													<img src="elements/frontend/img/author/a1.png" alt="">
												</a>
											</div>
											<div class="post-meta">
												<div class="meta-head">
													<a href="/about">Jean Forteroche</a>
												</div>
												<div class="meta-details">
													<ul>
														<li>
															<a href="#">
																<span class="lnr lnr-calendar-full"></span>
																<?= $post->postCreationDateFr() ?>
															</a>
														</li>
														<li>
															<a href="#">
																<span class="lnr lnr-bubble"></span>
																03
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
					</div>
				</section>
				<!-- End Post Area -->
			</div>

			<?php include 'views/frontend/layout/sidebar.php' ?>
		</div>
	</div>
</div>
