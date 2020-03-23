            <div class="col-lg-4 sidebar">
				<div class="single-widget search-widget">
					<form class="example" action="#" style="margin:auto;max-width:300px">
						<input type="text" placeholder="Rechercher..." name="search2">
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="single-widget protfolio-widget">
					<img class="img-fluid" src="Elements/Frontend/img/jean-forterouche-about.jpg" alt="About" title="About">
					<a href="#">
						<h4>Jean Forteroche</h4>
					</a>
					<div class="desigmation">
						<p>écrivain & aventurier</p>
					</div>
					<p>
						Jean Forteroche est un personnage inimitable et un écrivain
                        inclassable. Depuis 30 ans, ses aventures sur le globe lui ont inspiré
                        ses plus beaux livres et ses plus grands succès.
                        Pour son nouveau livre, Jean Forteroche perpétue son originalité
                        en vous proposant une lecture au fil de son écriture.
                        Laissez-vous transporter dans les méandres fraiches de l'Alaska,
                        cette immense terre d'amérique du nord, intriguante et envoutante.
					</p>
					<ul>
						<li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
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
					<div>
						<form action="comment&id=<?=$_GET['id']?>" method="POST">
							<div class="form-group">
								<input type="email" name="email" placeholder="Votre e-mail" required>
								<button name="submit" class="primary-btn text-uppercase">
									Je m'abonne
									<span class="lnr lnr-arrow-right"></span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>