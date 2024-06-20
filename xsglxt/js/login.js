layui.use(['layer', 'form'], function () {
  var $ = layui.$, // jQuery
    layer = layui.layer,
    form = layui.form;

  // 监听提交
  form.on('submit(login)', function (data) {
    return false; // 阻止表单默认提交
  });

  // 绑定点击事件
  $("#login_submit").on("click", function () {
    var user = $("#user").val(),
      pwd = $("#pwd").val();

    if (!user) {
      layer.msg('账号不能为空', { icon: 5 });
    } else if (!pwd) {
      layer.msg('密码不能为空', { icon: 5 });
    } else {
      // Ajax提交
      $.ajax({
        url: "php/login.php",
        data: {
          name: user,
          password: pwd,
        },
        type: "post",
        dataType: "text",
        success: function (data) {
          console.log(data);
          if (data == "4") {
            layer.msg('登录成功', { icon: 6 });
            setTimeout(function () {
              window.location.href = "/index.php";
            }, 1000);
          } else if (data == "0") {
            layer.msg('用户不存在', { icon: 5 });
          } else if (data == "6") {
            layer.msg('验证码错误', { icon: 5 });
          } else if (data == "5") {
            layer.msg('密码错误', { icon: 5 });
          } else {
            layer.msg('未知错误', { icon: 5 });
          }
        },
        error: function () {
          layer.msg('数据请求失败', { icon: 5 });
        }
      });
    }
  });
});
