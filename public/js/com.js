/**
 * Created by Administrator on 2018/1/29.
 */
$(function(){
    $('#com').on('change', function () {
        $.getData('/admin/car_pattSearchByCom', {com:$(this).val()}, function (res) {
            if(res.result.code == 1){
                var emptyOption = new Option('请选择', '');
                $(emptyOption).attr('selected', 'selected');
                $(emptyOption).attr('disable', 'disable');
                $('#car_patt').empty().append(emptyOption);
                $.each(res.carPatts, function (k, v) {
                    var o = new Option(v.name, v.id);
                    $('#car_patt').append(o);
                });
            }
        });
    });
});