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
                <a href="admin.php?url=posts&action=list" data-toggle="tooltip" data-placement="left" title="Retour à la liste des articles"><span class="nc-icon nc-stre-left"></span></a>
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
                        <p><span class="badge badge-warning">Brouillon</span></p>
                    <?php elseif($postToRead[0]->postStatus() === 'public'): ?>
                        <p><span class="badge badge-success">Publié</span></p>
                    <?php elseif($postToRead[0]->postStatus() === 'trash'):?>
                        <p><span class="badge badge-danger">Corbeille</span></p>
                    <?php endif ?>
                        <?php if($postToRead[0]->postUpdateDateFr() === null): ?>
                        <i>Article créé le <?= $postToRead[0]->postCreationDateFr() ?></i>
                    <?php else: ?>
                        <i>Article modifié le <?= $postToRead[0]->postUpdateDateFr() ?></i>
                    <?php endif ?>
                                                                
                        <p><?= $postToRead[0]->postContent()?></p>
                </div>
            </div>
        </div>
    </div>
</div>