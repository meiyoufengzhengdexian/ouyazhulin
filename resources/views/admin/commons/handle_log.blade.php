<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="handle_log_modal" tabindex="-1" role="dialog"
     aria-labelledby="handle_log_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                处理日志
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="4" align="center" valign="middle">取车</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle" width="25%">牌照：</td>
                        <td width="25%">@{{ order.license_plate }}</td>
                        <td align="right" valign="middle" width="25%">车型：</td>
                        <td width="25%">@{{ orderInfo.car_patt_name ? orderInfo.car_patt_name.get_com_name.name + orderInfo.car_patt_name.name : '' }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">取车时间：</td>
                        <td>@{{ orderInfo.get_pickup_price ? orderInfo.get_pickup_price.pickup_time:'' }}</td>
                        <td align="right" valign="middle">Admin:</td>
                        <td>@{{ orderInfo.get_pickup_price? orderInfo.get_pickup_price.admin : '' }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">取车油量：</td>
                        <td>@{{ orderInfo.get_pickup_price? orderInfo.get_pickup_price.oil : 0 }}L</td>
                        <td align="right" valign="middle">取车里程：</td>
                        <td>@{{ orderInfo.get_pickup_price? orderInfo.get_pickup_price.km : 0 }}km</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">订单金额：</td>
                        <td>¥@{{ order.price }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">预授权：</td>
                        <td>¥@{{ orderInfo.get_price.pre_authorization_fee }}</td>
                        <td align="right" valign="middle">违章押金：</td>
                        <td>¥@{{ orderInfo.get_price.Illegal_deposit }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">其他费用：</td>
                        <td colspan="3">¥@{{ orderInfo.get_pickup_price? orderInfo.get_pickup_price.oth_fee : 0 }}</td>
                    </tr>
                    <tr>
                        <td  align="right" valign="middle">线上已支付：</td>
                        <td colspan="3">
                            ¥@{{ order.paid }}
                        </td>
                    </tr>
                    <tr>
                        <td  align="right" valign="middle">取车实收金额：</td>
                        <td colspan="3">
                            <span class="bg-blue">¥@{{ orderInfo.get_pickup_price? orderInfo.get_pickup_price.paid : 0 }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right" valign="middle">增值服务：</td>
                        <td colspan="3">
                            <template v-for="(add, index) in orderInfo.get_additional_aervice" :key="index">
                                <p v-if="item.price > 0">@{{ add.name }}：¥@{{ add.price }}</p>
                                <p v-if="item.price > 0">@{{ add.name }}：¥@{{ add.price }}</p>
                            </template>
                            <template v-if="orderInfo.get_additional_aervice.length == 0" )>
                                <p>无增值项</p>
                            </template>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">费用明细：</td>
                        <td colspan="3">
                            <template v-for="(item, key) in orderInfo.get_price_item">
                                <p v-if="item.price > 0">@{{ item.name }}：¥@{{ item.price }}</p>
                            </template>
                            <template v-if="orderInfo.get_price_item.length == 0">
                                <p>无费用项</p>
                            </template>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">备注：</td>
                        <td colspan="3">
                            <p>
                                @{{ orderInfo.get_pickup_price ? orderInfo.get_pickup_price.desc : ''  }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" style="padding:0; height: 20px;">

                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" valign="middle">还车</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">还车时间：</td>
                        <td>@{{ orderInfo.get_return_price ? orderInfo.get_return_price.return_time : '' }}</td>
                        <td align="right" valign="middle">Admin：</td>
                        <td>@{{  orderInfo.get_return_price ? orderInfo.get_return_price.admin : '' }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">油量差：</td>
                        <td>@{{ orderInfo.get_return_price ? orderInfo.get_return_price.diff_oil :0 }}L</td>
                        <td align="right" valign="middle">还车里程：</td>
                        <td>@{{ orderInfo.get_return_price ? orderInfo.get_return_price.return_km : 0 }}km</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">超公里数：</td>
                        <td>@{{ orderInfo.get_return_price ? orderInfo.get_return_price.ultra_km : 0 }}km</td>
                        <td align="right" valign="middle">超小时数：</td>
                        <td>@{{ orderInfo.get_return_price ? orderInfo.get_return_price.ultra_hour: 0 }}h</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">违章罚款：</td>
                        <td>¥@{{ orderInfo.get_return_price ? orderInfo.get_return_price.Illegal_deposit: 0 }}</td>
                        <td align="right" valign="middle">其他费用：</td>
                        <td>¥@{{ orderInfo.get_return_price ? orderInfo.get_return_price.oth_fee: 0 }}</td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">仍需支付：</td>
                        <td> <span class="bg-blue">¥@{{ orderInfo.get_return_price ? orderInfo.get_return_price.need_pay: 0 }}</span></td>
                        <td align="right" valign="middle"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="right" valign="middle">备注：</td>
                        <td colspan="3">
                            <p>
                                @{{ orderInfo.get_return_price ? orderInfo.get_return_price.desc: 0 }}
                            </p>
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
    $handle_log_modal_vue = new Vue({
        el: '#handle_log_modal',
        data: {
            oth_price: 0,
            paid: 0,
            km: 0,
            oil: 0,
            pickup_time: '',
            desc: '',
            order: {},
            orderInfo: {
                get_price: {},
                get_price_item: [],
                get_additional_aervice: []
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

    $('#handle_log_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $handle_log_modal_vue.order = order;
        $handle_log_modal_vue.refresh();
    });
    $('#handle_log_modal').on('hide.bs.modal', function () {

    });
    $(function () {
        layui.use('laydate', function () {
            var laydate = layui.laydate;
            laydate.render({
                elem: $('[name=pickup_time]')[0],
                type: 'datetime',
                done: function (value) {
                    $handle_log_modal_vue.pickup_time = value;
                }
            });
        });
    });

</script>