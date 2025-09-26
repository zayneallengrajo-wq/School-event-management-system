<?php
require 'config.php';

$errors = [];
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = 'Please enter email and password.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            // no such email
            $errors[] = 'Invalid email or password.';
        } else {
            $dbPass = $user['password'];

            // If password was stored hashed (recommended)
            if (password_verify($password, $dbPass)) {
                // optionally rehash if algorithm changed or cost increased
                if (password_needs_rehash($dbPass, PASSWORD_DEFAULT)) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $update->execute([$newHash, $user['id']]);
                }

                // success: set session and redirect
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                header('Location: dashboard.php');
                exit;
            }

            // Backwards-compat: if the password in DB is plain text (legacy)
            // NOTE: This is only for migration. It checks direct equality (not secure).
            if ($password === $dbPass) {
                // rehash and store the secure hash immediately
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update->execute([$newHash, $user['id']]);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                header('Location: dashboard.php');
                exit;
            }

            // fallback: wrong password
            $errors[] = 'Invalid email or password.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="page-center">
  <main class="card">
    <h1>Login</h1>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $err) echo '<div>'.htmlspecialchars($err).'</div>'; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="login.php" autocomplete="off" class="form">
      <label>
        Email
        <input type="email" name="email" required value="<?= htmlspecialchars($email) ?>">
      </label>

      <label>
        Password
        <div class="pw-row">
          <input id="password" type="password" name="password" required>
          <button type="button" id="togglePassword" class="btn-small">Show</button>
        </div>
      </label>

      <div class="form-row">
        <button class="btn" type="submit">Log in</button>
        <a class="link" href="register.php">Create account</a>
      </div>
    </form>
  </main>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const pw = document.getElementById('password');
    if (pw.type === 'password') {
        pw.type = 'text';
        this.textContent = 'Hide';
    } else {
        pw.type = 'password';
        this.textContent = 'Show';
    }
});
</script>
</body>
</html>