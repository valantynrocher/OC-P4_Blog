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
					<?php if (empty($postsCategory)): ?>

						<div class="col-md-12">Il n'y a aucun article dans cette catégorie.</div>
					<?php else: ?>
						<?php foreach ($postsCategory as $post): ?>
							<div class="col-lg-6 col-md-6">
								<div class="single-post-item short">
									<figure>
										<img class="post-img img-fluid" src="public/img/category/c1.jpg" alt="">
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
													<img src="public/img/author/a1.png" alt="">
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
						<li><a href="<?= 'category&categoryId=' . $category->categoryId() ?>" class="justify-content-between align-items-center d-flex">
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
								<input chapter()="EMAIL" placeholder="Votre e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre e-mail '"
								required="" type="email">
								<div style="position: absolute; left: -5000px;">
									<input chapter()="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
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
