<?php
include('./template/views/header.phtml');
include('./model/user.model.php');

$erreur = null;
$success = null;
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

include('./template/forms/formUser.phtml');
include('./template/views/footer.phtml');