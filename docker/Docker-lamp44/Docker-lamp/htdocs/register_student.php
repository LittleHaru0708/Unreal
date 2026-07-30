<?php
$host = 'mysql';
$username = 'data_user';
$password = 'data';
$database = 'test_db'; // ←修正

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"]));
    $class_id = filter_var($_POST["class_id"], FILTER_VALIDATE_INT);

    if (empty($name)) {
        die("input name");
    }
    if ($class_id === false) {
        die("input class_id");
    }

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$database;charset=utf8mb4",
            $username,
            $password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 最大ID取得
        $stmt_max_id = $pdo->query("SELECT MAX(student_id) FROM students");
        $max_id = $stmt_max_id->fetchColumn();
        $next_id = ($max_id === null) ? 1 : $max_id + 1;

        // INSERT
        $sql = "INSERT INTO students (student_id, student_name, class_id)
                VALUES (:student_id, :student_name, :class_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':student_id', $next_id, PDO::PARAM_INT);
        $stmt->bindParam(':student_name', $name);
        $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);

        $stmt->execute();

        echo "regist OK <br>";
        echo "Student ID: " . $next_id;

    } catch (PDOException $e) {
        echo "regist FAIL: " . $e->getMessage();
    }
}
?>