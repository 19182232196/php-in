<?php
    // 开启SESSION
    session_start();
    // 判断用户是否登入
    if (empty($_SESSION['name'])) {
        header("refresh:0.1, url=./login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>添加学生</title>
    <!-- 引入layui.css框架 -->
    <link rel="stylesheet" type="text/css" href="layui/css/layui.css"/>
    <style>
        .layui-form-radio>i:hover, .layui-form-radioed>i {
            color: #1E9FFF;
        }
        .layui-btn {
            background-color: #1E9FFF;
        }
        .reset {
            background-color: #fff;
        }
        .layui-btn-primary:hover {
            border-color: #1E9FFF;
        }
    </style>
</head>
<body>
    <form class="layui-form" action="php/add.php" method="post" style="width: 500px; margin-top: 30px;">
        <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
                <input type="text" id="name" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="m" title="m" checked>
                <input type="radio" name="sex" value="w" title="w">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">年龄</label>
            <div class="layui-input-block">
                <input type="text" id="age" name="age" required lay-verify="required" placeholder="请输入年龄" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号码</label>
            <div class="layui-input-block">
                <input type="text" id="phone_number" name="phone_number" required lay-verify="required" placeholder="请输入手机号码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" id="submit">立即添加</button>
                <button type="reset" class="layui-btn layui-btn-primary reset">重置</button>
            </div>
        </div>
    </form>
    <!-- 引入layui.js框架 -->
    <script src="layui/layui.js"></script>
    <!-- 引入verification.js -->
    <script src="js/verification.js"></script>
    <!-- 引入add.js -->
    <script src="js/add.js"></script>
</body>
</html>
