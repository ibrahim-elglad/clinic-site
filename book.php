<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$name     = trim($_POST['name'] ?? '');
$age      = (int)($_POST['age'] ?? 0);
$phone    = trim($_POST['phone'] ?? '');
$datetime = $_POST['datetime'] ?? '';
$gender   = $_POST['gender'] ?? '';

if (empty($name) || $age <= 0 || empty($phone) || empty($datetime) || empty($gender)) {
    die("<h3 style='color:red;text-align:center;margin-top:100px;'>جميع الحقول مطلوبة!</h3>");
}

$stmt = $conn->prepare("INSERT INTO appointments (name, age, phone, datetime, gender) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisss", $name, $age, $phone, $datetime, $gender);

if ($stmt->execute()) {
    echo '<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <title>Appointment Done</title>
        <style>
            body{background:#e0f7fa;font-family:Tahoma;text-align:center;padding:100px;}
            .box{background:white;padding:50px;border-radius:20px;display:inline-block;box-shadow:0 15px 35px rgba(0,0,0,0.15);max-width:600px;}
            h1{color:#00a8a8;font-size:40px;margin:0;}
            .btn{background:#00a8a8;color:white;padding:15px 40px;border-radius:12px;text-decoration:none;margin:15px;font-size:18px;display:inline-block;}
            .btn:hover{background:#007c7c;}
        </style>
    </head>
    <body>
        <div class="box">
            <h1>appointment sucsessfly</h1>
            <p style="font-size:22px;margin:20px 0;">thank you<strong>' . htmlspecialchars($name) . '</strong></p>
            <p style="font-size:20px;">datetime: <strong>' . date('d-m-Y h:i A', strtotime($datetime)) . '</strong></p>
            <hr style="margin:30px 0;">
            </clinic/a href="index.html" class="btn">back the main</a>
            <a href="/clinic/view_appointments.php" class="btn">Show All Date</a>
        </div>
    </body>
    </html>';
} else {
    echo "<h3 style='color:red;text-align:center;margin-top:100px;'>Error: " . $stmt->error . "</h3>";
}

$stmt->close();
$conn->close();
?></html>