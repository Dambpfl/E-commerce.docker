<?php
session_start();

include('./template/header.phtml');
include('./model/user.model.php');

$erreur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $user = loginUser($login, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit;
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }
}

include('./template/partials/formUser.phtml');
include('./template/footer.phtml');