{% extends "layout.volt" %}
{% block content %}
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome</h1>
            <p>RBAC权限管理系统</p>
            <p>初始化管理员信息</p>
            <p>
                <a class="btn btn-primary btn-lg" href="https://github.com/limingxinleo/phalcon-rbac" role="button">
                    Learn more
                </a>
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <form>
                    <div class="form-group">
                        <label>用户名</label>
                        <input type="text" class="form-control" id="name" placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" class="form-control" id="password" placeholder="密码">
                    </div>
                    <a onclick="sub()" class="btn btn-default">登录</a>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/login/pfnLogin') }}">
    <input type="hidden" id="targetUrl" value="{{ url('/index/index') }}">
{% endblock %}
{% block js %}
    <script>
        function sub() {
            if (!checkInput()) {
                return;
            }
            var name = $("#name").val();
            var pass = $("#password").val();

            var json = {
                name: name,
                password: pass
            };
            var url = $("#postUrl").val();

            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    var target = $("#targetUrl").val();
                    console.log(jsonData);
                    //location = target;
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

        function checkInput() {
            var name = $("#name").val();
            var pass = $("#password").val();
            if (pass.trim() == "") {
                $.error("请输入密码！");
                return false;
            }
            if (name.trim() == "") {
                $.error("请输入登录名");
                return false;
            }
            return true;
        }
    </script>
{% endblock %}