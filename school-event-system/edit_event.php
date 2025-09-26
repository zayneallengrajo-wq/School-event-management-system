<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: dashboard.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();
if (!$event) { header('Location: dashboard.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $start = $_POST['start_datetime'] ?? null;
    $end = $_POST['end_datetime'] ?? null;

    if ($title === '') $errors[] = "Title required.";

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE events SET title=?, description=?, location=?, start_datetime=?, end_datetime=? WHERE id=?");
        $stmt->execute([$title, $description, $location, $start, $end, $id]);
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Event</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
  <main>
    <h1>Edit Event</h1>
    <?php foreach($errors as $err): ?><p class="error"><?=htmlspecialchars($err)?></p><?php endforeach; ?>
    <form method="post" action="">
      <label>Title: <input type="text" name="title" value="<?=htmlspecialchars($event['title'])?>" required></label><br>
      <label>Description: <textarea name="description"><?=htmlspecialchars($event['description'])?></textarea></label><br>
      <label>Location: <input type="text" name="location" value="<?=htmlspecialchars($event['location'])?>"></label><br>
      <label>Start: <input type="datetime-local" name="start_datetime" value="<?=date('Y-m-d\TH:i', strtotime($event['start_datetime']))?>" required></label><br>
      <label>End: <input type="datetime-local" name="end_datetime" value="<?=date('Y-m-d\TH:i', strtotime($event['end_datetime']))?>" required></label><br>
      <button type="submit">Save</button>
    </form>
    <p><a href="dashboard.php">Back</a></p>
  </main>
</body>
</html>
