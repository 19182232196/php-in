layui.use(['form', 'layer'], function () {
    var form = layui.form;
    var $ = layui.$;
    var layer = layui.layer;

    // 监听表单提交
    form.on('submit(formDemo)', function (data) {
        // 阻止表单默认提交
        return false;
    });

    // 提交按钮点击事件
    $("#submit").click(function () {
        var name = $("#name").val();
        var sex = $("input[name='sex']:checked").val();
        var age = $("#age").val();
        var phone = $("#phone_number").val();

        // 表单验证
        if (name === '' || name === null) {
            layer.msg("姓名不能为空", { icon: 5 });
        } else if (age === '' || age === null) {
            layer.msg("年龄不能为空", { icon: 5 });
        } else if (phone === '' || phone === null) {
            layer.msg("手机号码不能为空", { icon: 5 });
        } else if (name.length > 6 || name.length < 2) {
            layer.msg('姓名格式不对', { icon: 5 });
        } else if (isNaN(parseInt(age)) || parseInt(age) >= 60) {
            layer.msg('年龄格式不对', { icon: 5 });
        } else if (!isPhone(phone)) {
            layer.msg('手机号码格式不对', { icon: 5 });
        } else {
            // 表单数据通过 Ajax 发送到后端
            layer.msg('加载中', { icon: 16, shade: 0.01 });
            $.ajax({
                url: 'php/add.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    name: name,
                    sex: sex,
                    age: age,
                    phone_number: phone
                },
                error: function (result) {
                    console.log(result);
                    layer.msg('添加失败', { icon: 5 });
                },
                success: function (result) {
                    if (result == '0') {
                        layer.msg('添加失败', { icon: 5 });
                    } else if (result == '1') {
                        layer.msg('添加成功', { icon: 6 });
                        setTimeout(function () {
                            // 添加成功后跳转到指定页面
                            window.location.href = 'index.php';
                        }, 1000);
                    }
                }
            });
        }
    });

    // 重置按钮点击事件
    $(".reset").click(function () {
        // 重置表单
        $("#name").val('');
        $("input[name='sex']").prop("checked", false);
        $("input[name='sex'][value='w']").prop("checked", true); // 默认选中男性
        $("#age").val('');
        $("#phone_number").val('');
        return false; // 阻止表单重置
    });

    // 手机号码格式验证函数
    function isPhone(phone) {
        var pattern = /^1[3456789]\d{9}$/;
        return pattern.test(phone);
    }
});
