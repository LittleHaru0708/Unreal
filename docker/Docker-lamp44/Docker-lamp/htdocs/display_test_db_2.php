<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>display_data</title>
</head>
<body>

<h1>data_list</h1>

<?php
if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];

    if (count($data) > 0) {

        echo "<table border='1'>";

        // ヘッダー
        echo "<tr>";
        foreach (array_keys($data[0]) as $column) {
            echo "<th>" . htmlspecialchars($column) . "</th>";
        }
        echo "</tr>";

        // データ
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";

    } else {
        echo "<p>no data1</p>";
    }

    unset($_SESSION['data']);

} else {
    echo "<p>no data2</p>";
}
?>

</body>
</html>