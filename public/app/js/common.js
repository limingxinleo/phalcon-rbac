/**
 * Created by limx on 2017/1/27.
 */
jQuery.alert = function (msg, type) {
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
        $("#modal").html("");
    })
};
jQuery.success = function (msg) {
    jQuery.alert(msg, "success");
};
jQuery.info = function (msg) {
    jQuery.alert(msg, "info");
};
jQuery.warn = function (msg) {
    jQuery.alert(msg, "warning");
};
jQuery.error = function (msg) {
    jQuery.alert(msg, "danger");
};