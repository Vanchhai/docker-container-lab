<?php
/**
 * Configuration file - loads environment variables from .env
 */

// Function to load .env file
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception(".env file not found at: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // Remove any BOM or special characters
        $line = trim($line);
        
        // Skip empty lines and comments
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        // Parse key=value
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if ((strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) ||
                (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1)) {
                $value = substr($value, 1, -1);
            }
            
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

// Load .env file
$envPath = __DIR__ . '/.env';
try {
    loadEnv($envPath);
} catch (Exception $e) {
    die("Config Error: " . $e->getMessage());
}

// Get configuration
if (!function_exists('getEnv')) {
    function getEnv($key, $default = null) {
        return $_ENV[$key] ?? getenv($key) ?? $default;
    }
}

// Database configuration
define('DB_HOST', getEnv('DB_HOST', 'mysql'));
define('DB_NAME', getEnv('DB_NAME', 'labdb'));
define('DB_USER', getEnv('DB_USER', 'labuser'));
define('DB_PASS', getEnv('DB_PASS', 'labpass'));

// Function to get PDO connection
function getPDOConnection() {
    $dsn = "mysql:host=" . DB_HOST . ";port=3306;dbname=" . DB_NAME;
    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}
?>
