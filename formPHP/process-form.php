<?php

$name = $_POST["name"];
$message = $_POST["message"];
$priority = filter_input(INPUT_POST, "priority", FILTER_VALIDATE_INT);
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if (!terms) {
    die("Terms must be accepted");
}

$host = "localhost:3306";
$dbname = "mantaras_message";
$username = "mantaras_brat";
$password = "**hashed**";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("connection error: " .mysqli_connect_error());
}

$sql = "INSERT INTO message (name, body, priority, type)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssii",
                        $name, 
                        $message,
                        $priority,
                        $type);

mysqli_stmt_execute($stmt);

echo "Record saved.";