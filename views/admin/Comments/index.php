<div class="container-fluid">

    <div class="content-header">
        <div class="content-header__title">
            <h1>Mes commentaires</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Commentaires</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liste</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <h4 class="card-title">Commentaires signalés</h4>
                    <p class="card-category">Ces commentaires ont été signalés par vos visiteurs. Vous devez les modérer afin de les conserver
                    ou des les supprimer.</p>
                </div>
                <?php if (!empty($reportComments)): ?>
                    <div class="card-body table-full-width table-responsive">
                        <table class="report-comments table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">État</th>
                                <th scope="col">Article</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Date</th>
                                <th scope="col">Commentaire</th>
                                </tr>
                            </thead>
                            <pre>
                            </pre>
                            <tbody>
                                <?php foreach ($reportComments as $reportComment): ?>
                                    <tr>
                                        <td><span class="badge badge-danger">Signalé !</span></td>
                                        <td><?= $reportComment->postTitle() ?></td>
                                        <td><?= $reportComment->commentAuthor() ?></td>
                                        <td><?= $reportComment->commentCreationDateFr() ?></td>
                                        <td><?= $reportComment->commentContent() ?></td>

                                        <td class="action-cell"><a class="action-link action-link--check" href="admin.php?url=comments&action=moderate&commentId=<?=$reportComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Modérer le commentaire"><i class="fas fa-check"></i></td>
                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=comments&action=delete&commentId=<?=$reportComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer le commentaire" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce commentaire ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        Il n'y a aucun commentaire signalé.
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <h4 class="card-title">Commentaires non lus</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">État</th>
                                <th scope="col">Article</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Date</th>
                                <th scope="col">Commentaire</th>
                            </tr>
                        </thead>
                        <pre>
                        </pre>
                        <tbody>
                            <?php foreach ($waitingComments as $waitingComment): ?>
                                <tr>
                                    <td><span class="badge badge-warning">Non lu</span></td>
                                    <td><?= $waitingComment->postTitle() ?></td>
                                    <td><?= $waitingComment->commentAuthor() ?></td>
                                    <td><?= $waitingComment->commentCreationDateFr() ?></td>
                                    <td><?= $waitingComment->commentContent() ?></td>

                                    <td class="action-cell"><a class="action-link action-link--check" href="admin.php?url=comments&action=moderate&commentId=<?=$waitingComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Modérer le commentaire"><i class="fas fa-check"></i></td>
                                    <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=comments&action=delete&commentId=<?=$waitingComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer le commentaire" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce commentaire ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <h4 class="card-title">Commentaires modérés</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">État</th>
                                <th scope="col">Article</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Date</th>
                                <th scope="col">Commentaire</th>
                            </tr>
                        </thead>
                        <pre>
                        </pre>
                        <tbody>
                            <?php foreach ($moderateComments as $moderateComment): ?>
                                <tr>
                                    <td><span class="badge badge-success">Modéré</span></td>
                                    <td><?= $moderateComment->postTitle() ?></td>
                                    <td><?= $moderateComment->commentAuthor() ?></td>
                                    <td><?= $moderateComment->commentCreationDateFr() ?></td>
                                    <td><?= $moderateComment->commentContent() ?></td>

                                    <td class="action-cell"><a class="action-link" href="admin.php?url=comments&action=answer&commentId=<?=$moderateComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Répondre au commentaire"><i class="fas fa-reply"></i></td>
                                    <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=comments&action=delete&commentId=<?=$moderateComment->commentId()?>" data-toggle="tooltip" data-placement="top" title="Supprimer le commentaire" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce commentaire ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>