<?php
include(__DIR__.'/../template/views/header.phtml');

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include(__DIR__.'/../model/produit.model.php');

$data = $_POST;

if (count($data) > 0) {

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('Action non autorisée.');
    }
    
    $id = intval($data['id']);
    deleteProduct($id);

    header("Location: /index.php");
    exit;
}