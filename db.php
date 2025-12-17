 <?php 
 $host = "localhost";
$user = "root";
$pass = "";                    // لو عندك باسوورد حطه هنا
$db   = "clinic_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// لدعم الحروف العربية
mysqli_set_charset($conn, "utf8mb4");
?> 



