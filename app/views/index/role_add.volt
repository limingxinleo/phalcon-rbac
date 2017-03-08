{% extends "master.volt" %}
{% block content %}
    <link rel="stylesheet" href="{{ static_url('/lib/zTree_v3/css/zTreeStyle/zTreeStyle.css') }}">
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
                    <input type="text" class="form-control" id="role" placeholder="角色名">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">角色介绍</label>
                    <input type="text" class="form-control" id="desc" placeholder="角色名">
                </div>
                <div class="zTreeDemoBackground left">
                    <ul id="list" class="ztree"></ul>
                </div>
                <a onclick="btnSave()" class="btn btn-default">保存</a>
            </form>
        </div>
    </div>

    <input type="hidden" id="saveUrl" value="{{ url('/api/role/pfnSave') }}">
    <input type="hidden" id="postUrl" value="{{ url('/api/permission/pfnAllList') }}">
    <input type="hidden" id="redirectUrl" value="{{ url('/index/role') }}">
{% endblock %}
{% block js %}
    <script src="{{ static_url('/lib/zTree_v3/js/jquery.ztree.core.js') }}"></script>
    <script src="{{ static_url('/lib/zTree_v3/js/jquery.ztree.excheck.js') }}"></script>
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
                    var zNodes = [];
                    $.each(jsonData.data, function (i, v) {
                        zNodes.push({id: v.id, pId: v.pid, name: v.name});
                    });
                    initZtree(zNodes);
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

        function initZtree(zNodes) {
            var setting = {
                check: {
                    enable: true,
                    chkboxType: {"Y": "", "N": ""}
                },
                data: {
                    simpleData: {
                        enable: true
                    }
                }
            };
            $.fn.zTree.init($("#list"), setting, zNodes);
        }

        function btnSave() {
            var zTree = $.fn.zTree.getZTreeObj("list");
            var permission = [];
            $.each(zTree.getCheckedNodes(), function (i, v) {
                permission.push(v.id);
            })
            var role = $("#role").val();
            if (role.trim() == "") {
                $.error("请输入角色名称");
                return;
            }
            var desc = $("#desc").val();
            var json = {
                role: role,
                desc: desc,
                permission: permission
            };
            var url = $("#saveUrl").val();
            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    console.log(jsonData);
                    $.success("保存成功！", function () {
                        location = $("#redirectUrl").val();
                    });
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }
    </script>
{% endblock %}
