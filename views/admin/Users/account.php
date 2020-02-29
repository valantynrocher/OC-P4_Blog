<?php $this->title = ""; ?>

<div class="container-fluid">
                        
                        <div class="content-header">
                            <div class="content-header__title">
                                <h1>Mon profil</h1>
                            </div>
                        </div>

						<div class="row">
                            <div class="card col container align-self-center">

                                <div class="card-header ">
                                    <h4 class="card-title">Modifier mes informations personnelles</h4>
								</div>

                                <?php if (isset($errorInfosMsg) && $errorInfosMsg !== null): ?>
                                    <div class="alert alert-danger">
                                        <?= $errorInfosMsg ?>
                                    </div>
                                <?php elseif(isset($successInfosMsg) && $successInfosMsg !== null): ?>
                                    <div class="alert alert-success">
                                        <?= $successInfosMsg ?>
                                    </div>
                                <?php endif ?>

                                <form action="admin.php?url=users&action=account&userId=<?=$_SESSION['user']['id']?>" method="POST">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Prénom</label>
                                            <input class="form-control" type="text" name="firstName" value="<?=$_SESSION['user']['firstName']?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Nom</label>
                                            <input class="form-control" type="text" name="lastName" value="<?=$_SESSION['user']['lastName']?>">
                                        </div>
                                    </div>  
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Identifiant</label>
                                            <input class="form-control" type="text" name="login" value="<?=$_SESSION['user']['login']?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">E-mail</label>
                                            <input class="form-control" type="text" name="email" value="<?=$_SESSION['user']['email']?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Rôle</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" <?php if ($_SESSION['user']['role'] === 'admin') echo 'selected'?>>Admin</option>
                                                <option value="reader" <?php if ($_SESSION['user']['role'] === 'reader') echo 'selected'?>>Lecteur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                                </form>

                            </div>
                        </div>

                        <div class="row">
                            <div class="card col container align-self-center">

                                <div class="card-header ">
                                    <h4 class="card-title">Modifier mon mot de passe</h4>
								</div>

                                <?php if (isset($errorPassMsg) && $errorPassMsg !== null): ?>
                                    <div class="alert alert-danger">
                                        <?= $errorPassMsg ?>
                                    </div>
                                <?php elseif(isset($successPassMsg) && $successPassMsg !== null): ?>
                                    <div class="alert alert-success">
                                        <?= $successPassMsg ?>
                                    </div>
                                <?php endif ?>

                                <form action="admin.php?url=users&action=updatePass&userId=<?=$_SESSION['user']['id']?>" method="POST" class="form-signin">
                                    <div class="form-group">
                                        <label for="userPassword" class="sr-only">Mot de passe</label>
                                        <input type="password" name="password" id="userPassword" class="form-control" placeholder="Votre nouveau mot de passe" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword" class="sr-only">Mot de passe</label>
                                        <input type="password" name="passwordConfirm" id="confirmPassword" class="form-control" placeholder="Confirmez votre saisie" required>
                                    </div>
                                    <button class="btn btn-warning" name="submit" type="submit">Enregistrer</button>
                                </form>

                            </div>
                        </div>
</div>