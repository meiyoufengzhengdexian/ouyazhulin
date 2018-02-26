/**
 * Created by Administrator on 2018/1/29.
 */

$(function () {
    $('#city').on('change', function () {
        $.getData('/admin/storeByCityCode', {code:$(this).val()}, function (res) {
            if(res.result.code == 1){
                $('#store').empty().append(new Option('全部', ''));
                $.each(res.stores, function (k, v) {
                    var o = new Option(v.name, v.id);
                    $('#store').append(o);
                })
            }
        })
    });
});
