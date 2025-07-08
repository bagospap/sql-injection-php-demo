<?php
// Time-Based Blind SQL Injection Example (Vulnerable)
// Usage: time_based_injection.php?username=[payload]&password=[payload]&mutation=[mutation]
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

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$start = microtime(true);
$result = $conn->query($sql);
$end = microtime(true);
$duration = round($end - $start, 2);

echo "<b>Query:</b> <pre>" . htmlspecialchars($sql) . "</pre>";

if ($result && $result->num_rows > 0) {
    echo "User exists. Query took {$duration} seconds.";
} else {
    echo "User does not exist. Query took {$duration} seconds.";
}

// For demo only: do NOT use this code in production
?>
