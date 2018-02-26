<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>

</style>
<div class="modal fade bs-example-modal-lg" id="dispatch_modal" tabindex="-1" role="dialog"
     aria-labelledby="dispatch_modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                分配车辆
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="search">搜索</label>
                        <input type="text" class="form-control" id="search" placeholder="key:Enter" v-model="key" @keyup.prevent.enter="refresh">
                    </div>
                    <div class="form-group">
                        <button type="button" @click="refresh" class="btn btn-primary">搜索</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>车牌照</th>
                            <th>车辆型号</th>
                            <th>分配</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="car in cars" :key="cars.id">
                            <tr>
                                <td>
                                    <a href="#" class="btn btn-link">@{{ car.license_plate }}</a>
                                </td>
                                <td>@{{ car.car_patt_name.get_com_name.name }}@{{ car.car_patt_name.name }}</td>
                                <td>
                                    <button class="btn btn-link btn-xs" @click="dispatch(car)">分配</button>
                                </td>
                            </tr>
                        </template>
                        <template v-if="cars.length == 0">
                            <tr>
                                <td colspan="3">
                                    暂时没有数据
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="...">
                    <ul class="pager">
                        <li class="previous"><a href="#" @click="refresh(preurl)"  v-show="preurl"><span aria-hidden="true">&larr;</span> 上一页</a></li>
                        <li class="next"><a href="#" @click="refresh(nexturl)" v-show="nexturl">下一页 <span aria-hidden="true">&rarr;</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-dispatch-confirm" @click="test"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $img_modal_vue = new Vue({
        el: '#dispatch_modal',
        data: {
            order : {},
            cars:[],
            preurl:'#',
            nexturl:'#',
            key:''
        },
        methods: {
            test: function () {
                $.log(this.order)
            },
            refresh: function(url){
                $.load();
                vthis = this;
                defaultUrl = '/admin/getCarByStore';

                var data = {
                    store: vthis.order.store
                };

                if(this.key != ''){
                    data.key = this.key;
                }

                $.getData(defaultUrl, data, function(res){
                    $.close();
                    if(res.result.code == 1){
                        vthis.cars = res.cars.data;
                        vthis.preurl = res.cars.prev_page_url;
                        vthis.nexturl = res.cars.next_page_url;
                    }else{
                        $.alert(res.result.message || '请求失败');
                    }
                })
            },
            dispatch: function(car){
                var msg = '';
                if(car.car_patt != this.order.car_patt){
                    msg = '车型不符，您确定要把订单分配给此车辆吗？'
                }else{
                    msg = '您确定要把订单分配给此车辆吗？';
                }
                var vthis = this;
                $.confirm(msg, function(){
                    $.load();
                    url = '/admin/dispath';
                    $.postData(url, {
                        order:vthis.order.id,
                        car:car.id
                    }, function (res) {
                        $.close();
                        if(res.result.code == 1){
                            $.msg('分配成功');
                            $('#dispatch_modal').modal('hide');
                            vthis.order.car_patt = car.car_patt;
                            vthis.order.car_patt_name.get_com_name.name = car.car_patt_name.get_com_name.name;
                            vthis.order.car_patt_name.name = car.car_patt_name.name;
                            vthis.order.license_plate = car.license_plate;
                            vthis.order.status = 2;
                        }else{
                            $.alert(res.result.message);
                        }
                    }, function(){
                        $.close();
                        return true;//继续处理
                    });
                })
            }
        },
        created: function () {

        }
    });

    $('#dispatch_modal').on('shown.bs.modal', function (e) {
        order = e.relatedTarget.order;
        $img_modal_vue.order = order;
        $img_modal_vue.refresh();
    });
    $('#dispatch_modal').on('hide.bs.modal', function () {

    });


</script>