<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>College Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #bbb;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        input[type=text], input[type=email], input[type=tel], select {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 15px;
        }
        input[type=submit] {
            width: 100%;
            background-color: #0073e6;
            color: white;
            font-size: 16px;
            padding: 12px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #005bb5;
        }
        .info {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="submit_registration.php" method="post">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required />

            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" required />

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Optional" />

            <label for="year">Year *</label>
            <select id="year" name="year" required>
                <option value="" disabled selected>Select your year</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <label for="course">Course *</label>
            <select id="course" name="course" required>
                <option value="" disabled selected>Select your course</option>
                <option value="information_technology">Information Technology</option>
                <option value="computer_science">Computer Science</option>
                <option value="business_administration">Business Administration</option>
                <option value="psychology">Psychology</option>
                <option value="engineering">Engineering</option>
                <option value="education">Education</option>
                <option value="office_administration">Office Administration</option>
                <option value="others">Others</option>
            </select>

            <div class="info">* Required fields</div>
            <input type="submit" value="Register Now" />
        </form>
    </div>
</body>
</html>
