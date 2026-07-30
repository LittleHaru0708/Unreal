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

    // データ取得
    $stmt = $pdo->query("SELECT * FROM test_table");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // セッション開始
    session_start();
    $_SESSION['data'] = $results;

    // リダイレクト
    header("Location: display_test_db_2.php");
    exit();

} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>