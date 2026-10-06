<?php if (count($errors) > 0): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?= e($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="<?= e($form_action) ?>" class="task-form">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" maxlength="150" value="<?= e($task['title']) ?>">

    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4"><?= e($task['description']) ?></textarea>

    <label for="category">Category</label>
    <select name="category" id="category">
        <option value="">-- Choose --</option>
        <?php foreach ($categories as $category): ?>
            <?php if ($category === $task['category']): ?>
                <option value="<?= e($category) ?>" selected><?= e($category) ?></option>
            <?php else: ?>
                <option value="<?= e($category) ?>"><?= e($category) ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <label for="priority">Priority</label>
    <select name="priority" id="priority">
        <?php foreach ($priorities as $priority): ?>
            <?php if ($priority === $task['priority']): ?>
                <option value="<?= e($priority) ?>" selected><?= e($priority) ?></option>
            <?php else: ?>
                <option value="<?= e($priority) ?>"><?= e($priority) ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <label for="due_date">Due Date</label>
    <input type="date" name="due_date" id="due_date" value="<?= e($task['due_date']) ?>">

    <label class="checkbox">
        <?php if ($task['completed']): ?>
            <input type="checkbox" name="completed" value="1" checked>
        <?php else: ?>
            <input type="checkbox" name="completed" value="1">
        <?php endif; ?>
        Completed
    </label>

    <button type="submit"><?= e($button_label) ?></button>
    <a href="index.php">Cancel</a>
</form>
