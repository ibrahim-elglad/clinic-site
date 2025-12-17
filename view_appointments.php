<?php
session_start();

// غيّر الباسوورد ده للي تحبه (مثلاً: clinic2025 أو اسمك أو أي حاجة صعبة)
$correct_password = "ibrahim.12";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // لو حد دخل غلط 3 مرات → نطرده
    if (!isset($_SESSION['attempts'])) $_SESSION['attempts'] = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['password'] === $correct_password) {
            $_SESSION['logged_in'] = true;
        } else {
            $_SESSION['attempts']++;
            $error = "الباسوورد غلط! (محاولة " . $_SESSION['attempts'] . "/3)";
            if ($_SESSION['attempts'] >= 3) {
                die("<h2 style='color:red;text-align:center;padding:200px;background:#000;color:#fff;'>تم حظرك مؤقتًا! جرب تاني بعد ساعة.</h2>");
            }
        }
    }

    if (!isset($_SESSION['logged_in'])) {
        echo '<!DOCTYPE html>
        <html lang="ar" dir="rtl">
        <head>
            <meta charset="utf-8">
            <title>Manger Login</title>
            <style>
                body{background:linear-gradient(135deg,#667eea,#764ba2);display:flex;justify-content:center;align-items:center;height:100vh;margin:0;font-family:Tahoma;}
                .box{background:white;padding:50px;border-radius:20px;box-shadow:0 20px 40px rgba(0,0,0,0.3);width:400px;text-align:center;}
                h2{color:#333;margin-bottom:30px;}
                input[type="password"]{width:100%;padding:15px;font-size:18px;border-radius:10px;border:1px solid #ddd;margin:10px 0;}
                button{background:#00a8a8;color:white;border:none;padding:15px 30px;border-radius:10px;font-size:18px;cursor:pointer;width:100%;}
                button:hover{background:#007c7c;}
                .error{color:red;margin:15px 0;font-weight:bold;}
            </style>
        </head>
        <body>
            <div class="box">
                <h2>manger-Date</h2>
                ' . (isset($error) ? "<p class='error'>$error</p>" : "") . '
                <form method="post">
                    <input type="password" name="password" placeholder="Enter Password" required autofocus>
                    <button type="submit">login</button>
                    </form>
                    <a href="index.html" class="backmain"><button type="submit">Back</button></a>
               
            </div>
        </body>
        </html>';
        exit;
    }
}

// لو وصل هنا → يبقى دخل الباسوورد صح → نعرض المواعيد

require "db.php";
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>جميع المواعيد المحجوزة</title>
    <style>
        body{font-family:Tahoma;background:#f0f8ff;padding:30px;}
        .container{max-width:1200px;margin:auto;background:white;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,0.1);overflow:hidden;}
        h1{background:#00a8a8;color:white;padding:25px;text-align:center;margin:0;font-size:28px;}
        .total{background:#e0f7fa;padding:20px;text-align:center;font-size:24px;font-weight:bold;color:#00a8a8;}
        table{width:100%;border-collapse:collapse;margin-top:20px;}
        th{background:#00a8a8;color:white;padding:18px;}
        td{padding:15px;text-align:center;border-bottom:1px solid #eee;}
        tr:hover{background:#f0f8ff;}
        .logout{position:fixed;top:20px;left:20px;background:red;color:white;padding:10px 20px;border-radius:10px;text-decoration:none;font-weight:bold;}
        .back{position:fixed;top:20px;right:20px;background:#00a8a8;color:white;padding:10px 20px;border-radius:10px;text-decoration:none;}
        .backMain button{margin-top:20px}
        
    </style>
</head>
<body>
    <a href="?logout=1" class="logout">LOg Out</a>
    <a href="index.html" class="back">Home Page</a>

    <div class="container">
        <h1>ALl Date Appointment</h1>
        <div class="total">
            <?php
            if (isset($_GET['logout'])) {
                session_destroy();
                header("Location: view_appointments.php");
                exit;
            }
            $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM appointments");
            $row = mysqli_fetch_assoc($result);
            echo "  Total Appointment: <strong>" . $row['total'] . "</strong>";
            ?>
        </div>

        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>phone </th>
                <th>Data & Time</th>
                <th>Gender</th>
                <th>Appointment Date</th>
            </tr>
            <?php
            // $result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY datetime DESC");
            $result = mysqli_query($conn, "SELECT * FROM appointments ORDER BY id ASC");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
                        <td dir='ltr'>{$row['phone']}</td>
                        <td>" . date('d-m-Y h:i A', strtotime($row['datetime'])) . "</td>
                        <td>" . ($row['gender']=='male'?'Male':'Female') . "</td>
                        <td>" . date('d-m-Y h:i A', strtotime($row['created_at'])) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Not Date Appointment</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>