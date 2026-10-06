<?php

session_start();

$categories = ['Assignment', 'Exam', 'Project', 'Reading', 'Other'];
$priorities = ['Low', 'Medium', 'High'];

function e($text)
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

function set_flash($type, $message)
{
    $_SESSION['flash_type'] = $type;
    $_SESSION['flash_message'] = $message;
}

function get_task_input()
{
    $completed = 0;
    if (isset($_POST['completed'])) {
        $completed = 1;
    }

    return [
        'title'       => trim($_POST['title'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'category'    => $_POST['category'] ?? '',
        'priority'    => $_POST['priority'] ?? '',
        'due_date'    => $_POST['due_date'] ?? '',
        'completed'   => $completed,
    ];
}

function is_valid_date($text)
{
    $date = DateTime::createFromFormat('Y-m-d', $text);

    if ($date === false) {
        return false;
    }

    return $date->format('Y-m-d') === $text;
}

function validate_task($task, $categories, $priorities)
{
    $errors = [];

    if ($task['title'] === '') {
        $errors[] = 'Title is required.';
    } elseif (strlen($task['title']) > 150) {
        $errors[] = 'Title must be 150 characters or fewer.';
    }

    if (!in_array($task['category'], $categories)) {
        $errors[] = 'Please choose a valid category.';
    }

    if (!in_array($task['priority'], $priorities)) {
        $errors[] = 'Please choose a valid priority.';
    }

    if (!is_valid_date($task['due_date'])) {
        $errors[] = 'Please enter a valid due date.';
    }

    return $errors;
}
