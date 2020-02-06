
	
	<!-- slider -->
    <div class="chapter-header">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b><?= $post[0]->name() ?></b></h1>
		</div>
	</div>
	<div class="main">
		<!-- post-area -->
		<section class="post-area section">
			<div class="container">

				<div class="row">

					<div class="col-lg-8 col-md-12 no-right-padding">

						<!-- main-post -->
						<div class="main-post">

		 					<div class="blog-post-inner">

								<!-- post-info -->
								<div class="post-info">

									<div class="left-area">
										<a class="avatar" href="#"><img src="public/images/jean-rochefort-avatar.jpg" alt="Profile Image"></a>
									</div>

									<div class="middle-area">
										<a class="name" href="#"><b>Jean Forteroche</b></a>
										<h6 class="date"><!-- on Sep 29, 2017 at 9:48 am --><?= $post[0]->creation_date_fr() ?></h6>
									</div>

								</div>

								<!-- post-title -->
								<h3 class="title">
									<a href="#"><b>
									<?= $post[0]->title() ?></b>
									</a>
								</h3>

								<!-- post-content -->
								<p class="para">
									<?= $post[0]->content() ?>
								</p>

							</div>

							<!-- post-icons -->
							<div class="post-icons-area">
								<ul class="post-icons">
									<li><a href="#"><i class="ion-heart"></i>57</a></li>
									<li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
									<li><a href="#"><i class="ion-eye"></i>138</a></li>
								</ul>

								<ul class="icons">
									<li>SHARE : </li>
									<li><a href="#"><i class="ion-social-facebook"></i></a></li>
									<li><a href="#"><i class="ion-social-twitter"></i></a></li>
									<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
								</ul>
							</div>
							
						</div>
					</div><!-- col-lg-8 col-md-12 -->

					<!-- sidebar -->
					<div class="col-lg-4 col-md-12 no-left-padding">

						<!-- sidebar info-area -->
						<div class="single-post info-area">

							<div class="sidebar-area about-area">
								<h4 class="title"><b>A propos</b></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
									ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
									Ut enim ad minim veniam</p>
							</div>

						</div>

					</div>

				</div><!-- row -->
			</div><!-- container -->
		</section>

		<!-- comments-area -->
		<section class="section comment-section">
			<div class="container">
				<h4><b>POSTER UN COMMENTAIRE</b></h4>
				<div class="row">

					<div class="col">
						<div class="comment-form">
							<form action="comment&id=<?=$_GET['id']?>" method="POST">
								<div class="row">

									<div class="col-sm-6">
										<input type="text" aria-required="true" name="author" class="form-control"
										placeholder="Votre nom" aria-invalid="true" required >
									</div><!-- col-sm-6 -->

									<div class="col-sm-12">
										<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Votre commentaire" aria-required="true" aria-invalid="false"></textarea >
									</div><!-- col-sm-12 -->
									<div class="col-sm-12">
										<button class="submit-btn" type="submit" id="form-submit"><b>POSTER</b></button>
									</div><!-- col-sm-12 -->

								</div><!-- row -->
							</form>
						</div><!-- comment-form -->

						<?php if (empty($comments)): ?>
							<div class="comments-area">
								Il n'y a aucun commentaire pour cet article, soyez le premier !
							</div>

						<?php else: ?>

						<h4><b><?= count($comments)?> COMMENTAIRES :</b></h4>

						<?php foreach ($comments as $comment): ?>
						<div class="comments-area">
							
								<div class="comment">

									<div class="post-info">
										<div class="middle-area">
											<h6 class="date"><?= $comment->creation_date_fr()?></h6><br>
											<b><?= $comment->author()?> a commenté :</b>
										</div>
									</div><!-- post-info -->

									<div class="comment-content">
										<p><?= $comment->comment()?></p>
									</div>
									<div class="comment-report">
									<?php if ($comment->report() === 0): ?>
										<div class="comment-report__link">
											<a href="report&id=<?= $comment->id() ?>&postId=<?=$post[0]->id() ?>" onclick="return confirm('Le signalement de commentaire permet de faire remonter à l\'administrateur des commentaires dont le contenu semble irrespectueux, outrancier, diffamatoire, etc. Êtes-vous certain de vouloir signaler ce commentaire ?')"><span class="fas fa-exclamation"></span> Signaler ce commentaire</a>
										</div>
									<?php elseif ($comment->report() === 1): ?>
										<div class="comment-report__link alert alert-danger" role="alert">
											Ce commentaire a été signalé et sera modéré par l'administrateur de ce blog.
										</div>
									<?php endif ?>
									</div>

								</div>
						</div><!-- comments-area -->

						<?php endforeach ?>

						<!-- <a class="more-comment-btn" href="#"><b>VOIR PLUS DE COMMENTAIRES</a> -->

						<?php endif ?>

					</div><!-- col-lg-8 col-md-12 -->

				</div><!-- row -->

			</div><!-- container -->
		</section>
	</div>