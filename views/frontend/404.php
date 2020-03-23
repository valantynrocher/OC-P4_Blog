<?php $this->title = "Erreur 404 - Site de Jean Forteroche"; ?>

<section class="banner-area relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						Erreur 404
					</h1>
				</div>
			</div>
		</div>
    </section>
    
<div class="container">
    <h1><?= $errorMsg ?></h1>
	<pre><?= print_r($_SERVER)?></pre>
</div>