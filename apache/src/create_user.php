<?php
require_once 'config.php';

try {
    $pdo = getPDOConnection();
} catch (Exception $e) {
    die("DB error: " . $e->getMessage());
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($name) && !empty($email)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->execute(['name' => $name, 'email' => $email]);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Please fill in all fields!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 40px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 20px; background: #1D9E75; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #159060; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .back-link { margin-top: 15px; }
        .back-link a { color: #1D9E75; text-decoration: none; }
    </style>
</head>
<body>
    <h2>➕ Add New User</h2>

    <?php if ($message): ?>
        <div class="message error"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <button type="submit">Create User</button>
    </form>

    <div class="back-link">
        <a href="index.php">← Back to User List</a>
    </div>
</body>
</html>
