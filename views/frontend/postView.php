	<!-- start banner Area -->
	<section class="banner-area relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						<?= $post[0]->name() ?>
					</h1>
					<p class="text-white link-nav">
						<a href="/home">Accueil</a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="#">Chapitres</a>
						<span class="lnr lnr-arrow-right"></span>
						<a href="#"><?= $post[0]->name() ?></a>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

    <!-- Blog Area -->
    <section class="blog_area section-gap single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="public/img/blog/p1.jpg" alt="">
                        <h4><?= $post[0]->title() ?></h4>
                        <div class="user_details">
                            <div class="float-right">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>Jean Forteroche</h5>
                                        <p><?= $post[0]->creation_date_fr() ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <img src="public/img/author/a1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><?= $post[0]->content() ?></p>
                        <div class="news_d_footer">
                            <a href="#"><i class="lnr lnr lnr-heart"></i>Like(s)</a>
                            <a><i class="lnr lnr lnr-bubble"></i><?= count($comments)?> Commentaire(s)</a>
                            <div class="news_socail ml-auto">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-rss"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="comments-area">
						<?php if (empty($comments)): ?>
							<div class="comments-area">
								Il n'y a aucun commentaire pour cet article, soyez le premier !
							</div>
						<?php else: ?>
							<h4><?= count($comments)?> Commentaire(s)</h4>
							<div class="comment-list">
								<?php foreach ($comments as $comment): ?>
									<div class="container single-comment">
										<div class="justify-content-between d-flex">
											<div class="user justify-content-between d-flex">
												<!--<div class="thumb">
													<img src="public/img/blog/c1.jpg" alt="">
												</div>-->
												<div class="desc">
													<h5><a href="#"><?= $comment->author()?></a></h5>
													<p class="date"><?= $comment->creation_date_fr()?></p>
													<p class="comment">
														<?= $comment->comment()?>
													</p>
												</div>
											</div>
											<?php if ($comment->report() === 0): ?>
												<div class="report-btn">
													<a href="report&id=<?= $comment->id() ?>&postId=<?=$post[0]->id() ?>"
													onclick="return confirm('Le signalement de commentaire permet de faire remonter à l\'administrateur des commentaires dont le contenu semble irrespectueux, outrancier, diffamatoire, etc. Êtes-vous certain de vouloir signaler ce commentaire ?')"
													class="genric-btn danger radius text-uppercase">
														<i class="fas fa-exclamation-triangle"></i>
													</a>
												</div>
											<?php endif ?>
										</div>
										<?php if ($comment->report() === 1): ?>
											<div class="report-alert genric-alert danger">
												Ce commentaire a été signalé et sera modéré par l'administrateur de ce blog.										
											</div>
										<?php endif ?>
									 </div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
                        
                    </div>
                    <div class="comment-form">
                        <h4>Poster un commentaire</h4>
                        <form>
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter Name'">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    <input type="email" class="form-control" id="email" placeholder="Enter email address"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Subject'">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                            </div>
                            <a href="#" class="primary-btn submit_btn text-uppercase">Envoyer</a>
                        </form>
                    </div>
				</div>

				<!-- Start Sidebar -->
				<div class="col-lg-4 sidebar">
					<div class="single-widget search-widget">
						<form class="example" action="#" style="margin:auto;max-width:300px">
							<input type="text" placeholder="Search Posts" name="search2">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>

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
							<li><a href="<?= 'category&cat_id=' . $category->id() ?>" class="justify-content-between align-items-center d-flex">
									<p><?= $category->name() ?></p> <span>37</span>
								</a>
							</li>
							<?php endforeach ?>
						</ul>
					</div>

					<div class="single-widget newsletter-widget">
						<h4 class="title">Newsletter</h4>
						<div id="mc_embed_signup">
							<form target="_blank" novalidate="true" action="comment&id=<?=$_GET['id']?>"
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
				<!-- End Sidebar -->
			</div>
		</div>
	</section>
				

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
												<a href="report&id=<?= $comment->id() ?>&postId=<?=$post[0]->id() ?>" onclick="return confirm('Le signalement de commentaire permet de faire remonter à l\'administrateur des commentaires dont le contenu semble irrespectueux, outrancier, diffamatoire, etc. Êtes-vous certain de vouloir signaler ce commentaire ?')">
												<span class="fas fa-exclamation"></span> Signaler ce commentaire</a>
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