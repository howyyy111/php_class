<?php

$db_host = '127.0.0.1';
$db_port = 3307;
$db_name = 'task_manager';
$db_user = 'root';
$db_pass = '';

$dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    die('Database connection failed: ' . $error->getMessage());
}
