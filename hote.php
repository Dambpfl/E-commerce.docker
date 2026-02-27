<?php
include('./template/header.phtml');
include('./model/user.model.php');

$data = $_POST;

if(count($data) > 0) {
    $login = $data['email'];
    $password = $data['password'];
    if(loginUser($login, $password)) {
        header("Location: index.php");
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
include('./template/partials/formUser.phtml');