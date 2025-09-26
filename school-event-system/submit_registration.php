<?php
$servername = "localhost";
$username = "root";  // your DB username
$password = "";      // your DB password
$dbname = "school_event";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $year = $conn->real_escape_string($_POST['year']);
    $course = $conn->real_escape_string($_POST['course']);

    $sql = "INSERT INTO registrations (name, email, phone, year, course) 
            VALUES ('$name', '$email', '$phone', '$year', '$course')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. Thank you for signing up, " . htmlspecialchars($name) . "!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
