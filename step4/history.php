<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$password = "";
$db = "my_bmi";

$conn = new mysqli($host, $user, $password, $db);

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام البيانات
$sql = "SELECT * FROM result ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMI History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-primary">BMI Calculation History</h2>
    <table class="table table-striped table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Weight (kg)</th>
                <th>Height (m)</th>
                <th>BMI</th>
                <th>Result</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['weight'] ?></td>
                        <td><?= $row['height'] ?></td>
                        <td><?= round($row['bmi'], 2) ?></td>
                        <td><?= $row['result'] ?></td>
                        <td><?= $row['date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.html" class="btn btn-primary">Back</a>
</div>
</body>
</html>

<?php $conn->close(); ?>