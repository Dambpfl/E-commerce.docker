<?php
if (empty($_SESSION['user'])) {
    header('Location: hote.php');
    exit;
}

include('./template/views/header.phtml');
include('./model/produit.model.php');

$data = $_POST;

if (count($data) > 0) {

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('Action non autorisée.');
    }

    $titre = htmlspecialchars(trim($_POST['titre']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
    $image = filter_var($_POST['image'], FILTER_VALIDATE_URL);
    addProduct($titre, $description, $prix, $image);

    header("Location: index.php");
    exit;
}

include('./template/forms/formProduit.phtml');
include('./template/views/footer.phtml');
