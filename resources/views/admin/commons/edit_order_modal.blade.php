<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="edit_order_modal" tabindex="-1" role="dialog"
     aria-labelledby="edit_order_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                修改订单
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <label for="edit_car_com_modal">车辆品牌：</label>
                                <select id="edit_car_com_modal" class="form-control" v-model="orderInfo.car_patt_name.get_com_name.id">
                                    @foreach($carComments as $com)
                                        <option value="{{ $com->id }}">{{$com->name}}</option>
                                    @endforeach
                                </select>
                                <label for="edit_car_patt_modal">车辆型号：</label>
                                <select id="edit_car_patt_modal" class="form-control" v-model="orderInfo.car_patt">
                                    @foreach($carPatts as $patt)
                                        <option value="{{ $patt->id }}">{{$patt->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_use_name_modal">客人姓名：</label>
                                <input type="text" name="use_name" id="edit_use_name_modal" class="form-control" :value="orderInfo.use_name ">
                            </div>
                            <div class="form-group">
                                <label for="edit_use_phone_modal">客人手机：</label>
                                <input type="text" name="edit_use_phone" id="edit_use_phone_modal" class="form-control" :value="orderInfo.use_phone">
                            </div>
                            <div class="form-group">
                                <label for="edit_card_type_modal">证件类型：</label>
                                <select id="edit_card_type_modal" class="form-control" v-model="orderInfo.card_type">
                                    @foreach($card_names as $card_type)
                                        <option value="{{ $card_type->id }}">{{ $card_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_car_id_modal">证件号：</label>
                                <input type="text" name="edit_car_id" id="edit_car_id_modal" class="form-control" :value="orderInfo.card_no">
                            </div>
                            <div class="form-group">
                                <label for="edit_paid">已付金额：</label>
                                <input type="number" name="edit_paid" id="edit_paid" class="form-control" :value="orderInfo.paid">
                            </div>
                            <div class="form-group">
                                <label for="edit_pickup_time_modal">取车时间：</label>
                                <input type="text" name="edit_pickup_time_modal" id="edit_pickup_time_modal" class="form-control" :value="orderInfo.pickup_time">
                            </div>
                            <div class="form-group">
                                <label for="edit_return_time_modal">还车时间：</label>
                                <input type="text" name="return_time" id="edit_return_time_modal" class="form-control" :value="orderInfo.return_time">
                            </div>

                            <div class="form-group">
                                <label for="edit_pickup_store_modal">取车门店：</label>
                                <select name="pickup_store" id="edit_pickup_store_modal" class="form-control" v-model="orderInfo.pickup_store">
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--stores--}}
                            <div class="form-group">
                                <label for="edit_return_store">还车门店：</label>
                                <select name="return_store" id="edit_return_store" class="form-control" v-model="orderInfo.return_store">
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" @click="update">修改</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $edit_order_modal_vue = new Vue({
        el: '#edit_order_modal',
        data: {
            order: {
                get_platform:{},
                car_patt_name:{
                    get_com_name:{
                        name:''
                    }
                }
            },
            orderInfo: {
                get_price: {},
                get_price_item: [],
                get_additional_aervice: [],
                get_platform:{},
                car_patt_name:{
                    get_com_name:{
                        name:''
                    }
                },
                get_pickup_store:{},
                get_return_store:{},
                card_name:{}
            }
        },
        computed: {

        },
        methods: {
            getNumber: function (num) {
                return isNaN(parseFloat(num)) ? 0 : parseFloat(num);
            },
            refresh: function () {
                $.load();
                vthis = this;
                var url = '/admin/orderInfo';
                $.getData(url, {
                    order: vthis.order.id
                }, function (res) {
                    $.close();
                    if (res.result.code == 1) {
                        vthis.orderInfo = res.order;
                    } else {
                        $.alert(res.result.message);
                    }
                }, function (res) {
                    $.close();
                    return true;
                })
            },
            update: function () {
                var data = {};
                data.car_patt = $('#edit_car_patt_modal').val();
                data.use_name = $('#edit_use_name_modal').val();
                data.use_phone = $('#edit_use_phone_modal').val();
                data.card_type = $('#edit_card_type_modal').val();
                data.card_id = $('#edit_car_id_modal').val();
                data.paid = $('#edit_paid').val();
                data.pickup_time = $('#edit_pickup_time_modal').val();
                data.return_time = $('#edit_return_time_modal').val();
                data.pickup_store = $('#edit_pickup_store_modal').val();
                data.return_store = $('#edit_return_store').val();
                data.order = this.orderInfo.id;
                vthis = this;
                $.postData('/admin/editOrder', data, function (res) {
                    if(res.result.code == 1){
                        $.alert('修改成功');
                        $('#edit_order_modal').modal('hide');
                        vthis.order = res.order;
                        for(var i=0, count = orderVue.orderList.length; i<count; ++i ){
                            if(orderVue.orderList[i].id == res.order.id){
                                orderVue.orderList.splice(i, 1, res.order);
                                break;
                            }
                        }
                    }else{
                        $.alert(res.result.message || '创建失败,有可能价格未设置，或者库存不足.请检查后再试');
                    }
                })
            }
        },
        created: function () {

        },
        mounted: function () {

        }
    });

    $('#edit_order_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $edit_order_modal_vue.order = order;
        $edit_order_modal_vue.refresh();
    });
    $('#edit_order_modal').on('hide.bs.modal', function () {

    });
    $(function () {
        layui.use('laydate', function () {
            var laydate = layui.laydate;
            laydate.render({
                elem: $('#edit_pickup_time_modal')[0],
                type: 'datetime',
                done: function (value) {
                    $edit_order_modal_vue.pickup_time = value;
                }
            });
            laydate.render({
                elem: $('#edit_return_time_modal')[0],
                type: 'datetime',
                done: function (value) {
                    $edit_order_modal_vue.return_time = value;
                }
            });
        });
        $('#edit_car_com_modal').on('change', function () {
            $.getData('/admin/car_pattSearchByCom', {com:$(this).val()}, function (res) {
                if(res.result.code == 1){
                    var emptyOption = new Option('请选择', '');
                    $(emptyOption).attr('selected', 'selected');
                    $(emptyOption).attr('disable', 'disable');
                    $('#edit_car_patt_modal').empty().append(emptyOption);
                    $.each(res.carPatts, function (k, v) {
                        var o = new Option(v.name, v.id);
                        $('#edit_car_patt_modal').append(o);
                    });
                }
            });
        });

        $('#edit_pickup_store_modal').on('change', function () {
            $.getData('/admin/searchReturnStore', {pickup_store:$(this).val()}, function (res) {
                if(res.result.code == 1){
                    var emptyOption = new Option('请选择', '');
                    $(emptyOption).attr('selected', 'selected');
                    $(emptyOption).attr('disable', 'disable');

                    $('#edit_return_store').empty().append(emptyOption);
                    $.each(res.list, function (k, v) {
                        var o = new Option(v.name, v.id);
                        $('#edit_return_store').append(o);
                    });
                }
            });
        });
    });

</script>