/**
 * Created by limx on 2017/3/8.
 */
function clearCache(e) {
    var url = $(e).attr('data-url');
    $.post(url, {key: 123456}, function (jsonData) {
        if (jsonData.status == 1) {
            $.success("缓存清除成功！");
        } else {
            $.error(jsonData.message);
        }
    }, "json");
}