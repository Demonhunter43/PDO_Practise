<?php

$hostname = 'localhost';
$dbname = 'pdo';
$login = 'root';
$password = '';
$port = 3306;


try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname;port=$port;",$login,$password);
} catch (PDOException $exception){
    var_dump($exception->getMessage());
}

$sql = "SELECT * FROM users";

$stmt = $pdo->query($sql);
/*while ($user = $stmt->fetch(PDO::FETCH_ASSOC)){
    var_dump($user);
}*/
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($users);

// Show user by ID
$userID = 1;
$sql = "SELECT * FROM users WHERE `id` = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id' => $userID
]);
$user = $stmt->fetch();
//var_dump($user);
// Create new user;
/*$name = "Вася Пупкин";
$email = "vasya123@yandex.ru";
$password = "password";
$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
        'name'=>$name,
        'password'=>$password,
        'email'=>$email,
]);*/

// Update user
$userID = 2;
$newPassword = "StrongPassword";
$sql = "UPDATE users SET password = :password WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
        'password' => $newPassword,
        'id' => $userID
]);
?>