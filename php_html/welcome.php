<?php
include "nav_welcome.php";
include "form_connexion.php"; 
include "form_inscription.php"; 
?>
<div id="bids" class="container-fluid">
    <div class="row">
        <h2 class="mb text-center">Enchères en cours</h2>
        <?php
        $bids = dataSelectAll("*", "bids");
        foreach ($bids as $b) {
            $bid = dataSelect("*", "bids", "id", $b['id'], 0);
            $user = dataSelect("*", "users", "id", $bid['seller'], 0);
            $bidUser = dataSelect("*", "bid_user", "id_bid", $bid['id'], 1);
            $bidUser = array_reverse($bidUser);
            $delay = $bid['end_bid'] - time();
            if ($delay > 0) {
                $seconds = $delay % 60;
                $minutes = $delay / 60 % 60;
                $hours = $delay / 3600 % 24;
                echo '<div class="col-md-3">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading background-orange">';
                echo $bid['title'];
                echo '</div>';
                echo '<div class="panel-body">';
                echo '<div class="container-fluid">';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<p><img class="img-responsive" onload="count()" src="'. $bid['image'] .'" alt="'. $bid['title'] .'"></p>';
                echo '</div>';
                echo '<div class="col-md-6">';
                if (empty($bidUser)) echo '<p>0€</p>';
                else echo '<p>'. $bidUser[0]['bet_money'] .'€</p>';
                echo '<button type="button" class="btn btn-default">Miser</button>';
                echo '<p>'. html_entity_decode($bid['descriptive']) .'</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="panel-footer text-center background-orange">';
                echo '<p id="counter"><span class="glyphicon glyphicon-time"></span> '. ($hours < 10 ? '0'. $hours : $hours) .' : '. ($minutes < 10 ? '0'. $minutes : $minutes) .' : '. ($seconds < 10 ? '0'. $seconds : $seconds) .'</p>';
                echo '</div></div></div>';
            }
        }
        ?>
    </div>
</div>

<!-- Affichage annonce terminée -->

<div id="bids" class="container-fluid text-center">
    <div class="row">
        <h2 class="mb text-center">Enchères terminées</h2>
        <div class="col-md-2"></div>
        <?php
        $bids = dataSelectAll("*", "bids");
        foreach ($bids as $b) {
            $bid = dataSelect("*", "bids", "id", $b['id'], 0);
            $delay = $bid['end_bid'] - time();
            if ($delay < 0 && time() < $bid['end_bid'] + 10800) {
                $seconds = abs($delay % 60);
                $minutes = abs($delay / 60 % 60);
                $hours = abs($delay / 3600 % 24);
                echo '<div class="col-md-2">';
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading background-orange">';
                echo '<h2>'. $bid['title'] .'</h2>';
                echo '</div>';
                echo '<div class="panel-body">';
                echo '<p><img class="img-responsive" src="'. $bid['image'] .'" alt="'. $bid['title'] .'"></p>';
                echo '<p>'. html_entity_decode($bid['descriptive']) .'</p>';
                echo '</div><div class="panel-footer background-orange">';
                echo '<p>Terminée depuis : '. ($hours < 10 ? '0'. $hours : $hours) .' : '. ($minutes < 10 ? '0'. $minutes : $minutes) .' : '. ($seconds < 10 ? '0'. $seconds : $seconds) .'</p>';
                echo '</div></div></div>';
            }
        }
        ?>
        <div class="col-md-2"></div>
    </div>
</div>