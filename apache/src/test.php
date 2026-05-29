<?php
echo "<pre>";
echo "=== Database Connection Test ===\n\n";

// Check if .env exists
$envFile = __DIR__ . '/.env';
echo "1. Checking .env file: " . ($envFile) . "\n";
echo "   Exists: " . (file_exists($envFile) ? 'YES' : 'NO') . "\n";

if (file_exists($envFile)) {
    echo "   Contents:\n";
    echo file_get_contents($envFile);
    echo "\n\n";
}

// Load config
echo "2. Loading config.php...\n";
require_once 'config.php';

echo "3. Database Constants:\n";
echo "   DB_HOST: " . DB_HOST . "\n";
echo "   DB_NAME: " . DB_NAME . "\n";
echo "   DB_USER: " . DB_USER . "\n";
echo "   DB_PASS: " . (DB_PASS ? '***' : 'EMPTY') . "\n";

echo "\n4. Attempting connection...\n";
try {
    $dsn = "mysql:host=" . DB_HOST . ";port=3306;dbname=" . DB_NAME;
    echo "   DSN: " . $dsn . "\n";
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "   ✅ Connection successful!\n";
    
    // Try a query
    echo "\n5. Testing query...\n";
    $result = $pdo->query("SELECT COUNT(*) as count FROM users");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo "   User count: " . $row['count'] . "\n";
    
} catch (Exception $e) {
    echo "   ❌ Connection failed!\n";
    echo "   Error Code: " . $e->getCode() . "\n";
    echo "   Error Message: " . $e->getMessage() . "\n";
    echo "   Error File: " . $e->getFile() . "\n";
    echo "   Error Line: " . $e->getLine() . "\n";
}

echo "\n</pre>";
?>
