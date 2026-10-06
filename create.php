<?php

require 'db.php';
require 'functions.php';

$errors = [];

$task = [
    'title'       => '',
    'description' => '',
    'category'    => '',
    'priority'    => 'Medium',
    'due_date'    => '',
    'completed'   => 0,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = get_task_input();
    $errors = validate_task($task, $categories, $priorities);

    if (count($errors) === 0) {
        $sql = 'INSERT INTO tasks (title, description, category, priority, due_date, completed)
                VALUES (?, ?, ?, ?, ?, ?)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $task['title'],
            $task['description'],
            $task['category'],
            $task['priority'],
            $task['due_date'],
            $task['completed'],
        ]);

        set_flash('success', 'Task added.');
        header('Location: index.php');
        exit;
    }
}

$page_title = 'Add Task';
$form_action = 'create.php';
$button_label = 'Add Task';
require 'header.php';
?>

<h2>Add Task</h2>
<?php require 'task_form.php'; ?>

<?php require 'footer.php'; ?>
