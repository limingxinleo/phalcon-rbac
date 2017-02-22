/**
 * Created by limx on 2017/1/27.
 */
jQuery.alert = function (msg, type, callback) {
    if (typeof type == "undefined") type = "success";
    var html = "";
    html += '<div id="alert" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">';
    html += '<div class="modal-dialog modal-sm" role="document">';
    html += '<div class="alert alert-' + type + '" role="alert">' + msg + '</div>';
    html += '</div>';
    html += '</div>';
    $("#modal").html(html);
    $('#alert').modal();
    $('#alert').on('hidden.bs.modal', function (e) {
        $('.modal-backdrop').remove();
        if (typeof callback == "function") {
            callback();
        }
    });
};
jQuery.confirm = function (obj) {
    var title = obj.title;
    var content = obj.content;
    var btn = obj.button;

    var html = "";
    html += '<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
    html += '<div class="modal-dialog" role="document">';
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';
    html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    html += '<h4 class="modal-title" id="myModalLabel">' + title + '</h4>';
    html += '</div>';
    html += '<div class="modal-body">';
    html += content;
    html += '</div>';
    html += '<div class="modal-footer">';
    for (key in btn) {
        html += '<button type="button" class="btn btn-' + btn[key].type + '" data-dismiss="modal" id="_btn_' + key + '">' + btn[key].label + '</button>';
    }
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    $("#modal").html(html);
    $('#alert').modal();

    $('#alert').on('hidden.bs.modal', function (e) {
        $('.modal-backdrop').remove();
    });
    for (key in btn) {
        if (typeof btn[key].onClick == "function") {
            console.log(btn[key]);
            $("#_btn_" + key).on('click', {key: key}, function (event) {
                var index = event.data.key;
                btn[index].onClick();
            });
        }
    }
};
jQuery.success = function (msg, callback) {
    jQuery.alert(msg, "success", callback);
};
jQuery.info = function (msg, callback) {
    jQuery.alert(msg, "info", callback);
};
jQuery.warn = function (msg, callback) {
    jQuery.alert(msg, "warning", callback);
};
jQuery.error = function (msg, callback) {
    jQuery.alert(msg, "danger", callback);
};
jQuery.setSideBar = function (index) {
    $(".nav-sidebar>li").eq(index).addClass("active");
};