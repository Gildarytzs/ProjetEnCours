<div id="inscription" class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php
            if (isset($_POST['type']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerif'])) {
                $_POST['surname'] = ucfirst(strtolower(trim($_POST['surname'])));
                $_POST['name'] = ucfirst(strtolower(trim($_POST['name'])));
                $_POST['pseudo'] = ucfirst(strtolower(trim($_POST['pseudo'])));
                $_POST['email'] = strtolower(trim($_POST['email']));

                validatorSurname($_POST['surname']);
                validatorName($_POST['name']);
                validatorEmail($_POST['email']);
                validatorPseudo($_POST['pseudo']);
                validatorPassword($_POST['password'], $_POST['passwordVerif']);
                if (!isset($_POST['cgu'])) $_SESSION['errors'][] = 7;

                if (isset($_SESSION['errors'])) {
                    foreach($_SESSION['errors'] as $error) {
                        echo '<p><span class="glyphicon glyphicon-exclamation-sign"></span> ';
                        echo $listOfErrorsSubscribe[$error] .'</p>';
                    }
                    unset($_SESSION['errors']);
                    echo '<script>alert("Votre inscription a rencontré des problèmes. Veuillez re-cliquer sur Inscription pour voir les problèmes et les corriger.")</script>';
                } else {
                    $bdd = connectBdd();
                    $access_token = md5(uniqid());
                    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = $bdd->prepare('INSERT INTO users (type, surname, name, pseudo, email, tel, password, access_token) VALUES (:type, :surname, :name, :pseudo, :email, :tel, :password, :access_token)');
                    $query->execute(["type" => $_POST['type'],
                                     "surname" => $_POST['surname'], 
                                     "name" => $_POST['name'],
                                     "pseudo" => $_POST['pseudo'], 
                                     "email" => $_POST['email'],
                                     "tel" => $_POST['tel'],
                                     "password" => $pwd, 
                                     "access_token" => $access_token]);
                    echo '<script>alert("Votre inscription a bien été pris en compte. Vous pouvez maintenant vous connecter.")</script>';
                }
            }
            ?>
            <h2 class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Inscription</h2>
            <div class="progress wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                <div id="progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                </div>
            </div>
            <form role="form" class="form-horizontal" method="post">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="alert0" data-toggle="tooltip" data-placement="bottom" title="Veuillez choisir une civilité">
                                <select class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s" onblur="validateInput('type', 0)" id="type" name="type" value="<?php echo(isset($_POST['type'])?$_POST['type']:"") ?>">
                                    <option selected="selected">...</option>
                                    <option>Mr.</option>
                                    <option>Mme.</option>
                                    <option>Mlle.</option>
                                </select>
                            </div>
                            <div class="form-group" id="alert1" data-toggle="tooltip" data-placement="bottom" title="Le prénom doit faire au moins 2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s" onblur="validateInput('surname', 1)" id="surname" name="surname" value="<?php echo (isset($_POST['surname'])?$_POST['surname']:"") ?>" placeholder="Prénom :">
                            </div>
                            <div class="form-group" id="alert2" data-toggle="tooltip" data-placement="bottom" title="Le nom doit faire au moins 2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" onblur="validateInput('name', 2)" id="name" name="name" value="<?php echo (isset($_POST['name'])?$_POST['name']:"") ?>" placeholder="Nom :">
                            </div>
                            <div class="form-group" id="alert8" data-toggle="tooltip" data-placement="bottom" title="Le pseudo doit faire au moins 2 caractères.">
                                <input type="text" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.2s" onblur="validateInput('pseudo', 8)" id="pseudo" name="pseudo" value="<?php echo (isset($_POST['pseudo'])?$_POST['pseudo']:"") ?>" placeholder="Pseudo :">
                            </div>
                            <div class="form-group" id="alert3" data-toggle="tooltip" data-placement="bottom" title="L'email doit être valide.">
                                <input type="email" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.4s" onblur="validateInput('email', 3)" id="email" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:"") ?>" placeholder="Email :">
                            </div>
                            <div class="form-group" id="alert4" data-toggle="tooltip" data-placement="bottom" title="Le téléphone doit être valide.">
                                <input type="tel" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.6s" onblur="validateInput('tel', 4)" id="tel" name="tel" value="<?php echo (isset($_POST['tel'])?$_POST['tel']:"") ?>" placeholder="Téléphone :">
                            </div>
                            <div class="form-group" id="alert5" data-toggle="tooltip" data-placement="bottom" title="Le mot de passe doit contenir entre 8 et 12 caractères.">
                                <input type="password" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.8s" onblur="validateInput('password', 5)" id="password" name="password" placeholder="Mot de passe :">
                            </div>
                            <div class="form-group" id="alert6" data-toggle="tooltip" data-placement="bottom" title="La vérification doit correspondre au mot de passe.">
                                <input type="password" class="form-control wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s" onblur="validateInput('passwordVerif', 6)" id="passwordVerif" name="passwordVerif" placeholder="Vérification :">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <div class="checkbox wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.2s">
                                <input type="checkbox" name="cgu" onclick="validateInput('cgu', 7)" id="cgu"> Validation des <a href="">CGU</a><br><br>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.4s">
                                <p>Renseigner tous les champs pour pouvoir cliquer sur ce bouton.</p>
                                <button id="buttonFinal" type="submit" class="btn btn-default" disabled><span class="glyphicon glyphicon-open orange-color"></span> Inscription</button>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
