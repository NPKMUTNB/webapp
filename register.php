<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response
header('Content-Type: application/json');

// Database configuration
$dbFile = __DIR__ . '/database/users.db';
$dbDir = __DIR__ . '/database';

// Create database directory if it doesn't exist
if (!file_exists($dbDir)) {
    mkdir($dbDir, 0755, true);
}

/**
 * Initialize SQLite database and create users table if not exists
 */
function initDatabase($dbFile) {
    try {
        $db = new PDO('sqlite:' . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create users table
        $createTableSQL = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                name TEXT NOT NULL,
                gender TEXT NOT NULL,
                password_hash TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";

        $db->exec($createTableSQL);

        // Create index on username for faster lookups
        $db->exec("CREATE INDEX IF NOT EXISTS idx_username ON users(username)");

        return $db;
    } catch (PDOException $e) {
        throw new Exception("Database initialization failed: " . $e->getMessage());
    }
}

/**
 * Validate input data
 */
function validateInput($data) {
    $errors = [];

    // Validate username
    if (empty($data['username'])) {
        $errors[] = "Username is required";
    } elseif (strlen($data['username']) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    } elseif (strlen($data['username']) > 50) {
        $errors[] = "Username must not exceed 50 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $data['username'])) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }

    // Validate full name
    if (empty($data['name'])) {
        $errors[] = "Full name is required";
    } elseif (strlen($data['name']) < 2) {
        $errors[] = "Full name must be at least 2 characters long";
    } elseif (strlen($data['name']) > 100) {
        $errors[] = "Full name must not exceed 100 characters";
    }

    // Validate gender
    if (empty($data['gender'])) {
        $errors[] = "Gender is required";
    } elseif (!in_array($data['gender'], ['male', 'female', 'other'])) {
        $errors[] = "Invalid gender value";
    }

    // Validate password
    if (empty($data['password'])) {
        $errors[] = "Password is required";
    } elseif (strlen($data['password']) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } elseif (strlen($data['password']) > 255) {
        $errors[] = "Password must not exceed 255 characters";
    }

    return $errors;
}

/**
 * Sanitize input data
 */
function sanitizeInput($data) {
    return [
        'username' => trim(strip_tags($data['username'])),
        'name' => trim(strip_tags($data['name'])),
        'gender' => trim($data['gender']),
        'password' => $data['password'] // Don't sanitize password, will be hashed
    ];
}

/**
 * Check if username already exists
 */
function usernameExists($db, $username) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

/**
 * Register new user
 */
function registerUser($db, $data) {
    try {
        // Hash password securely
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = $db->prepare("
            INSERT INTO users (username, name, gender, password_hash)
            VALUES (:username, :name, :gender, :password_hash)
        ");

        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $passwordHash, PDO::PARAM_STR);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Registration successful!',
            'user_id' => $db->lastInsertId()
        ];
    } catch (PDOException $e) {
        throw new Exception("Registration failed: " . $e->getMessage());
    }
}

// Main processing
try {
    // Only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method. Only POST is allowed.");
    }

    // Get POST data
    $rawData = [
        'username' => $_POST['username'] ?? '',
        'name' => $_POST['name'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    // Sanitize input
    $data = sanitizeInput($rawData);

    // Validate input
    $errors = validateInput($data);
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit;
    }

    // Initialize database
    $db = initDatabase($dbFile);

    // Check if username already exists
    if (usernameExists($db, $data['username'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Username already exists. Please choose a different username.'
        ]);
        exit;
    }

    // Register user
    $result = registerUser($db, $data);

    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}
