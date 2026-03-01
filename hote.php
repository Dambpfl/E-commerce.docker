<?php
include('./template/views/header.phtml');
include('./model/user.model.php');

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
            header("Location: index.php");
            exit;
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }
}

include('./template/forms/formUser.phtml');
include('./template/views/footer.phtml');