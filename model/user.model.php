<?php

include(__DIR__ .'/connexion.php');

function getAllUsers() {
    $conn = connexionBDD();
    $stmt = $conn->query("SELECT * FROM user;");
    $users = $stmt->fetchAll();
    return $users;
}

function getUserById($id) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("SELECT * FROM user WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id
    ]);
    $users = $stmt->fetchAll();
    return $users[0];
}

function addUser($email, $password) {
    $conn = connexionBDD();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user (email,password) VALUES(:email, :password);");
    $stmt->execute([
        ':email'=>$email,
        ':password'=>$hashedPassword
    ]);
}

function updateUser($id, $email, $password) {
    $conn = connexionBDD();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE user SET email=:email, password=:password WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id,
        ':email'=>$email,
        ':password'=>$hashedPassword
    ]);
}

function deleteUser($id) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("DELETE FROM user WHERE id=:id;");
    $stmt->execute([
        ':id'=>$id
    ]);
}

function loginUser($email, $password) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("SELECT * FROM user WHERE email=:email");
    $stmt->execute([
        ':email' => $email
    ]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}

function userExists($email) {
    $conn = connexionBDD();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
    $stmt->execute([':email' => $email]);
    return $stmt->fetchColumn() > 0;
}