<?php
    include('./model/produit.model.php');
    $produits = getAllProducts();

    
    include('./template/index.phtml');
?>
