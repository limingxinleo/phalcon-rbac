{% extends "master.volt" %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url('/index/index') }}">用户管理</a></li>
        <li><a href="{{ url('/index/index') }}">用户列表</a></li>
        <li class="active">用户详情</li>
    </ol>
    <h1 class="page-header">用户详情</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ id }}</td>
            </tr>
            <tr>
                <td>登录名</td>
                <td>{{ name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h2 class="page-header">我的角色</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>角色</th>
                <th>详情</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            </tbody>
        </table>
        <div id="page"></div>
    </div>

    <input type="hidden" id="postUrl" value="{{ url('/api/user/pfnUserRoleList') }}">
    <input type="hidden" id="infoUrl" value="{{ url('/index/userInfo') }}">
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
                        html += '<tr>';
                        html += '<td>' + v.name + '</td>';
                        html += '<td>' + v.desc + '</td>';
                        html += '<td>';
                        html += '<a onclick="btnDel(' + v.id + ')" class="btn btn-danger btn-sm">删除</a>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $("#list").html(html);
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

        function btnDel(id) {
            $.warn(id);
        }
    </script>
{% endblock %}
