{% extends "layout.volt" %}
{% block content %}
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome</h1>
            <p>RBAC权限管理系统</p>
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
                    <div class="form-group">
                        <label>重复密码</label>
                        <input type="password" class="form-control" id="password2" placeholder="重复密码">
                    </div>
                    <a onclick="sub()" class="btn btn-default">Submit</a>
                </form>
            </div>
        </div>
    </div>
{% endblock %}
{% block js %}
    <script>
        function sub() {
            if (!checkInput()) {
                $.alert(11);
            }
            var name = $("#name").val();
            var pass = $("#password").val();
            var pass2 = $("#password2").val();
        }

        function checkInput() {
            var name = $("#name").val();
            var pass = $("#password").val();
            var pass2 = $("#password2").val();
            if (pass != pass2) {
                return false;
            }
            if (pass.trim() == "") {
                return false;
            }
            if (name.trim() == "") {
                return false;
            }
            if (pass2.trim() == "") {
                return false;
            }
            return true;
        }
    </script>
{% endblock %}