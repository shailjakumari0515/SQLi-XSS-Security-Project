<?php
$name = $_GET['name'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure XSS Demo</title>
</head>
<body>

<h2>Secure Reflected XSS Demo</h2>

<form method="GET">
    <label>Enter your name:</label>
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>

<?php
if ($name !== '') {
    // Secure: Encode untrusted input before HTML output
    $safeName = htmlspecialchars(
        $name,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );

    echo "<h3>Hello, $safeName!</h3>";
}
?>

</body>
</html>