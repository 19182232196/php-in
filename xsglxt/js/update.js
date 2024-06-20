layui.use(['form', 'layer'], function () {
    var form = layui.form;
    var $ = layui.$,
        layer = layui.layer;

    // 监听提交按钮点击事件
    $("#submit").click(function () {
        var age = $("#age").val();
        var phone = $("#phone").val();
        var id = $("#id").val(); // 获取隐藏的 ID 字段

        if (age === '' || age === null) {
            layer.msg('年龄不能为空', { icon: 5 });
        } else if (isNaN(parseInt(age)) || parseInt(age) >= 60) {
            layer.msg('年龄格式不对', { icon: 5 });
        } else if (!myPhone(phone)) {
            layer.msg('手机号码格式不对', { icon: 5 });
        } else if (getRadioVal('sex') !== 'm' && getRadioVal('sex') !== 'w') {
            layer.msg('请选择性别', { icon: 5 });
        } else {
            layer.msg('加载中', { icon: 16, shade: 0.01 });
            $.ajax({
                url: 'php/update.php',
                type: 'POST',
                dataType: 'json', // 期望的返回数据类型为 JSON
                data: {
                    id: id,
                    sex: getRadioVal('sex'),
                    age: age,
                    phone_number: phone
                },
                error: function (result) {
                    console.log(result);
                    layer.msg('发生错误，请稍后再试', { icon: 5 });
                },
                success: function (result) {
                    if (result.code === 1) {
                        layer.msg('修改失败: ' + result.msg, { icon: 5 });
                    } else if (result.code === 0) {
                        layer.msg('修改成功', { icon: 6 });
                        setTimeout(function () {
                            window.location.href = 'index.php'; // 修改成功后的跳转页面
                        }, 1000);
                    } else {
                        layer.msg('未知错误', { icon: 5 });
                    }
                }
            });
        }
    });

    // 获取单选按钮组的选中值
    function getRadioVal(name) {
        var radios = document.getElementsByName(name);
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                return radios[i].value;
            }
        }
        return null; // 如果没有选中任何项，可以返回 null 或者其他默认值
    }

    // 手机号码格式验证函数
    function myPhone(phone) {
        var pattern = /^1[3456789]\d{9}$/;
        return pattern.test(phone);
    }
});
