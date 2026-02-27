<?php

function connexionBDD() {
    $dsn = "mysql:host=127.0.0.1;dbname=e-commerce;charset=UTF8";
    $pdo = new PDO($dsn,"damien", "root", []);
    return $pdo;
}