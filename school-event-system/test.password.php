<?php
$plain = "12345";
$hash  = '$2y$10$9Khl8Y3xA0fknEdK83Sg0ucMShN/v8l1vUjUclpOnJMeV0HcHVbua';

if (password_verify($plain, $hash)) {
    echo "✅ Password matches!";
} else {
    echo "❌ Password does not match!";
}