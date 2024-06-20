<?php
// 连接数据库
include 'conn.php';

// 获取前端传来的参数
$id = isset($_POST['id']) ? $_POST['id'] : null;
$sex = isset($_POST['sex']) ? $_POST['sex'] : null;
$age = isset($_POST['age']) ? $_POST['age'] : null;
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;

// 调试日志输出
error_log("Received ID: $id");
error_log("Received Sex: $sex");
error_log("Received Age: $age");
error_log("Received Phone: $phone_number");

// 检查参数是否为空
if (empty($id) || empty($sex) || empty($age) || empty($phone_number)) {
    echo json_encode(['code' => 1, 'msg' => '参数不完整']);
    die();
}

// SQL语句 更新
$sql = "UPDATE stuinfo SET sex='$sex', age='$age', phone_number='$phone_number' WHERE id='$id'";

// 执行SQL语句
$result = mysqli_query($link, $sql);

// 检查SQL执行是否成功
if (!$result) {
    echo json_encode(['code' => 1, 'msg' => '更新失败: ' . mysqli_error($link)]);
    die();
}

// 返回成功信息
echo json_encode(['code' => 0, 'msg' => '更新成功']);
?>