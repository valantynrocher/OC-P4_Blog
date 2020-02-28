<?php $this->title = $post[0]->postTitle()." - Site de Jean Forteroche"; ?>

<section class="banner-area relative">
	<div class="overlay overlay-bg"></div>
	<div class="container">
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white">
					<?= $post[0]->categoryTitle() ?>
				</h1>
				<p class="text-white link-nav">
					<a href="/home">Accueil</a>
					<span class="lnr lnr-arrow-right"></span>
					<a href="#">Chapitres</a>
					<span class="lnr lnr-arrow-right"></span>
					<a href="<?= 'category&categoryId=' . $post[0]->categoryId() ?>"><?= $post[0]->categoryTitle() ?></a>
				</p>
			</div>
		</div>
	</div>
</section>

<section class="blog_area section-gap single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="main_blog_details">
                    <h4><?= $post[0]->postTitle() ?></h4>
                    <div class="user_details">
                        <div class="float-right">
                            <div class="media">
                                <div class="media-body">
                                    <h5>Jean Forteroche</h5>
                                    <p><?= $post[0]->postCreationDateFr() ?></p>
                                </div>
                                <div class="d-flex">
                                    <img src="public/img/author/a1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><?= $post[0]->postContent() ?></p>
                    <div class="news_d_footer">
                        <a href="#"><i class="lnr lnr-heart"></i>Like(s)</a>
                        <a><i class="lnr lnr-bubble"></i><?= count($comments)?> Commentaire(s)</a>
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
											<div class="desc">
												<h5><?= $comment->commentAuthor()?></h5>
												<p class="date"><?= $comment->commentCreationDateFr()?></p>
												<p class="comment">
													<?= $comment->commentContent()?>
												</p>
											</div>
										</div>
										<?php if ($comment->commentStatus() === 'waiting' || $comment->commentStatus() === 'public'): ?>
											<div class="report-btn">
												<a href="comment&action=report&commentId=<?= $comment->commentId() ?>&postId=<?=$post[0]->postId() ?>"
												onclick="return confirm('Le signalement de commentaire permet de faire remonter à l\'administrateur des commentaires dont le contenu semble irrespectueux, outrancier, diffamatoire, etc. Êtes-vous certain de vouloir signaler ce commentaire ?')"
												class="genric-btn danger radius text-uppercase">
													<i class="fas fa-exclamation-triangle"></i>
												</a>
											</div>
										<?php endif ?>
									</div>
									<?php if ($comment->commentStatus() === 'report'): ?>
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
					<?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === 1): ?>
                    <form action="comment&action=publish&postId=<?=$post[0]->postId() ?>" method="POST">
                        <div class="form-group ">
                            <div class="form-group">
                                <input type="text" name="author" class="form-control" id="author" placeholder="Votre nom ou pseudo" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Votre nom ou pseudo'" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" name="comment" rows="5" name="message" placeholder="Votre message"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Votre message'" required=""></textarea>
                        </div>
                        <button type="submit" class="primary-btn submit_btn text-uppercase">Envoyer</button>
					</form>
					<?php else: ?>
						<div class="card">
							Pour publier des commentaires, vous devez être connecté.
							Pas encore inscrit ? Crééez votre compte ici !
							Déjà lecteur fidèle ? Connectez-vous ici !
						</div>
					<?php endif ?>
                </div>
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
						<li>
							<a href="<?= 'category&categoryId=' . $category->categoryId() ?>" class="justify-content-between align-items-center d-flex">
								<p><?= $category->categoryTitle() ?></p>
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
		</div>
	</div>
</section>