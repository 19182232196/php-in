<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body class="login-bg">
    <div class="login layui-anim layui-anim-up">
        <div class="message">学生信息管理平台</div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form">
            <input name="user" id="user" placeholder="账号" 
            type="text" lay-verify="required" class="layui-input" autocomplete="off">
            <hr class="hr15">
            <input name="pwd" id="pwd" lay-verify="required" placeholder="密码" 
            type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" id="login_submit" lay-submit lay-filter="login"
            style="width:100%;" type="submit">
        </form>
    </div>
</body>
<!-- 引入 layui.js -->
    <script src="./layui/layui.js"></script>
    <script src="./js/login.js"></script>
</html>