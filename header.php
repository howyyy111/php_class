<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page_title) ?> - Student Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Student Task Manager</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <p class="flash <?= e($_SESSION['flash_type']) ?>"><?= e($_SESSION['flash_message']) ?></p>
        <?php unset($_SESSION['flash_type'], $_SESSION['flash_message']); ?>
    <?php endif; ?>
