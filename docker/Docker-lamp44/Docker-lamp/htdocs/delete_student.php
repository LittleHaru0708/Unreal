<?php
$host = 'mysql';
$username = 'data_user';
$password = 'data';
$database = 'test_db'; // ←ここ重要

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['student_id']) && is_numeric($_POST['student_id'])) {

        $student_id = $_POST['student_id'];

        try {
            $conn = new PDO(
                "mysql:host=$host;dbname=$database;charset=utf8mb4",
                $username,
                $password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM students WHERE student_id = :student_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "ID: " . htmlspecialchars($student_id) . " deleted";
            } else {
                echo "ID: " . htmlspecialchars($student_id) . " not found";
            }

        } catch (PDOException $e) {
            echo "delete FAIL: " . $e->getMessage();
        }

    } else {
        echo "request error";
    }

} else {
    echo "access error";
}
?>