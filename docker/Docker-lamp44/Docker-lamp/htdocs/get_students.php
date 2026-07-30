<?php
$host = 'mysql';
$username = 'data_user';
$password = 'data';
$database = 'test_db';
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$database;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // students取得
    $stmt = $pdo->query("SELECT * FROM students");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['data'] = $results;

    header("Location: display_students.php");
    exit();

} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>