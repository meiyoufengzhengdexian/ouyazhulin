<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="order_info_modal" tabindex="-1" role="dialog"
     aria-labelledby="order_info_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                订单详情
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="25%" align="right" valign="middle">欧亚id：</td>
                        <td width="25%">@{{ order.id }}</td>
                        <td width="25%" align="right" valign="middle">第三方id：</td>
                        <td width="25%">@{{ order.oth_order_id }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">来源：</td>
                        <td>@{{ order.get_platform.name }}</td>
                        <td align="right" valign="middle">创建时间：</td>
                        <td>@{{ order.created_at }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">价格：</td>
                        <td colspan="3">¥@{{ order.price }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">支付方式：</td>
                        <td>@{{ order.pay_method }}</td>
                        <td align="right" valign="middle">已支付：</td>
                        <td>¥@{{ order.paid }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td align="right" valign="middle">车型：</td>--}}
                        {{--<td>@{{ orderInfo.car_patt_name.get_com_name + orderInfo.car_patt_name.name }}</td>--}}
                        {{--<td align="right" valign="middle">所属门店：</td>--}}
                        {{--<td>@{{ orderInfo.get_store.name }}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td align="right" valign="middle">取车门店：</td>
                        <td>@{{ orderInfo.get_pickup_store.name }}</td>
                        <td align="right" valign="middle">还车门店：</td>
                        <td>@{{ orderInfo.get_return_store.name }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">开始时间：</td>
                        <td>@{{ order.pickup_time }}</td>
                        <td align="right" valign="middle">结束时间：</td>
                        <td>@{{ order.return_time }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">天数：</td>
                        <td colspan="3">@{{ orderInfo.day }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">用车人：</td>
                        <td>@{{ order.use_name }}</td>
                        <td align="right" valign="middle">联系方式：</td>
                        <td>@{{ order.use_phone }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">证件类型：</td>
                        <td>@{{ orderInfo.card_name.name }}</td>
                        <td align="right" valign="middle">证件编号：</td>
                        <td>@{{ orderInfo.card_no }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">取消时间：</td>
                        <td>@{{ order.cancel_time ? order.cancel_time : '未取消' }}</td>
                        <td align="right" valign="middle">取消金额：</td>
                        <td>¥@{{ order.cancel_time ? order.cancel_price : 0 }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">订单状态：</td>
                        <td colspan="3">@{{ orderInfo.status }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">订单备注：</td>
                        <td colspan="3">
                            @{{ order.desc }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $order_info_modal_vue = new Vue({
        el: '#order_info_modal',
        data: {
            oth_price: 0,
            paid: 0,
            km: 0,
            oil: 0,
            pickup_time: '',
            desc: '',
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
            }
        },
        created: function () {

        },
        mounted: function () {

        }
    });

    $('#order_info_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $order_info_modal_vue.order = order;
        $order_info_modal_vue.refresh();
    });
    $('#order_info_modal').on('hide.bs.modal', function () {

    });
    $(function () {
        layui.use('laydate', function () {
            var laydate = layui.laydate;
            laydate.render({
                elem: $('[name=pickup_time]')[0],
                type: 'datetime',
                done: function (value) {
                    $order_info_modal_vue.pickup_time = value;
                }
            });
        });
    });

</script>