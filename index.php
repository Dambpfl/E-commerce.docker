<?php
    include('./model/produit.model.php');
    $produits = getAllProducts();

    
    include('./template/views/index.phtml');
?>