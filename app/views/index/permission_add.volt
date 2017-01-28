{% extends "master.volt" %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url('/index/index') }}">首页</a></li>
        <li><a href="{{ url('/index/permission') }}">权限列表</a></li>
        <li class="active">权限新增</li>
    </ol>
    <h1 class="page-header">
        权限新增
    </h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>权限名名</th>
                <th>权限</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            </tbody>
        </table>
        <div id="page"></div>
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/api/permission/pfnPermissionList') }}">
    <input type="hidden" id="infoUrl" value="{{ url('/index/permissionInfo') }}">
{% endblock %}
{% block js %}
    <script>
        $(function () {
            $.setSideBar(2);
            bindData();
        });
    </script>
{% endblock %}
