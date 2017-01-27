<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>RBAC权限管理系统</title>

    <!-- Bootstrap -->
    <link href="{{ static_url('/lib/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ static_url('/app/css/common.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
{% include "public/topBar.volt" %}
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            {% include "public/sideBar.volt" %}
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            {% block content %}{% endblock %}
        </div>
    </div>
</div>
<div id="modal"></div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ static_url('/lib/jquery-2.2.4/jquery.min.js') }}"></script>
<script src="{{ static_url('/lib/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
<script src="{{ static_url('/app/js/common.js') }}"></script>
{% block js %}{% endblock %}
</body>
</html>