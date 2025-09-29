<?php
include 'db.php';
$sql = "INSERT INTO email (name, subject, email, message) VALUES ('Test Name', 'Test Subject', 'test@example.com', 'Test message')";
if ($conn->query($sql) === TRUE) {
    echo "Insert successful!";
} else {
    echo "Error: " . $conn->error;
}
?>