
<?php
include "../init.php";
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