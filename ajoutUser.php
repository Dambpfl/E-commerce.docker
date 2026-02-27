<?php
include('./template/header.phtml');
include('./model/user.model.php');

$data = $_POST;

if (count($data) > 0) {
    $email = $data['email'];
    $password = $data['password'];
    addUser($email, $password);
}

include('./template/partials/formUser.phtml');