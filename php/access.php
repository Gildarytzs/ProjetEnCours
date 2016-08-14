
<?php
include "../init.php";
include "..fonctions.php";
function emailExist($email) {
    $resultat = dataSelect("id", "users", "email", $email, 0);
    if (empty($resultat)) return FALSE;
    else return TRUE;
}

function accessTokenExist($access_token) {
    $resultat = dataSelect("id", "users", "access_token", $access_token, 0);
    if (empty($resultat)) return FALSE;
    else return TRUE;
}

function generateAccessToken($email) {
    $access_token = md5(uniqid());
    $bdd = connectBdd();    
    $query = $bdd->prepare('UPDATE users SET access_token = :access_token WHERE email = :email');
    $query->execute(["access_token" => $access_token, "email" => $email]);
    return $access_token;
}

function isConnected() {
    if (!isset($_SESSION['access_token']) || empty($_SESSION['access_token'])) {
        return FALSE;
    }
    $bdd = connectBdd();
    $query = $bdd->prepare('SELECT id FROM users WHERE email = :email AND access_token = :access_token');
    $query->execute(["email" => $_SESSION['email'], "access_token" => $_SESSION['access_token']]);
    $resultat = $query->fetch();
    if (empty($resultat)) {
        return FALSE;
    } else {
        $_SESSION['access_token'] = generateAccessToken($_SESSION['email']);
        return TRUE;
    }
}

function login($email, $password) {
    $resultat = dataSelect("*", "users", "email", $email, 0);
    if ($resultat) {
        if (password_verify($password, $resultat['password'])) {
            $_SESSION['access_token'] = generateAccessToken($email);
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $resultat['id'];
            return FALSE;
        } else {
            $_SESSION['errors'][] = 8; 
            $log = fopen("log.txt", "a+");
            fputs($log, "Email : ". $email ." \ Mot de passe : ". $password ."\r\n");
            fclose($log);
            return TRUE;
        }
    }
}

function logout() {
    session_destroy();
    header('Location: index.php');
}

function validatorSurname($surname) {
    if (strlen($surname) < 3) {
        $_SESSION['errorSubscribe'][] = 1;
        return FALSE;
    }
    return TRUE;
}

function validatorName($name) {
    if (strlen($name) < 3) {
        $_SESSION['errorSubscribe'][] = 2;
        return FALSE;
    }
    return TRUE;
}

function validatorPseudo($pseudo) {
    if (strlen($pseudo) < 3) {
        $_SESSION['errorSubscribe'][] = 8;
        return FALSE;
    }
    return TRUE;
}

function validatorEmail($email) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorSubscribe'][] = 3;
        return FALSE;
    }
    if (emailExist($_POST['email'])) {
        $_SESSION['errorSubscribe'][] = 4;
        return FALSE;
    }
    return TRUE;
}

function validatorPassword($pwd1, $pwd2) {
    if (strlen($pwd1) < 8 || strlen($pwd1) > 12) {
        $_SESSION['errorSubscribe'][] = 5;
        return FALSE;
    }
    if ($pwd1 != $pwd2) {
        $_SESSION['errorSubscribe'][] = 6;
        return FALSE;
    }
    return TRUE;
}

function validatorTitle($title) {
    if (strlen($title) < 3) {
        $_SESSION['errorBid'][] = 1;
        return FALSE;
    }
    return TRUE;
}

function validatorDescriptive($descriptive) {
    if (strlen($descriptive) < 3) {
        $_SESSION['errorBid'][] = 2;
        return FALSE;
    }
    return TRUE;
}

function validatorCategory($category) {
    if ($_POST['category'] == "...") {
        $_SESSION['errorBid'][] = 6;
        return FALSE;
    }
    return TRUE;
}

function validatorEstimatedPrice($estimatedPrice) {
    if (intval($estimatedPrice) < 1) {
        $_SESSION['errorBid'][] = 3;
        return FALSE;
    }
    return TRUE;
}

function validatorMiniPrice($miniPrice) {
    if (intval($miniPrice) < 1) {
        $_SESSION['errorBid'][] = 4;
        return FALSE;
    }
    return TRUE;
}

function validatorDate($dateD, $dateM, $dateH) {
    if ((intval($dateD) + intval($dateH) + intval($dateM)) < 1 || intval($dateD) > 61 || intval($dateH) > 25 || intval($dateM) > 61) {
        $_SESSION['errorBid'][] = 5;
        return FALSE;
    }
    return TRUE;
}