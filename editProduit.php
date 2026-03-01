<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: hote.php');
    exit;
}

include('./template/views/header.phtml');
include('./model/produit.model.php');

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $produit = getProductById($id);
}

$data = $_POST;

if (count($data) > 0) {
    $titre = htmlspecialchars(trim($_POST['titre']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
    $image = filter_var($_POST['image'], FILTER_VALIDATE_URL);
    updateProduct($id, $titre, $description, $prix, $image);

    header("Location: index.php");
    exit;
}

include('./template/forms/formEditProduit.phtml');
include('./template/views/footer.phtml');
