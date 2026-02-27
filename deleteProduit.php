<?php
include('./model/produit.model.php');

$data = $_POST;

if (count($data) > 0) {
    $id = $data['id'];
    deleteProduct($id);

    header("Location: index.php");
    exit;
}