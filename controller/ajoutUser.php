<?php
include(__DIR__.'/../template/views/header.phtml');
include(__DIR__.'/../model/user.model.php');

$erreur = null;
$success = null;
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('Action non autorisée.');
    }

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";

    } elseif (userExists($email)) {
        $erreur = "Cet email est déjà utilisé.";

    } else {
        addUser($email, $password);
        $success = "Compte créé avec succès !";
        $email = '';
    }
}

include(__DIR__.'/../template/forms/formUser.phtml');
include(__DIR__.'/../template/views/footer.phtml');