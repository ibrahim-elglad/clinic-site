<?php
if ($_POST) {
    require "db.php";

    $name     = $_POST['name'] ?? '';
    $age      = intval($_POST['age'] ?? 0);
    $phone    = $_POST['phone'] ?? '';
    $datetime = $_POST['datetime'] ?? '';
    $gender   = $_POST['gender'] ?? '';

    $stmt = $conn->prepare("INSERT INTO appointments (name, age, phone, datetime, gender) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $phone, $datetime, $gender);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<h1 style='color:green;text-align:center;padding:200px;background:#e8f5e9;font-family:Tahoma;'>
            appointment Sucsessfly   $name ✅<br><br>
            <a href='index.html' style='color:#fff;background:#00c853;padding:15px 40px;border-radius:50px;text-decoration:none;'>العودة</a>
            <a href='view_appointments.php' style='color:#fff;background:#00695c;padding:15px 40px;border-radius:50px;text-decoration:none;margin:0 20px;'>Show dates</a>
          </h1>";
    exit;
}
?>