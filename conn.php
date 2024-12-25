<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // إعدادات الاتصال بقاعدة البيانات
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "conn"; // اسم قاعدة البيانات

    // إنشاء اتصال
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }

    // استقبال البيانات من النموذج
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['text'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // التحقق من أن جميع الحقول ممتلئة
        if ($name && $email && $password) {
            // تشفير كلمة المرور
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // إدخال البيانات إلى قاعدة البيانات
            $sql = "INSERT INTO user_data (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                echo "تم إنشاء الحساب بنجاح!";
            } else {
                echo "حدث خطأ أثناء إدخال البيانات: " . $conn->error;
            }
        } else {
            echo "يرجى تعبئة جميع الحقول.";
        }
    } else {
        echo "يرجى استخدام النموذج لإرسال البيانات.";
    }

    // إغلاق الاتصال
    $conn->close();

    ?>
</body>

</html>