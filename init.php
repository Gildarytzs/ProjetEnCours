<?php 
session_start();
require "php/conf.inc.php";
require "functions.php";
include "php/access.php";


function connectBdd() {
    try {
        $bdd = new PDO('mysql:dbname='.NAMEBDD.';host='.HOSTBDD, USERBDD, MDPBDD);
    } catch(Exception $e) {
        die('Erreur'. $e->getMessage());
    }
    return $bdd;
}