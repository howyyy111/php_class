<?php

require 'db.php';
require 'functions.php';

$id = (int) ($_GET['id'] ?? 0);

$sql = 'SELECT * FROM tasks WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$task = $stmt->fetch();

if ($task === false) {
    set_flash('error', 'Task not found.');
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = get_task_input();
    $errors = validate_task($task, $categories, $priorities);

    if (count($errors) === 0) {
        $sql = 'UPDATE tasks
                SET title = ?, description = ?, category = ?, priority = ?, due_date = ?, completed = ?
                WHERE id = ?';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $task['title'],
            $task['description'],
            $task['category'],
            $task['priority'],
            $task['due_date'],
            $task['completed'],
            $id,
        ]);

        set_flash('success', 'Task updated.');
        header('Location: index.php');
        exit;
    }
}

$page_title = 'Edit Task';
$form_action = 'edit.php?id=' . $id;
$button_label = 'Save Changes';
require 'header.php';
?>

<h2>Edit Task</h2>
<?php require 'task_form.php'; ?>

<?php require 'footer.php'; ?>
