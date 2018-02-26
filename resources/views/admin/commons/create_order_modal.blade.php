<!-- Modal -->
<div class="modal fade" id="create-order-modal" tabindex="-1" role="dialog" aria-labelledby="create-order-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">新增订单</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-inline">
                            <label for="car_com_modal">车辆品牌：</label>
                            <select id="car_com_modal" class="form-control">
                                @foreach($carComments as $com)
                                    <option value="{{ $com->id }}">{{$com->name}}</option>
                                @endforeach
                            </select>
                            <label for="car_patt_modal">车辆型号：</label>
                            <select id="car_patt_modal" class="form-control">
                                @foreach($carPatts as $patt)
                                    <option value="{{ $patt->id }}">{{$patt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="use_name_modal">客人姓名：</label>
                            <input type="text" name="use_name" id="use_name_modal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="use_phone_modal">客人手机：</label>
                            <input type="text" name="use_phone" id="use_phone_modal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="card_type_modal">证件类型：</label>
                            <select id="card_type_modal" class="form-control">
                                @foreach($card_names as $card_type)
                                    <option value="{{ $card_type->id }}">{{ $card_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="car_id_modal">证件号：</label>
                            <input type="text" name="car_id" id="car_id_modal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="return_time_modal">取车时间：</label>
                            <input type="text" name="pickup_time" id="pickup_time_modal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="car_id_modal">还车时间：</label>
                            <input type="text" name="return_time" id="return_time_modal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="pickup_store_modal">取车门店：</label>
                            <select name="pickup_store" id="pickup_store_modal" class="form-control">
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--stores--}}
                        <div class="form-group">
                            <label for="return_store">还车门店：</label>
                            <select name="return_store" id="return_store" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary create-order-btn">保存修改</button>
            </div>
        </div>

    </div>
</div>
<script>
    $(function(){
        $('#car_com_modal').on('change', function () {
            $.getData('/admin/car_pattSearchByCom', {com:$(this).val()}, function (res) {
                if(res.result.code == 1){
                    var emptyOption = new Option('请选择', '');
                    $(emptyOption).attr('selected', 'selected');
                    $(emptyOption).attr('disable', 'disable');
                    $('#car_patt_modal').empty().append(emptyOption);
                    $.each(res.carPatts, function (k, v) {
                        var o = new Option(v.name, v.id);
                        $('#car_patt_modal').append(o);
                    });
                }
            });
        });
        //pickup_store_modal
        $('#pickup_store_modal').on('change', function () {
            $.getData('/admin/searchReturnStore', {pickup_store:$(this).val()}, function (res) {
                if(res.result.code == 1){
                    var emptyOption = new Option('请选择', '');
                    $(emptyOption).attr('selected', 'selected');
                    $(emptyOption).attr('disable', 'disable');

                    $('#return_store').empty().append(emptyOption);
                    $.each(res.list, function (k, v) {
                        var o = new Option(v.name, v.id);
                        $('#return_store').append(o);
                    });
                }
            });
        });

        $.datetime($('#pickup_time_modal')[0]);
        $.datetime($('#return_time_modal')[0]);

        $('.create-order-btn').on('click', function () {
            var data = {};
            data.use_name = $('#use_name_modal').val();
            data.use_phone = $('#use_phone_modal').val();
            data.car_patt = $('#car_patt_modal').val();
            data.card_type = $('#card_type_modal').val();
            data.card_id = $('#car_id_modal').val();
            data.pickup_time = $('#pickup_time_modal').val();
            data.return_time = $('#return_time_modal').val();
            data.pickup_store = $('#pickup_store_modal').val();
            data.return_store = $('#return_store').val();

            $.postData('/admin/createOrder', data, function (res) {
                if(res.result.code == 1){
                    $.alert('创建成功');
                    $('#create-order-modal').modal('hide');
                    orderVue.orderList.unshift(res.order);
                }else{
                    $.alert(res.result.message || '创建失败,有可能价格未设置，或者库存不足.请检查后再试');
                }
            })
        });

    });

</script>