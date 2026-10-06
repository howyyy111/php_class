CREATE DATABASE IF NOT EXISTS task_manager CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

USE task_manager;

CREATE TABLE
    IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        description TEXT,
        category VARCHAR(50) NOT NULL,
        priority VARCHAR(20) NOT NULL,
        due_date DATE NOT NULL,
        completed TINYINT (1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

INSERT INTO
    tasks (
        title,
        description,
        category,
        priority,
        due_date,
        completed
    )
VALUES
    (
        'Web Programming report',
        'Write up the CRUD project.',
        'Assignment',
        'High',
        '2026-10-12',
        0
    ),
    (
        'Read chapter 5',
        'Database normalisation.',
        'Reading',
        'Low',
        '2026-10-09',
        1
    ),
    (
        'Group project slides',
        'Prepare the presentation.',
        'Project',
        'Medium',
        '2026-10-20',
        0
    );