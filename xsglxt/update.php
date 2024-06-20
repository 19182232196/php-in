<?php
// 开启SESSION
session_start();

// 判断用户是否登入
if (empty($_SESSION['name'])) {
    header("refresh:0.1, url=./login.php");
    die();
}

// 连接数据库
include 'php/conn.php';

// 获取前端传来的参数
$id = isset($_GET['id']) ? $_GET['id'] : null;

// 检查 ID 是否为空
if (empty($id)) {
    die("未找到对应的记录，ID 为空");
}

// SQL语句 查询
$sql = "SELECT * FROM stuinfo WHERE id='$id'";

// 执行SQL语句
$result = mysqli_query($link, $sql);

// 检查SQL查询是否成功
if (!$result) {
    die("查询失败: " . mysqli_error($link));
}

// 查询结果
$arr = mysqli_fetch_assoc($result);

// 检查查询结果是否为空
if (!$arr) {
    die("未找到对应的记录，ID 为：$id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改信息</title>
    <!-- 引入 jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- 引入 layui CSS 文件 -->
    <link rel="stylesheet" href="layui/css/layui.css">
</head>
<body>

<div class="layui-container" style="margin-top: 20px;">
    <form class="layui-form" action="" style="width: 500px;">
        <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($arr['id']); ?>"> <!-- 隐藏字段 -->
            <div class="layui-form-item">
                <label class="layui-form-label">姓名</label>
                <div class="layui-input-block">
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($arr['name']); ?>"
                        class="layui-input" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="sex" value="m" title="男" <?php if ($arr['sex'] == 'm')
                        echo 'checked'; ?>>
                    <input type="radio" name="sex" value="w" title="女" <?php if ($arr['sex'] == 'w')
                        echo 'checked'; ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">年龄</label>
                <div class="layui-input-block">
                    <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($arr['age']); ?>"
                        class="layui-input" lay-verify="required|number" required>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号码</label>
                <div class="layui-input-block">
                    <input type="text" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($arr['phone_number']); ?>" class="layui-input"
                        lay-verify="required|phone" required>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button id="submit" type="button" class="layui-btn">立即修改</button>
                </div>
            </div>
        </form>
    </div>

    <!-- 引入 layui.js 文件 -->
    <script src="layui/layui.js"></script>
    <script src="js/update.js"></script>

</body>

</html>