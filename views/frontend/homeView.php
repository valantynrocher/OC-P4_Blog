

	<!-- slider -->
	<div class="main-header">
        
    </div>

    <!-- category slider -->
	<div class="category-slider">
		<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
			data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
			data-swiper-breakpoints="true" data-swiper-loop="true" >
			<div class="swiper-wrapper">

				<?php foreach ($categories as $category): ?>
					<div class="swiper-slide">
						<a class="slider-category" href="<?= 'category&cat_id=' . $category->id() ?>">
							<div class="blog-image"><img src="<?= $category->image() ?>"></div>

							<div class="category">
								<div class="display-table center-text">
									<div class="display-table-cell">
										<h3><b><?= $category->name() ?></b></h3>
									</div>
								</div>
							</div>

						</a>
					</div><!-- swiper-slide -->
				<?php endforeach ?>

			</div><!-- swiper-wrapper -->

		</div><!-- swiper-container -->

	</div>

	<div class="main">
		<section class="blog-area section">
			<div class="container">

				<div class="row">

					<?php foreach ($posts as $post): ?>

					<!-- col-lg-4 col-md-6 -->
					<div class="col-lg-4 col-md-6">
						<!-- card -->
						<div class="card h-100">
							<!-- single-post extra-blog -->
							<div class="single-post post-style-2 post-style-3">
								<div class="blog-info">

									<h6 class="pre-title">
										<b><?= $post->name() ?></b>
									</h6>

									<h4 class="title">
										<a href="<?= 'post&id=' . $post->id() ?>">
										<b><?= $post->title() ?></b>
										</a>
									</h4>

									<!-- post excerpt -->
									<p>
										<?= substr($post->content(), 0, 150) . '...' ?>
									</p>

									<div class="avatar-area">
										<img class="avatar" src="public/images/jean-rochefort-avatar.jpg" alt="Profile Image">
										<div class="right-area">
											<b class="name">Jean Forteroche</b>
											<h6 class="date"><?= $post->creation_date_fr() ?></h6>
										</div>
									</div>

									<ul class="post-footer">
										<li><a href="#"><i class="ion-heart"></i>57</a></li>
										<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
										<li><a href="#"><i class="ion-eye"></i>138</a></li>
									</ul>

								</div>
							</div>
						</div>
					</div>
					
					<?php endforeach ?>

				</div><!-- row -->

				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<?php if ($currentPage > 1): ?>
						<li class="page-item"><a class="page-link" href="/home&page=<?= $currentPage - 1 ?>" tabindex="-1" aria-disabled="true">Page précédente</a></li>
						<?php endif ?>
						
						<?php for($i = 1; $i <= $pages; $i++): ?>
						<li class="page-item"><b><a class="page-link" href="/home&page=<?= $i ?>"><?= $i ?></a></b></li>
						<?php endfor ?>

						<?php if ($currentPage < $pages): ?>
						<li class="page-item"><a class="page-link" href="/home&page=<?= $currentPage + 1 ?>">Page suivante</a></li>
						<?php endif ?>
					</ul>
				</nav>

			</div><!-- container -->
		</section><!-- section -->
	</div>