<?php
// 开启SESSION
session_start();
// 判断用户是否登入
if (empty($_SESSION['name'])) {
  header("refresh:0.1,url=./login.php"); // 它告诉浏览器自动刷新页面
  die();
}
// 连接数据库
include 'php/conn.php';

// SQL语句 查询stuinfo表所有数据
$sql = 'SELECT * FROM stuinfo;';  // 修正变量名为 $sql

// 执行SQL语句
$result = mysqli_query($link, $sql);

// 查询结果 二维枚举数组
/** 
 * 函数用于从结果集中检索所有行，并将它们作为数组返回。
 * 当你传递 MYSQLI_ASSOC 作为该函数的第二个参数时，
 * 返回的数组将是一个二维数组，其中每个子数组都表示结果集中的一行，
 * 并且使用列表作为键 （关联数组）。
 */
$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);

// 查询stuinfo表有多少行数据 共多少人
$count = count($arr);

// 查询男、女生有多少人
$sex = '';
for ($i = 0; $i < count($arr); $i++) {
  $sex .= $arr[$i]['sex'];
}
$man = substr_count($sex, '男');
$woman = substr_count($sex, '女');
?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>学生信息管理平台</title>
  <!-- 引入layui.css框架 -->
  <link rel="stylesheet" href="layui/css/layui.css" />
  <!-- 引入index.css样式表 -->
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>
  <table class="layui-table" lay-skin="line" id="tableExcel">
    <caption style="text-align:center">
      <h2>学生信息管理平台</h2>欢迎您管理员，<?php echo $_SESSION['name']; ?>|&nbsp;&nbsp;&nbsp;
      <a href="javascript:;" class="logout">退出登入</a>
      <div class="btn_left">
        <a>共<?php echo $count; ?>人</a>
        <a>男<?php echo $man; ?>人</a>
        <a>女<?php echo $woman; ?>人</a>
      </div>
      <div class="btn_right">
        <a title="添加学生" class="add_btn" onclick="show(this.getAttribute('title'),'add.php')">
          <i class="layui-icon layui-icon-add-circle-fine"></i>
        </a>&nbsp;&nbsp;
        <a title="删除学生" class="many_del">
          <i class="layui-icon layui-icon-delete"></i>
        </a>&nbsp;&nbsp;
        <a title="点击下载" class="downlad" id="export">
          <i class="layui-icon layui-icon-download-circle"></i>
        </a>
      </div>
    </caption>
    <thead>
      <tr>
        <th width="20"></th>
        <th>编号</th>
        <th>姓名</th>
        <th>性别</th>
        <th>年龄</th>
        <th>手机号码</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($arr); $i++) { ?>
        <tr>
          <td class="id"><?php echo $arr[$i]['id']; ?></td>
          <td>
            <form class="layui-form" action="">
              <input type="checkbox" class="checkbox" lay-skin="primary">
            </form>
          </td>
          <td><?php echo $i + 1; ?></td>
          <td><?php echo $arr[$i]['name']; ?></td>
          <td><?php echo $arr[$i]['sex']; ?></td>
          <td><?php echo $arr[$i]['age']; ?></td>
          <td><?php echo $arr[$i]['phone_number']; ?></td>
          <td>
            <a title="修改" href="javascript:;" onclick="show('修改信息','update.php?id=<?php echo $arr[$i]['id']; ?>')">
              <i class="layui-icon layui-icon-edit" style="color: #1E9FFF;"></i>
            </a>
            <a title="删除" class="single_del" href="javascript:;">
              <i class="layui-icon layui-icon-delete" style="color: red;"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- 引入layui 框架 -->
  <script src="//unpkg.com/layui@2.9.13/dist/layui.js"></script>
  <!-- 引入弹出层模块 -->
  <script src="js/eject.js"></script>
  <!-- 引入index.js -->
  <script src="js/index.js"></script>
</body>

</html>