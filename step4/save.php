<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";         // اسم المستخدم الافتراضي في XAMPP
$password = "";         // عادةً بدون كلمة مرور
$db = "my_bmi"; // اسم قاعدة البيانات

$conn = new mysqli($host, $user, $password, $db);

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال البيانات
$name = $_POST['name'];
$weight = $_POST['weight'];
$height = $_POST['height'];

// حساب BMI
$bmi = $weight / ($height * $height);

// تحديد التفسير
if ($bmi < 18.5) {
    $result = "Underweight";
} elseif ($bmi >= 18.5 && $bmi <= 24.9) {
    $result = "Normal weight";
} elseif ($bmi >= 25 && $bmi <= 29.9) {
    $result = "Overweight";
} else {
    $result = "Obese";
}

// حفظ البيانات في الجدول
$sql = "INSERT INTO result (name, weight, height, bmi, result, date) 
        VALUES ('$name', '$weight', '$height', '$bmi', '$result', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "<h3 style='color: green;'>BMI calculated and saved successfully!</h3>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>BMI:</strong> " . round($bmi, 2) . "</p>";
    echo "<p><strong>Result:</strong> $result</p>";
    echo "<a href='index.html'>Back</a> | <a href='history.php'>View History</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>