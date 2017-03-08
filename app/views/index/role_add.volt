{% extends "master.volt" %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url('/index/index') }}">首页</a></li>
        <li><a href="{{ url('/index/role') }}">角色列表</a></li>
        <li class="active">角色新增</li>
    </ol>
    <h1 class="page-header">
        角色新增
    </h1>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">角色名</label>
                    <input type="text" class="form-control" id="name" placeholder="角色名">
                </div>
                <div id="list"></div>

                <a onclick="btnSave()" class="btn btn-default">保存</a>
            </form>
        </div>
    </div>

    <input type="hidden" id="saveUrl" value="{{ url('/api/role/pfnSave') }}">
    <input type="hidden" id="postUrl" value="{{ url('/api/permission/pfnAllList') }}">
{% endblock %}
{% block js %}
    <script>
        $(function () {
            $.setSideBar(1);
            bindData();
        });

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
            var pid = $("#pid").val();
            var name = $("#name").val();
            var url = $("#url").val();
            if (name.trim() == "") {
                $.error("请输入权限名称");
                return;
            }
            if (url.trim() == "") {
                $.error("请输入权限地址");
                return;
            }
            var json = {
                pid: pid,
                name: name,
                url: url
            };
            var url = $("#saveUrl").val();
            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    $.success("保存成功！", function () {
                        location = jsonData.data.redirectUrl;
                    });
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }
    </script>
{% endblock %}
