<?php
// config.php
session_start();

$DB_HOST = '127.0.0.1';
$DB_NAME = 'school_events_db';
$DB_USER = 'root';
$DB_PASS = ''; // XAMPP default empty. Change if you have a password.

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    // For development show error. In production, log it and show friendly message.
    die("Database connection failed: " . $e->getMessage());
}
