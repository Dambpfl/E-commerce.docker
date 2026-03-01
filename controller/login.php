<?php
include(__DIR__.'/../template/views/header.phtml');
include(__DIR__.'/../model/user.model.php');

$erreur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('Action non autorisée.');
    }

    $login = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } else {
        $user = loginUser($login, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: /index.php");
            exit;
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }
}

include(__DIR__.'/../template/forms/formUser.phtml');
include(__DIR__.'/../template/views/footer.phtml');