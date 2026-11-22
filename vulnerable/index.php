<?php
$conn = new mysqli("sqli-mysql", "appuser", "AppPass123", "sqli_demo");

if ($conn->connect_error) {
    die("Database connection failed.");
}

$result = null;
$error = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // INTENTIONALLY VULNERABLE: SQL Injection demonstration
    $query = "SELECT user_id, first_name, last_name FROM users WHERE user_id = '$id'";

    $result = $conn->query($query);

    if (!$result) {
        $error = "Query failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable SQLi Demo</title>
</head>
<body>
    <h2>Vulnerable SQL Injection Demo</h2>

    <form method="GET">
        <label>Enter User ID:</label>
        <input type="text" name="id" required>
        <button type="submit">Search</button>
    </form>

    <?php
    if ($error !== "") {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>ID: " . htmlspecialchars($row['user_id']) .
                 " | Name: " . htmlspecialchars($row['first_name']) .
                 " | Surname: " . htmlspecialchars($row['last_name']) . "</p>";
        }
    }
    ?>
</body>
</html>
