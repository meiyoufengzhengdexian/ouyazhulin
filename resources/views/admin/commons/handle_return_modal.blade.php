<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="handle_return_modal" tabindex="-1" role="dialog"
     aria-labelledby="handle_return_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                办理还车
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td  align="right">租车时间：</td>
                        <td colspan="4">@{{ orderInfo.day }}天</td>
                    </tr>
                    <tr>
                        <td align="right">取车时间：</td>
                        <td>@{{ orderInfo.get_pickup_price.pickup_time }}</td>
                        <td align="right">还车时间</td>
                        <td>
                            <input name="return_time" type="text" v-model="return_time"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">取车油量</td>
                        <td>@{{ orderInfo.get_pickup_price.oil }}L</td>
                        <td align="right">还车油量：</td>
                        <td><input name="return_time2" type="number" v-model="return_oli"/>
                            升
                        </td>
                    </tr>

                    <tr>
                        <td align="right">取车里程</td>
                        <td>
                            @{{ orderInfo.get_pickup_price.km }}km
                        </td>
                        <td align="right">还车里程：</td>
                        <td><input type="number" v-model="return_km"/> km</td>
                    </tr>
                    <tr>
                        <td align="right">油量差：</td>
                        <td>@{{ diff_oil }}L</td>
                        <td align="right">油价：</td>
                        <td>¥ <input type="number" v-model="oil_price"> L</td>
                    </tr>
                    <tr>
                        <td>超公里数: <input type="number" v-model="real_ultra_km">km</td>
                        <td>超时: <input type="number" v-model="real_ultra_h">小时</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4">超公里费用：¥@{{ orderInfo.get_price.ultra_km_fee }}/km ×
                            @{{ real_ultra_km }} = <code>@{{ ultra_km_price }}</code>
                            超小时费用¥@{{ orderInfo.get_price.ultra_hour_fee }}/h × @{{ real_ultra_h }}
                            = <code>@{{ ultra_h_price }}</code> 油价每升 @{{ oil_price }} * @{{ diff_oil }}
                            = <code> @{{ diff_oil_price }}</code></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table table-bordered">
                                <tr>
                                    <td>增值服务：</td>
                                </tr>
                                <tr>
                                    <td>
                                        <template v-for="(add, index) in orderInfo.get_additional_aervice" :key="index">
                                            <p v-if="item.price > 0">@{{ add.name }}：¥@{{ add.price }}</p>
                                            <p v-if="item.price > 0">@{{ add.name }}：¥@{{ add.price }}</p>
                                        </template>
                                        <template v-if="orderInfo.get_additional_aervice.length == 0" )>
                                            <p>无增值项</p>
                                        </template>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <td>费用明细：</td>
                                </tr>
                                <tr>
                                    <td>
                                        <template v-for="(item, key) in orderInfo.get_price_item">
                                            <p v-if="item.price > 0">@{{ item.name }}：¥@{{ item.price }}</p>
                                        </template>
                                        <template v-if="orderInfo.get_price_item.length == 0">
                                            <p>无费用项</p>
                                        </template>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>预授权(押金)：¥@{{ orderInfo.get_price.pre_authorization_fee }}</td>
                        <td>违章押金：¥@{{ orderInfo.get_price.Illegal_deposit }}</td>
                        <td colspan="2">订单金额:¥@{{ orderInfo.price }}</td>
                    </tr>

                    <tr>
                        <td align="right">违章罚款：</td>
                        <td colspan="3"><input type="number" value="" v-model="Illegal_deposit"/></td>
                    </tr>
                    <tr>
                        <td align="right">其他费用：</td>
                        <td colspan="3">
                            <input type="number" value="10" v-model="orderInfo.get_pickup_price.oth_fee"/>
                            <span>@{{ orderInfo.get_pickup_price.desc }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">总计：</td>
                        <td colspan="4">
                            ¥@{{ orderInfo.get_price.pre_authorization_fee +
                            orderInfo.get_price.Illegal_deposit +orderInfo.price +  getNumber(orderInfo.get_pickup_price.oth_fee)}}
                        </td>
                    </tr>
                    <tr>
                        <td align="right">取车备注：</td>
                        <td colspan="3"><textarea name="desc" style="width: 100%" v-model="desc"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="">
                            已支付金额:
                        </td>
                        <td>
                            <p style="font-size: 40px; color: #003333; line-height: 50px;">@{{ order.paid + orderInfo.get_pickup_price.paid }}</p>
                        </td>
                        <td>
                            仍需支付：
                        </td>
                        <td>
                            <p style="font-size: 40px; color: #003333; line-height: 50px;">@{{ need_fee }}</p></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-img-confirm" @click="handle_return"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="{{ asset("public/vendors/DateJS/build/production/date.min.js") }}"></script>
<script src="{{ asset("public/vendors/DateJS/build/production/date-zh-CN.min.js") }}"></script>
<script>
    $handle_return_modal_vue = new Vue({
        el: '#handle_return_modal',
        data: {
            real_ultra_h: 0,
            real_ultra_km: 0,
            order: {},
            orderInfo: {
                get_price: {},
                get_price_item: [],
                get_additional_aervice: [],
                get_pickup_price: {}
            },
            return_time: null,
            return_oli: 0,
            return_km: 0,
            oil_price: 7.3,
            desc: '',
            Illegal_deposit: 0
        },
        watch: {
            ultra_h: function (value) {
                this.real_ultra_h = value;
            },
            ultra_km: function (value) {
                this.real_ultra_km = value;
            }
        },
        computed: {
            ultra_km: function () {
                ultra_km =
                    this.getNumber(this.return_km) -
                    (this.orderInfo.get_pickup_price.km + this.orderInfo.dayKm * this.orderInfo.day);
                return ultra_km < 0 ? 0 : ultra_km;
            },
            ultra_h: function () {
                if(this.return_time){
                    diff_timestamp = Date.strtotime(this.return_time) - this.return_timestamp;
                    diff_timestamp = diff_timestamp < 0 ? 0 : diff_timestamp;
                    return (diff_timestamp / 3600).toFixed(2);
                }else {
                    return null;
                }

            },
            ultra_h_price: function () {
                return (this.real_ultra_h * this.orderInfo.get_price.ultra_hour_fee).toFixed(2);
            },
            ultra_km_price: function () {
                return (this.real_ultra_km * this.orderInfo.get_price.ultra_km_fee).toFixed(2);
            },
            diff_oil: function () {
                return this.getNumber(this.orderInfo.get_pickup_price.oil) - this.getNumber(this.return_oli);
            },
            diff_oil_price: function () {
                return (this.diff_oil * this.getNumber(this.oil_price)).toFixed(2);
            },
            pickup_timestamp: function () {
                if (this.order.pickup_time) {
                    return Date.strtotime(this.order.pickup_time)
                } else {
                    return 0;
                }

            },
            return_timestamp: function () {
                if (this.order.return_time) {
                    return Date.strtotime(this.order.return_time)
                } else {
                    return 0;
                }
            },
            need_fee: function () {
                need =
                    this.order.price +
                    this.getNumber(this.orderInfo.get_pickup_price.oth_fee) +
                    this.getNumber(this.ultra_h_price) +
                    this.getNumber(this.ultra_km_price) +
                    this.getNumber(this.diff_oil_price) +
                    this.getNumber(this.orderInfo.get_price.pre_authorization_fee) +
                    this.getNumber(this.orderInfo.get_price.Illegal_deposit) +
                    this.getNumber(this.Illegal_deposit);
                yizhifu = this.getNumber(this.order.paid) +
                    this.orderInfo.get_pickup_price.paid;
                return (need - yizhifu - this.orderInfo.get_price.pre_authorization_fee - this.orderInfo.get_price.Illegal_deposit).toFixed(2);
            }

        },
        methods: {
            refresh: function () {
                $.load();
                vthis = this;
                var url = '/admin/orderPickupInfo';
                $.getData(url, {
                    order: vthis.order.id
                }, function (res) {
                    $.close();
                    if (res.result.code == 1) {
                        vthis.orderInfo = res.order;
                    } else {
                        $.alert(res.result.message);
                    }
                }, function () {
                    $.close();
                    return true;
                })
            },
            handle_return: function () {
                var url = '/admin/returnCar';
                var vthis = this;
                $.confirm('您确定要还车操作？', function () {
                    $.load();
                    var data = {
                        order:vthis.order.id,
                        ultra_km: vthis.real_ultra_km,
                        return_km:vthis.return_km,
                        ultra_hour:vthis.real_ultra_h,
                        diff_oil: vthis.diff_oil,
                        return_time: vthis.return_time,
                        ultra_km_fee: vthis.orderInfo.get_price.ultra_km_fee,
                        ultra_hour_fee: vthis.orderInfo.get_price.ultra_hour_fee,
                        oil_fee : vthis.oil_price,
                        oth_fee : vthis.orderInfo.get_pickup_price.oth_fee,
                        Illegal_deposit: vthis.Illegal_deposit,
                        paid: vthis.order.paid + vthis.orderInfo.get_pickup_price.paid,
                        need_pay: vthis.need_fee,
                        desc: vthis.desc
                    };
                    $.postData(url, data, function (res) {
                        $.close();
                        if (res.result.code == 1) {
                            $.msg('完成还车');
                            $('#handle_return_modal').modal('hide');
                            vthis.order.status = 666;
                        } else {
                            $.alert(res.result.message);
                        }
                    }, function () {
                        $.close();
                        return true
                    });
                });

            },

            getInt: function (num) {
                return isNaN(parseInt(num)) ? 0 : parseInt(num);
            },
            getNumber: function (num) {
                return isNaN(parseFloat(num)) ? 0 : parseFloat(num);
            }
        },
        created: function () {

        },
        mounted: function () {

        }
    });

    $('#handle_return_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $handle_return_modal_vue.order = order;
        $handle_return_modal_vue.refresh();
    });
    $('#handle_return_modal').on('hide.bs.modal', function () {

    });
    $(function () {
        layui.use('laydate', function () {
            var laydate = layui.laydate;
            laydate.render({
                elem: $('[name=return_time]')[0],
                type: 'datetime',
                done: function (value) {
                    $handle_return_modal_vue.return_time = value;
                }
            });
        });
    });

</script>