<?php
// 连接数据库
$host = 'localhost';
$user = 'root';
$pwd = '484110';
$dbname = 'stuinfo';

// 创建连接
$link = mysqli_connect($host, $user, $pwd, $dbname);

// 检查连接
if (!$link) {
  die("连接失败: " . mysqli_connect_error());
}

// 设置字符集
mysqli_set_charset($link, 'utf8');

// 检查数据库选择
if (!mysqli_select_db($link, $dbname)) {
  echo "<h2>选择数据库失败</h2>";
  die();
}
?>