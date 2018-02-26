<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>

<div class="modal fade bs-example-modal-lg" id="city-modal" tabindex="-1" role="dialog"
     aria-labelledby="city-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">修改城市</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">城市</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <select id="sheng" class="form-control">
                                        <option value="">请选择</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <select class="form-control city-modal-select">
                                        <option value="">请选择</option>
                                    </select>
                                    <input type="hidden" name="_city_name">
                                    <input type="hidden" name="_city_id">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-city-confirm"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $city_modal_vue = new Vue({
        el: '#city-modal',
        data: {
            city_name_dom: {},
            city_id_dom: {}

        },
        methods: {
            refresh: function () {
                $.load();
                vthis = this;
                AMap.service('AMap.DistrictSearch', function () {
                    AmapsSearch = new AMap.DistrictSearch({
                        level: 'province',
                        subdistrict: '1',
                        extensions: 'base',
                        showbiz: false
                    });

                    $sheng = $('#sheng');
                    $shi = $('.city-modal-select');

                    AmapsSearch.search('中国', function (status, result) {
                        $.close(0);
                        $.each(result.districtList[0].districtList, function (key, value) {
                            var o = new Option(value.name, value.adcode);
                            $sheng.append(o);
                        });
                    });




                    $sheng.on('change', function () {
                        load = layer.load(1);
                        selectOption = $(this).find(':selected');
                        AmapsSearch.setLevel('province');

                        $shi.empty().append(new Option('请选择'));

                        AmapsSearch.search(selectOption.val(), function (status, result) {
                            layui.layer.close(load);
                            $.each(result.districtList[0].districtList, function (key, value) {
                                o = new Option(value.name, value.adcode);
                                $('.city-modal-select').append(o);
                            });
                        });
                    });

                    $shi.on('change', function () {
                        $shi.siblings('[name=_city_name]').val($(this).find(':selected').html());
                        $shi.siblings('[name=_city_id]').val($(this).find(':selected').val());
                    });

                });

            },
            created: function () {

            }
        }
    });

    $('#city-modal').on('shown.bs.modal', function (e) {

        $city_modal_vue.refresh();
        $city_modal_vue.city_name_dom = e.relatedTarget.city_name_dom;
        $city_modal_vue.city_id_dom = e.relatedTarget.city_id_dom;
        $city_modal_vue.city_show = e.relatedTarget.city_show;
    });
    $('#city-modal').on('hide.bs.modal', function () {

    });

    $('.model-city-confirm').on('click', function () {
        console.log($('[name=_city_id]').val());
        if ($('[name=_city_name]').val() == '' || $('[name=_city_id]').val() == '') {
            $.alert('请重新选择城市');
            return;
        }

        $('#city-modal').modal('hide');
        $($city_modal_vue.city_name_dom).val($('[name=_city_name]').val());
        $($city_modal_vue.city_id_dom).val($('[name=_city_id]').val());
        $($city_modal_vue.city_show .html($('[name=_city_name]').val()));


    });

</script>