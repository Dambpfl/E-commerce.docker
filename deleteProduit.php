<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: hote.php');
    exit;
}

include('./model/produit.model.php');

$data = $_POST;

if (count($data) > 0) {
    $id = $data['id'];
    deleteProduct($id);

    header("Location: index.php");
    exit;
}