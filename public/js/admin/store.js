/**
 * Created by Administrator on 2018/1/3.
 */
layui.use('laydate', function () {
    var laydate = layui.laydate;
    laydate.render({
        elem: '#open_time',
        type: 'time',
        format: 'HH:mm'
    });
    laydate.render({
        elem: '#close_time',
        type: 'time',
        format: 'HH:mm'
    });
});

$(function () {
    layui.use('layer', function () {
        load = layer.load(1);
        AMap.service('AMap.DistrictSearch', function () {
            //实例化DistrictSearch
            AmapsSearch = new AMap.DistrictSearch({
                level: 'province',
                subdistrict: '1',
                extensions: 'base',
                showbiz: false
            });
            $sheng = $('#sheng');

            AmapsSearch.search('中国', function (status, result) {
                layui.layer.close(load);
                $.each(result.districtList[0].districtList, function (key, value) {
                    let o = new Option(value.name, value.adcode);
                    $sheng.append(o);
                });
            });

            $sheng.on('change', function () {
                load = layer.load(1);
                selectOption = $(this).find(':selected');
                AmapsSearch.setLevel('province');
                $('#city').empty().append(new Option('请选择'));

                AmapsSearch.search(selectOption.val(), function (status, result) {
                    layui.layer.close(load);
                    $.each(result.districtList[0].districtList, function (key, value) {
                        o = new Option(value.name, value.adcode);
                        $('#city').append(o);
                    });
                });
            });
            $shi = $('#city');
            $shi.on('change', function(){
                $shi.siblings('[name=city_name]').val($(this).find(':selected').html());
            });

            $type = $('[name=type]');
            $type.on('change', function(){
                type = $(this).find(':selected').val();
                $mendian = $('.mendian');
                $return_store = $('.return_store');
                switch (type){
                    case '1':
                        //门店
                        $mendian.hide();
                        $return_store.show();
                        break;
                    case '2':
                        //提车点
                        $mendian.show();
                        $return_store.hide();
                        break;
                }
            })
        });
    });
});