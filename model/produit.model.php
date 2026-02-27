<?php

include('./model/connexion.php');

function getAllProducts() {
    $conn = connexionBDD();
    $stmt = $conn->query("SELECT * FROM produits;");
    $products = $stmt->fetchAll();
    return $products;
}

function getProductById($id) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("SELECT * FROM produits WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id
    ]);
    $products = $stmt->fetchAll();
    return $products[0];
}

function addProduct($titre, $description, $prix, $image) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("INSERT INTO produits (titre, description, prix, image ) VALUES(:titre, :description, :prix, :image);");
    $stmt->execute([
        ':titre'=>$titre,
        ':description'=>$description,
        ':prix'=>$prix,
        ':image'=>$image
    ]);
}

function updateProduct($id, $titre, $description, $prix, $image) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("UPDATE produits SET titre=:titre, description=:description, prix=:prix, image=:image WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id,
        ':titre'=>$titre,
        ':description'=>$description,
        ':prix'=>$prix,
        ':image'=>$image
    ]);
}

function deleteProduct($id) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("DELETE FROM produits WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id
    ]);
}