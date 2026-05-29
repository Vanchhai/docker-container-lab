<?php
require_once 'config.php';

try {
    $pdo = getPDOConnection();
    $rows = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("DB error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head><title>Docker Lab Demo</title>
<style>
  body { font-family: sans-serif; max-width: 600px; margin: 40px auto; }
  .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
  .btn-add { background: #1D9E75; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block; cursor: pointer; }
  .btn-add:hover { background: #159060; }
  table { width: 100%; border-collapse: collapse; }
  th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
  th { background: #f4f4f4; }
  .badge { background: #1D9E75; color: #fff; padding: 4px 10px; border-radius: 20px; font-size: 13px; }
</style>
</head>
<body>
  <div class="header">
    <div>
      <h2>🐳 Docker Lab — User List Vanchhai</h2>
      <p><span class="badge">Nginx → Apache → MySQL</span></p>
    </div>
    <a href="create_user.php" class="btn-add">➕ Add User</a>
  </div>
  <table>
    <tr><th>ID</th><th>Name</th><th>Email</th></tr>
    <?php foreach ($rows as $r): ?>
    <tr><td><?= $r['id'] ?></td><td><?= $r['name'] ?></td><td><?= $r['email'] ?></td></tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
