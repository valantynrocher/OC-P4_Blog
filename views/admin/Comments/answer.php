<div class="container-fluid">

    <div class="content-header">
        <div class="content-header__title">
            <h1>Mes commentaires</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin.php?url=comments&action=list">Commentaires</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Répondre</li>
                </ol>
            </nav>
        </div>
        <div class="content-header__button">
            <div class="card">
                <a href="admin.php?url=comments&action=list" data-toggle="tooltip" data-placement="left" title="Retour à la liste des commentaires"><span class="nc-icon nc-stre-left"></span></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title">Répondre à un commentaire</h4>
                </div>
                <div class="card-body">
                    <div class="comment-to-answer">
                        <p><?=$commentToAnswer[0]->commentCreationDateFr()?>, <?=$commentToAnswer[0]->commentAuthor()?> a commenté votre article "<?=$commentToAnswer[0]->postTitle()?>" :</p>
                        <p><?=$commentToAnswer[0]->commentContent()?></p>
                    </div>
                    <form action="admin.php?url=comments&action=insert&postId=<?=$commentToAnswer[0]->post_id()?>" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="commentId">Id</label>
                                <input class="form-control" name="commentStartId" type="text" value="<?=$commentToAnswer[0]->commentId()?>" id="commentId" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postTitle">Article</label>
                                <input class="form-control" name="postTitle" type="text" value="<?=$commentToAnswer[0]->postTitle()?>" id="postTitle" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="commentAuthor">Auteur</label>
                                <input type="text" class="form-control" name="author" id="commentAuthor" value="Jean Forteroche" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="answerContent">Votre réponse :</label>
                                <textarea class="form-control" name="content" id="answerContent" rows="10" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>