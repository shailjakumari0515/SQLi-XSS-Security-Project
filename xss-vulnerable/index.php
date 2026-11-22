<?php
$name = $_GET['name'] ?? '';
?>
`
<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable XSS Demo</title>
</head>
<body>

<h2>Vulnerable Reflected XSS Demo</h2>

<form method="GET">
    <label>Enter your name:</label>
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>

<?php
if ($name !== '') {
    // INTENTIONALLY VULNERABLE: unescaped user input
    echo "<h3>Hello, $name!</h3>";
}
?>

</body>
</html>