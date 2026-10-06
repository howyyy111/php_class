<?php

require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    $sql = 'DELETE FROM tasks WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        set_flash('success', 'Task deleted.');
    } else {
        set_flash('error', 'Task not found.');
    }
}

header('Location: index.php');
exit;
