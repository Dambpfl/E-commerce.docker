<?php
include('./template/header.phtml');
include('./model/produit.model.php');

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $produit = getProductById($id);
}

$data = $_POST;

if (count($data) > 0) {
    $titre = $data['titre'];
    $description = $data['description'];
    $prix = $data['prix'];
    $image = $data['image'];
    updateProduct($id, $titre, $description, $prix, $image);

    header("Location: index.php");
    exit;
}

include('./template/partials/formEditProduit.phtml');
