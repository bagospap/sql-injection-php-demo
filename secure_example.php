<?php
// Secure Example: Preventing SQL Injection with Prepared Statements
// Usage: secure_example.php?username=[payload]&password=[payload]&mutation=[mutation]
// Requires payload_mutator.php in the same directory.

require_once 'payload_mutator.php';

$username = isset($_GET['username']) ? $_GET['username'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';
$mutation = isset($_GET['mutation']) ? $_GET['mutation'] : '';

if ($mutation) {
    $username = mutate_payload($username, $mutation);
    $password = mutate_payload($password, $mutation);
}

$conn = new mysqli("localhost", "user", "pass", "testdb");

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

echo "<b>Prepared statement used. Username and password are safely bound.</b><br>";
echo "<b>Username:</b> <pre>" . htmlspecialchars($username) . "</pre>";
echo "<b>Password:</b> <pre>" . htmlspecialchars($password) . "</pre>";

if ($result && $result->num_rows > 0) {
    echo "Logged in as " . htmlspecialchars($username);
} else {
    echo "Invalid login.";
}

// Always use prepared statements or ORM tools in production!
?>
