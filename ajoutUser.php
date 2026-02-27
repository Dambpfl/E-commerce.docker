<?php
include('./template/header.phtml');
include('./model/user.model.php');

$erreur = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $erreur = "Veuillez remplir tous les champs.";
    } elseif (userExists($email)) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        addUser($email, $password);
        $success = "Compte créé avec succès !";
    }
}

include('./template/partials/formUser.phtml');