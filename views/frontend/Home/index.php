<?php $this->title = "Accueil - Site de Jean Forteroche"; ?>

<section class="banner-area">
	<div class="container box_1170">
		<div class="row fullscreen d-flex align-items-center justify-content-center">
			<div class="banner-content text-center col-lg-10">
				<h1>
					Billet simple <br>
					pour l'Alaska
				</h1>
				<h2>Le dernier romain de Jean Forteroche publié page par page</h2>
			</div>
		</div>
	</div>
</section>

<div class="main-body section-gap mt--30">
	<div class="container box_1170">
		<div class="row">
			<div class="col-lg-8 post-list">
				<!-- Start Post Area -->
				<section class="post-area">
					<?php foreach ($posts as $post): ?>
					<!-- Start Single post -->
					<div class="single-post-item">
						<figure>
							<img class="post-img img-fluid" src="elements/frontend/img/posts/p1.jpg" alt="">
						</figure>
						<h3>
							<a href="post&postId=<?=$post->postId()?>"><?= $post->postTitle() ?></a>
						</h3>
						<p><?= substr($post->postContent(), 0, 150) . '...' ?></p>
						<a href="post&postId=<?=$post->postId()?>" class="primary-btn text-uppercase mt-15">lire la suite</a>
						<div class="post-box">
							<div class="d-flex">
								<div>
									<a href="about">
										<img src="elements/frontend/img/author/a1.png" alt="">
									</a>
								</div>
								<div class="post-meta">
									<div class="meta-head">
										<a href="about">Jean Forteroche</a>
									</div>
									<div class="meta-details">
										<ul>
											<li>
												<a>
													<span class="lnr lnr-calendar-full"></span>
													<?= $post->postCreationDateFr() ?>
												</a>
											</li>
											<li>
												<a>
													<span class="lnr lnr-coffee-cup"></span>
													<?= $post->categoryTitle() ?>
												</a>
											</li>
											<li>
												<a>
													<span class="lnr lnr-bubble"></span>
													03 Comments
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Post -->
					<?php endforeach ?>

					<nav class="blog-pagination justify-content-center d-flex">
						<ul class="pagination">
							<?php if ($currentPage > 1): ?>
							<li class="page-item">
								<a href="home&page=<?= $currentPage - 1 ?>" class="page-link" aria-label="Previous">
									<span aria-hidden="true">
										<span class="lnr lnr-arrow-left"></span>
									</span>
								</a>
							</li>
							<?php endif ?>
							<?php for($i = 1; $i <= $pages; $i++): ?>
								<?php if ($currentPage === $i): ?>
									<li class="page-item active"><a href="home&page=<?= $i ?>" class="page-link"><?= $i ?></a></li>
								<?php else: ?>
									<li class="page-item"><a href="home&page=<?= $i ?>" class="page-link"><?= $i ?></a></li>
								<?php endif ?>
							<?php endfor ?>
							<?php if ($currentPage < $pages): ?>
							<li class="page-item">
								<a href="home&page=<?= $currentPage + 1 ?>" class="page-link" aria-label="Next">
									<span aria-hidden="true">
										<span class="lnr lnr-arrow-right"></span>
									</span>
								</a>
							</li>
							<?php endif ?>
						</ul>
					</nav>
				</section>
				<!-- End  Post Area -->
			</div>

			<?php include 'views/frontend/layout/sidebar.php' ?>
		</div>
	</div>
</div>