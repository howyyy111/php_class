<?php

require 'db.php';
require 'functions.php';

$filter = $_GET['priority'] ?? '';

if (in_array($filter, $priorities)) {
    $sql = 'SELECT * FROM tasks WHERE priority = ? ORDER BY due_date ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$filter]);
} else {
    $filter = '';
    $sql = 'SELECT * FROM tasks ORDER BY due_date ASC';
    $stmt = $pdo->query($sql);
}

$tasks = $stmt->fetchAll();

$page_title = 'All Tasks';
require 'header.php';
?>

<div class="toolbar">
    <a class="button" href="create.php">+ Add Task</a>

    <form method="get" action="index.php">
        <label for="priority">Priority:</label>
        <select name="priority" id="priority">
            <option value="">All</option>
            <?php foreach ($priorities as $priority): ?>
                <?php if ($priority === $filter): ?>
                    <option value="<?= e($priority) ?>" selected><?= e($priority) ?></option>
                <?php else: ?>
                    <option value="<?= e($priority) ?>"><?= e($priority) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>
</div>

<?php if ($filter === ''): ?>
    <p>Showing <?= count($tasks) ?> task(s).</p>
<?php else: ?>
    <p>Showing <?= count($tasks) ?> task(s) with priority <?= e($filter) ?>.</p>
<?php endif; ?>

<?php if (count($tasks) === 0): ?>
    <p>No tasks found.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= e($task['title']) ?></td>
                <td><?= nl2br(e($task['description'])) ?></td>
                <td><?= e($task['category']) ?></td>
                <td><span class="badge <?= e(strtolower($task['priority'])) ?>"><?= e($task['priority']) ?></span></td>
                <td><?= e($task['due_date']) ?></td>
                <td>
                    <?php if ($task['completed']): ?>
                        <span class="badge done">Completed</span>
                    <?php else: ?>
                        <span class="badge pending">Pending</span>
                    <?php endif; ?>
                </td>
                <td class="actions">
                    <a href="edit.php?id=<?= (int) $task['id'] ?>">Edit</a>

                    <form method="post" action="delete.php" onsubmit="return confirm('Delete this task?');">
                        <input type="hidden" name="id" value="<?= (int) $task['id'] ?>">
                        <button type="submit" class="link-button">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require 'footer.php'; ?>
