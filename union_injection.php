<?php
// UNION-Based SQL Injection Example (Vulnerable)
// Usage: union_injection.php?username=[payload]&password=[payload]&mutation=[mutation]
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

$sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

echo "<b>Query:</b> <pre>" . htmlspecialchars($sql) . "</pre>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . htmlspecialchars($row['id']) . " - Username: " . htmlspecialchars($row['username']) . "<br>";
    }
} else {
    echo "No user found.";
}

// For demo only: do NOT use this code in production
?>
