<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="handle_pickup_modal" tabindex="-1" role="dialog"
     aria-labelledby="handle_pickup_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                办理取车
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td align="right">实际取车时间：</td>
                        <td colspan="3">
                            <input name="pickup_time" type="text" @change="test"/></td>
                    </tr>
                    <tr>
                        <td align="right">取车油量：</td>
                        <td>
                            <input v-model="oil" type="text"/> 升
                        </td>
                        <td align="right">取车里程：</td>
                        <td><input v-model="km" type="text"/> km</td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>预授权(押金)：¥@{{ orderInfo.get_price.pre_authorization_fee }}</td>
                        <td>违章押金：¥@{{ orderInfo.get_price.Illegal_deposit }}</td>
                        <td>订单金额:¥@{{ orderInfo.price }}</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
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
                                        </template>
                                        <template v-if="orderInfo.get_additional_aervice.length == 0">
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
                        <td align="right">其他费用：</td>
                        <td colspan="3"><input type="number" v-model="oth_price"/></td>
                    </tr>
                    <tr>
                        <td align="right">取车备注：</td>
                        <td colspan="3"><textarea name="desc" v-model="desc" style="width: 100%"></textarea></td>
                    </tr>
                    <tr>
                        <td align="right">总金额:</td>
                        <td colspan="3">
                            <p style="font-size: 40px; color: #003333; line-height: 50px;">¥@{{ count }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="" align="right">
                            已支付金额:
                        </td>
                        <td>
                            <p style="font-size: 40px; color: #003333; line-height: 50px;">¥@{{ orderInfo.paid }}</p>
                        </td>
                        <td>
                            仍需支付：
                        </td>
                        <td>
                            <p style="font-size: 40px; color: #003333; line-height: 50px;">¥@{{ still_need }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">收到金额：</td>
                        <td colspan="3">
                            <input name="text2" autofocus="autofocus" type="number"
                                   v-model="paid"
                                               style="height: 80px; font-size: 50px; line-height: 80px;color:#cc3300"/>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-img-confirm" @click="pickup"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $handle_pickup_modal_vue = new Vue({
        el: '#handle_pickup_modal',
        data: {
            oth_price: 0,
            paid:0,
            km:0,
            oil:0,
            pickup_time:'',
            desc:'',
            order: {},
            orderInfo: {
                get_price: {},
                get_price_item: [],
                get_additional_aervice: []
            }
        },
        computed: {
            count: function(){
                return this.order.price +
                    this.orderInfo.get_price.pre_authorization_fee +
                    this.orderInfo.get_price.Illegal_deposit +
                    this.getNumber(this.oth_price)
            },
            still_need: function () {
                var count = 0;
                if (!this.orderInfo.get_price) {
                    return count;
                } else {
                    count += this.getNumber(this.orderInfo.get_price.pre_authorization_fee);
                    count += this.getNumber(this.orderInfo.get_price.Illegal_deposit);
                    count += this.getNumber(this.orderInfo.price);
                    count += this.getNumber(this.oth_price);
                    return count - this.getNumber(this.orderInfo.paid) - this.getNumber(this.paid);
                }
            }
        },
        methods: {
            test: function () {
                console.log('test');
            },
            getNumber: function (num) {
                return isNaN(parseFloat(num)) ? 0 : parseFloat(num);
            },
            pickup: function () {
                var data = {
                    pickup_time: $('[name=pickup_time]').val(),
                    order:this.order.id,
                    oil:this.oil,
                    km:this.km,
                    paid:this.paid,
                    oth_fee:this.oth_price,
                    desc:this.desc
                };
                var url = '/admin/pickupCar';
                $.load();
                vthis = this;
                $.postData(url, data, function (res) {
                    $.close();
                    if(res.result.code == 1){
                        $.alert('取车完成');
                        vthis.order.status = 3;
                        $('#handle_pickup_modal').modal('hide');

                    }
                }, function () {
                    $.close();
                    return true;
                })
            },
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
                }, function (res) {
                    $.close();
                    if (res.status == 422) {
                        str = "";
                        $.each(res.responseJSON, function (k, v) {
                            str += v + ",";
                            if(v == '此订单已完成' || v == '请先分配车辆'){
                                $('#handle_pickup_modal').modal('hide');
                            }
                        });
                    }
                    return true;
                })
            }
        },
        created: function () {

        },
        mounted: function () {

        }
    });

    $('#handle_pickup_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $handle_pickup_modal_vue.order = order;
        $handle_pickup_modal_vue.refresh();
    });
    $('#handle_pickup_modal').on('hide.bs.modal', function () {

    });
    $(function () {
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: $('[name=pickup_time]')[0],
                type:'datetime',
                done: function(value){
                    $handle_pickup_modal_vue.pickup_time = value;
                }
            });
        });
    });

</script>