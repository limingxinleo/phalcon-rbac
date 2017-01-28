{% extends "master.volt" %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url('/index/index') }}">首页</a></li>
        <li><a href="{{ url('/index/index') }}">用户列表</a></li>
        <li class="active">用户详情</li>
    </ol>
    <h1 class="page-header">用户详情</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>登录名</th>
            </tr>
            <tbody>
            <tr>
                <td>{{ id }}</td>
                <td>{{ name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h2 class="page-header">
        我的角色
        <a onclick="btnSave()" class="btn btn-primary" style="float:right">保存</a>
    </h2>
    <div id="list"></div>

    <input type="hidden" id="postUrl" value="{{ url('/api/user/pfnUserRoleList') }}">
    <input type="hidden" id="saveUrl" value="{{ url('/api/user/pfnSaveUserRole') }}">
    <input type="hidden" id="id" value="{{ id }}">
{% endblock %}
{% block js %}
    <script>
        $(function () {
            $.setSideBar(0);
            bindData();
        })

        function bindData() {
            var json = {
                uid: $("#id").val()
            };
            var url = $("#postUrl").val();
            $.post(url, json, function (jsonData) {
                console.log(jsonData);
                if (jsonData.status == 1) {
                    var html = "";
                    $.each(jsonData.data, function (i, v) {
                        var checked = v.status > 0 ? "checked=checked" : "";
                        html += '<div class="checkbox">';
                        html += '<label>';
                        html += '<input name="role" type="checkbox" value="' + v.id + '" ' + checked + '>';
                        html += v.name + ' | ' + v.desc;
                        html += '</label>';
                        html += '</div>';
                    });
                    $("#list").html(html);
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

        function btnSave() {
            var id = $("#id").val();
            var role = $("input[name=role]:checked");
            var roles = [];
            $.each(role, function (i, v) {
                roles.push($(v).val());
            })
            var json = {
                uid: id,
                role: roles
            };
            var url = $("#saveUrl").val();
            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    location.reload();
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }
    </script>
{% endblock %}
