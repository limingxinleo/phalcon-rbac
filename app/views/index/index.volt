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
            <tbody id="list">
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
        <div id="page"></div>
    </div>
    <input type="hidden" id="postUrl" value="{{ url('/api/user/pfnUserList') }}">
{% endblock %}
{% block js %}
    <script src="{{ static_url('/lib/jquery-2.2.4/jquery.pagination.js') }}"></script>
    <script>
        var pageSize = 10;
        var pageIndex = 0;

        $(function () {
            $.setSideBar(0);
            bindData();
        });

        //这个事件是在翻页时候用的
        function pageselectCallback(page_id) {
            pageIndex = page_id;
            bindData();
        }

        function bindData() {
            var json = {
                pageIndex: pageIndex,
                pageSize: pageSize
            };
            var url = $("#postUrl").val();
            $.post(url, json, function (jsonData) {
                if (jsonData.status == 1) {
                    var res = jsonData.data;
                    var html = "";
                    $.each(res.data, function (i, v) {
                        html += '<tr>\
                            <td>' + v.id + '</td>\
                            <td>' + v.name + '</td>\
                        </tr>';
                    });
                    $("#list").html(html);
                    initpagination(res.count);
                } else {
                    $.error(jsonData.message);
                }
            }, "json");
        }

        function initpagination(count) {
            //加入分页的绑定
            $("#page").pagination(count, {
                callback: pageselectCallback,
                prev_text: '上一页',
                next_text: '下一页',
                items_per_page: pageSize,
                num_display_entries: 6,
                current_page: pageIndex,
                num_edge_entries: 2
            });
        }
    </script>
{% endblock %}
