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
							<img class="post-img img-fluid" src="public/img/posts/p1.jpg" alt="">
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
										<img src="public/img/author/a1.png" alt="">
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

			<div class="col-lg-4 sidebar">

				<div class="single-widget protfolio-widget">
					<img class="img-fluid" src="public/img/jean-forterouche-about.jpg" alt="">
					<a href="#">
						<h4>Jean Forteroche</h4>
					</a>
					<div class="desigmation">
						<p>Écrivain aventurier</p>
					</div>
					<p>
						about...
					</p>
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>

				<div class="single-widget category-widget">
					<h4 class="title">Les chapitres</h4>
					<ul>
						<?php foreach ($categories as $category): ?>
						<li><a href="category&categoryId=<?= $category->categoryId() ?>" class="justify-content-between align-items-center d-flex">
								<p><?= $category->categoryTitle() ?></p>
							</a>
						</li>
						<?php endforeach ?>
					</ul>
				</div>

				<div class="single-widget newsletter-widget">
					<h4 class="title">Newsletter</h4>
					<div id="mc_embed_signup">
						<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
						method="get" class="">
							<div class="form-group" style="width: 100%">
								<input name="EMAIL" placeholder="Votre e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre e-mail '"
								required="" type="email">
								<div style="position: absolute; left: -5000px;">
									<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
								</div>

								<button class="primary-btn text-uppercase">
									Je m'abonne
									<span class="lnr lnr-arrow-right"></span>
								</button>
							</div>
							<div class="info"></div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>