<?php
//登入
/* php/login.php
  查询，的结果不存在，但是也会得到一个，值为0的对象转换成布尔型是真
  */
  
//连接数据库
include 'conn.php';

//接收前端传来的值
$user = $_POST['name'];
$pwd = $_POST['password'];
session_start();
//SQL语句
$sql = 'select * from admin where user="'.$user.'"';

//执行SQL语句
$result = mysqli_query($link,$sql);
 
//取出一行数据
$arr = mysqli_fetch_assoc($result);

if(!$arr){
  echo '0'; //账号不存在
  die();
}
if($user == $arr['user']){
  if($pwd == $arr['password']){
    //密码正确
      $_SESSION['name'] = $user;
      $_SESSION['password'] = $pwd;
      echo '4';
  } else {
    echo '5'; //密码错误
  }
}
?>