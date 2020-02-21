<div class="container-fluid">
                        
    <div class="content-header">
        <div class="content-header__title">
            <h1>Mes articles</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php?url=posts&action=list">Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Consulter</li>
                </ol>
            </nav>
        </div>
        <div class="content-header__button">
            <div class="card">
                <a href="admin.php?url=posts&action=list"><span class="nc-icon nc-stre-left"></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title">Consulter un article</h4>
                </div>
                <div class="card-body ">
                    <h3><?= $postToRead[0]->postTitle()?></h3>
                    <?php if($postToRead[0]->postStatus() === 'progress'): ?>
                        <p><i class="post-status post-status--progress fas fa-circle"></i> Brouillon</p>
                    <?php elseif($postToRead[0]->postStatus() === 'public'): ?>
                        <p><i class="post-status post-status--public fas fa-circle"></i> Publié</p>
                    <?php elseif($postToRead[0]->postStatus() === 'trash'):?>
                        <p><i class="post-status post-status--trash fas fa-circle"></i> Corbeille</p>
                    <?php endif ?>
                        <?php if($postToRead[0]->postUpdateDateFr() === null): ?>
                        <p>Article créé le <?= $postToRead[0]->postCreationDateFr() ?></p>
                    <?php else: ?>
                        <p>Article modifié le <?= $postToRead[0]->postUpdateDateFr() ?></p>
                    <?php endif ?>
                                                                
                        <p><?= $postToRead[0]->postContent()?></p>
                </div>
            </div>
        </div>
    </div>
</div>