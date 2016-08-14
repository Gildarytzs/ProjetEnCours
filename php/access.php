
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