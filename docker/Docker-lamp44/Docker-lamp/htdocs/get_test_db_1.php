<?php
$host = 'mysql';
$username = 'data_user';
$password = 'data';
$database = 'test_db';

$mysql = new mysqli($host, $username, $password, $database);

if ($mysql->connect_error) {
    die("データベース接続エラー: " . $mysql->connect_error);
}

// URLパラメータ取得
$id = 0;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

// SQL作成
if ($id) {
    $sql = "SELECT * FROM test_table WHERE id = " . $id;
} else {
    $sql = "SELECT * FROM test_table";
}

// 実行
$result = $mysql->query($sql);

// 表示
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] .
             ", name: " . $row["name"] .
             ", number: " . $row["example_number"] .
             ", message: " . $row["example_message"] . "<br>";
    }
} else {
    echo "データなし";
}

$mysql->close();
?>