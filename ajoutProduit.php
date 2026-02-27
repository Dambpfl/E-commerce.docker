<?php
include('./template/header.phtml');
include('./model/produit.model.php');

$data = $_POST;

if (count($data) > 0) {
    $titre = $data['titre'];
    $description = $data['description'];
    $prix = $data['prix'];
    $image = $data['image'];
    addProduct($titre, $description, $prix, $image);

    header("Location: index.php");
    exit;
}

include('./template/partials/formProduit.phtml');
