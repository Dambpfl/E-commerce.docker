<?php
include(__DIR__.'/../template/views/header.phtml');

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include(__DIR__.'/../model/produit.model.php');

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $produit = getProductById($id);
}

$data = $_POST;

if (count($data) > 0) {

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        die('Action non autorisée.');
    }

    $id = intval($_POST['id'] ?? 0);
    $titre = htmlspecialchars(trim($_POST['titre']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
    $image = filter_var($_POST['image'], FILTER_VALIDATE_URL);
    updateProduct($id, $titre, $description, $prix, $image);

    header("Location: /index.php");
    exit;
}

include(__DIR__.'/../template/forms/formEditProduit.phtml');
include(__DIR__.'/../template/views/footer.phtml');
