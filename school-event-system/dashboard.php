<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Your dashboard content here
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['role'];
?>


<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
  }

$stmt = $pdo->query("SELECT * FROM events ORDER BY start_datetime ASC");
$events = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
  <header><h1>Admin Dashboard
    <?php if(!$events): ?>
      <p>No events yet.</p>
    <?php else: ?>
      <table>
        <thead><tr><th>Title</th><th>Start</th><th>End</th><th>Location</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach($events as $e): ?>
          <tr>
            <td><?=htmlspecialchars($e['title'])?></td>
            <td><?=htmlspecialchars($e['start_datetime'])?></td>
            <td><?=htmlspecialchars($e['end_datetime'])?></td>
            <td><?=htmlspecialchars($e['location'])?></td>
            <td>
              <a href="edit_event.php?id=<?=$e['id']?>">Edit</a> |
              <a href="delete_event.php?id=<?=$e['id']?>" onclick="return confirm('Delete this event?')">Delete</a>
            </td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
    <?php endif; ?>
  </main>
</body>
</html>

<?php
// dashboard.php - sample school management dashboard

// Start session and check login (simplified)
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Dummy data, normally loaded from DB
$user = $_SESSION['user'];
$totalStudents = 250;
$totalTeachers = 45;
$upcomingEvents = 3;
$activeClasses = 18;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>School Management System Dashboard</title>
<style>
  body {
    margin: 0;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f7fa;
  }

  .sidebar {
    width: 220px;
    position: fixed;
    height: 100%;
    background: #2c3e50;
    padding-top: 20px;
    color: white;
  }
  .sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 22px;
  }
  .sidebar ul {
    list-style: none;
    padding-left: 0;
  }
  .sidebar ul li {
    padding: 15px 25px;
    cursor: pointer;
  }
  .sidebar ul li:hover {
    background: #34495e;
  }
  .sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
  }

  .main-content {
    margin-left: 220px;
    padding: 30px;
  }
  .header {
    background: white;
    padding: 20px;
    box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
  }
  .header h1 {
    margin: 0;
    font-weight: 600;
    font-size: 26px;
  }
  .profile {
    font-weight: 500;
    font-size: 16px;
    color: #2c3e50;
  }

  .dashboard-widgets {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(250px,1fr));
    gap: 20px;
  }

  .widget {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 3px 8px rgb(0 0 0 / 0.06);
  }
  .widget h3 {
    margin-top: 0;
    font-weight: 600;
    color: #34495e;
  }
  .widget p {
    font-size: 28px;
    font-weight: 700;
    margin: 10px 0 0 0;
  }
</style>
</head>
<body>
  <div class="sidebar">
    <h2>School System</h2>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="students.php">Students</a></li>
      <li><a href="teachers.php">Teachers</a></li>
      <li><a href="classes.php">Classes</a></li>
      <li><a href="events.php">Events</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="settings.php">Settings</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="header">
      <h1>Dashboard</h1>
      <div class="profile"><?php echo htmlspecialchars($user); ?></div>
    </div>

    <div class="dashboard-widgets">
      <div class="widget">
        <h3>Total Students</h3>
        <p><?php echo $totalStudents; ?></p>
      </div>
      <div class="widget">
        <h3>Total Teachers</h3>
        <p><?php echo $totalTeachers; ?></p>
      </div>
      <div class="widget">
        <h3>Upcoming Events</h3>
        <p><?php echo $upcomingEvents; ?></p>
      </div>
      <div class="widget">
        <h3>Active Classes</h3>
        <p><?php echo $activeClasses; ?></p>
      </div>
    </div>
  </div>
</body>
</html>
