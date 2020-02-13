<div class="container-fluid">

    <div class="content-header">
        <div class="content-header__title">
            <h1>Gestion des commentaires</h1>
        </div>
    </div>
    
    <!-- table with report comments list -->
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
                                        <td><?= $reportComment->title() ?></td>
                                        <td><?= $reportComment->author() ?></td>
                                        <td><?= $reportComment->creationDateFr() ?></td>
                                        <td><?= $reportComment->comment() ?></td>

                                        <!--<td class="action-cell"><a class="action-link" href=""><i class="far fa-eye"></i></td>-->
                                        <td class="action-cell"><a class="action-link action-link--check" href="admin.php?url=comments&action=moderate&id=<?=$reportComment->id()?>"><i class="fas fa-check"></i></td>
                                        <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=comments&action=delete&id=<?=$reportComment->id()?>" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce commentaire ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
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

    <!-- table with all comments list -->
    <div class="row">
        <div class="col">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <h4 class="card-title">Mes commentaires</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
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
                                    <td><?= $moderateComment->title() ?></td>
                                    <td><?= $moderateComment->author() ?></td>
                                    <td><?= $moderateComment->creationDateFr() ?></td>
                                    <td><?= $moderateComment->comment() ?></td>

                                    <!--<td class="action-cell"><a class="action-link" href=""><i class="far fa-eye"></i></td>-->
                                    <td class="action-cell"><a class="action-link action-link--delete" href="admin.php?url=comments&action=delete&id=<?=$moderateComment->id()?>" onclick="return confirm('Êtes-vous certain de vouloir supprimer ce commentaire ? Cette action est définitive.')"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>