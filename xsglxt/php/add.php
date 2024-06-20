<?php
include 'conn.php';

// 获取前端值
$name = $_POST['name'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$phone = $_POST['phone_number']; // 修正为正确的字段名

// 插入数据到 stuinfo 表中
$sql = "INSERT INTO stuinfo (name, sex, age, phone_number) VALUES ('$name', '$sex', $age, '$phone')";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo '0'; // 插入失败
    die();
} else {
    echo '1'; // 插入成功
}
?>