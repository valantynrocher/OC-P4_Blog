
<div class="main-header display-table center-text">
		<h1 class="title display-table-cell"><b><?= $category[0]->name() ?></b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">
				<?php if (empty($postsCategory)): ?>

					<div>Il n'y a aucun article dans cette catégorie.</div>
				
				<?php else: ?>
				<?php foreach ($postsCategory as $post): ?>
					<!-- col-lg-4 col-md-6 -->
					<div class="col-lg-4 col-md-6">
						<!-- card -->
						<div class="card h-100">
							<!-- single-post extra-blog -->
							<div class="single-post post-style-2 post-style-3">
								<div class="blog-info">

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

		<?php endif ?>
		</div><!-- container -->
	</section><!-- section -->