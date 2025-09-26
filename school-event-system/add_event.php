<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $start = $_POST['start_datetime'] ?? null;
    $end = $_POST['end_datetime'] ?? null;

    if ($title === '') $errors[] = "Title required.";
    if ($start === '' || $end === '') $errors[] = "Start and end date/time required.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO events (title, description, location, start_datetime, end_datetime, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $location, $start, $end, $_SESSION['user_id']]);
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Event</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
  <main>
    <h1>Add Event</h1>
    <?php foreach($errors as $err): ?><p class="error"><?=htmlspecialchars($err)?></p><?php endforeach; ?>
    <form method="post" action="">
      <label>Title: <input type="text" name="title" required></label><br>
      <label>Description: <textarea name="description"></textarea></label><br>
      <label>Location: <input type="text" name="location"></label><br>
      <label>Start: <input type="datetime-local" name="start_datetime" required></label><br>
      <label>End: <input type="datetime-local" name="end_datetime" required></label><br>
      <button type="submit">Create</button>
    </form>
    <p><a href="dashboard.php">Back</a></p>
  </main>
</body>
</html>
