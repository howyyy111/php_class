# Student Task Manager

Student Name: Htet Oo Wai Yan
Student ID: 202300137

A plain PHP + MySQL CRUD application for managing academic tasks.
No frameworks or external libraries are used.

Assigned challenge: **Filter tasks by priority** (dropdown on the task list page).

## Features

- Add, list, edit and delete tasks (full CRUD)
- Each task has a title, description, category, priority, due date and completed status
- Filter the task list by priority (Low / Medium / High)
- Tasks are listed by due date, earliest first
- Server-side validation with error messages, and the form keeps what was typed
- Success and error flash messages after each action
- Prepared statements for every query that uses user input (prevents SQL injection)
- All output is escaped with `htmlspecialchars` (prevents XSS)
- Delete uses a POST form with a confirmation prompt, not a link

## Requirements

- PHP 7 or newer with the `pdo_mysql` extension
- MySQL or MariaDB

## Setup

1. Get the code:
   ```
   git clone https://github.com/howyyy111/php_class.git
   cd php_class
   ```
2. Import the database:
   ```
   mysql -u root -h 127.0.0.1 -P 3307 < database.sql
   ```
   This creates the `task_manager` database, the `tasks` table and three sample tasks.
3. Open `db.php` and set the host, port, username and password to match your MySQL server
   (it is set up for `root` with no password on port 3307).
4. Start the PHP built-in server from the project folder:
   ```
   php -S localhost:8000
   ```
5. Open http://localhost:8000/index.php in a browser.

## Database

One table, `tasks`, in the `task_manager` database:

| Column | Type | Notes |
|---|---|---|
| `id` | INT | Primary key, auto increment |
| `title` | VARCHAR(150) | Required |
| `description` | TEXT | Optional |
| `category` | VARCHAR(50) | Assignment, Exam, Project, Reading or Other |
| `priority` | VARCHAR(20) | Low, Medium or High |
| `due_date` | DATE | Required |
| `completed` | TINYINT(1) | 0 = pending, 1 = completed |
| `created_at` | TIMESTAMP | Set automatically |

## Files

| File | Purpose |
|---|---|
| `index.php` | Lists tasks (READ) and filters by priority |
| `create.php` | Adds a task (CREATE) |
| `edit.php` | Edits a task (UPDATE) |
| `delete.php` | Deletes a task (DELETE) |
| `task_form.php` | The form shared by create and edit |
| `db.php` | PDO database connection |
| `functions.php` | Reusable functions: escaping, flash messages, validation |
| `header.php`, `footer.php` | Shared page layout |
| `style.css` | Styling |
| `database.sql` | Creates the database, the `tasks` table and the sample tasks |

## AI-Use Reflection

AI tool(s) used: Claude Code (Claude)

Three examples of how AI helped me:
1. It explained the code to me in plain language, which I kept as my own study notes. For
   example, it explained why `index.php` uses `prepare()` and `execute()` with a `?`
   placeholder for the priority filter, and how that stops SQL injection.
2. It helped me put the project on GitHub in small steps. Instead of one big commit, the
   files were committed one part at a time (database, helper functions, layout, then each
   CRUD page), so the history shows how the application is built.
3. It helped me write this README: the features list, the setup steps and the table that
   describes each column of the `tasks` table.

One AI-generated suggestion or piece of code that I changed or rejected:
What was it?
The AI suggested keeping `db.php` out of the repository. Its idea was to add a
`db.example.php` file with placeholder values and list `db.php` in `.gitignore`.

Why did I change/reject it?
I rejected it and pushed `db.php` as it is. The file only has local default settings
(`root` with an empty password on my own computer), so nothing secret is exposed, and the
application needs `db.php` to run when someone downloads the project. I understand the
suggestion would be the right choice if the file had a real password.

The part of this application I understand least:
Sessions and flash messages. I understand that `set_flash()` saves a message in `$_SESSION`
and `header.php` shows it once and removes it, but I am less sure how PHP knows which
visitor a session belongs to and why the message survives the redirect after
`header('Location: ...')`.
