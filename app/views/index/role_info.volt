{% extends "master.volt" %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url('/index/index') }}">首页</a></li>
        <li><a href="{{ url('/index/role') }}">角色列表</a></li>
        <li class="active">角色详情</li>
    </ol>
    <h1 class="page-header">角色详情</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>角色名</th>
                <th>详情</th>
            </tr>
            <tbody>
            <tr>
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.desc }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h2 class="page-header">
        我的权限
        <a onclick="btnSave()" class="btn btn-primary" style="float:right">保存</a>
    </h2>
    <div id="list"></div>

    <input type="hidden" id="postUrl" value="{{ url('/api/role/pfnRolePermissionList') }}">
    <input type="hidden" id="saveUrl" value="{{ url('/api/role/pfnSaveRolePermission') }}">
    <input type="hidden" id="id" value="{{ role.id }}">
{% endblock %}
{% block js %}
    <script>
        $(function () {
            $.setSideBar(1);
            bindData();
        })

        function bindData() {
            var json = {
                id: $("#id").val()
            };
            var url = $("#postUrl").val();
            $.post(url, json, function (jsonData) {
                console.log(jsonData);
                return;
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
