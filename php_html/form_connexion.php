<?php include "welcome.php" ; ?>
<!-- Connexion -->

<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center background-purple white-color">
                <h4 class="modal-title white-color"><span class="glyphicon glyphicon-off orange-color"></span> Connexion</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" class="form-horizontal" method="post" action="login.php">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:"") ?>" placeholder="Email :">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Mot de passe :">
                                    </div>
                                    <div class="text-center padding">
                                        <p>Pas encore inscrit ? <a class="page-scroll" href="#inscription" data-dismiss="modal">Cliquez ici</a></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="form-group">
                                            <button id="button" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-off orange-color"></span> Connexion</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-default"><span class="glyphicon glyphicon-remove orange-color"></span> Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
