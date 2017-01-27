{% extends "master.volt" %}
{% block content %}

    <h1 class="page-header">用户列表</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1,001</td>
                <td>Lorem</td>
            </tr>
            <tr>
                <td>1,002</td>
                <td>amet</td>
            </tr>
            </tbody>
        </table>
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/api/user/pfnUserList') }}">
{% endblock %}
{% block js %}
    <script>
        $(function () {
            $.setSideBar(0);
            bindData();
        });

        function bindData() {
            var json = {
                pageIndex: 0
            };
            var url = $("#postUrl").val();
            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    console.log(jsonData);
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }
    </script>
{% endblock %}
