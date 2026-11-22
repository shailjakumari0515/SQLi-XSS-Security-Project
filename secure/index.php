<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = null;
$result = null;
$dbError = false;

try {
    $conn = @new mysqli(
    "sqli-mysql",
    "appuser",
    "AppPass123",
    "sqli_demo"
);
    

    $conn->set_charset("utf8mb4");

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $stmt = $conn->prepare(
            "SELECT user_id, first_name, last_name
             FROM users WHERE user_id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
    }

} catch (mysqli_sql_exception $e) {

    error_log("Database error: " . $e->getMessage());
    $dbError = true;
}

function safeOutput($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure SQLi Demo</title>
</head>
<body>

<h2>Secure SQL Injection Demo</h2>

<form method="GET">
    <label>Enter User ID:</label>
    <input type="text" name="id" required>
    <button type="submit">Search</button>
</form>

<?php
if ($dbError) {
    echo "<p>Something went wrong. Please try again later.</p>";

} elseif ($result !== null) {

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<p>ID: " . safeOutput($row['user_id']) .
                 " | Name: " . safeOutput($row['first_name']) .
                 " | Surname: " . safeOutput($row['last_name']) .
                 "</p>";
        }

    } else {
        echo "<p>No record found.</p>";
    }
}

if ($conn !== null) {
    $conn->close();
}
?>

</body>
</html>