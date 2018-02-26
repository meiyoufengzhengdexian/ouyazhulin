@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>订单列表</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            @if(!\App\Model\Admin::getAdmin()->is_supper_admin)
                                <button class="btn btn-primary" id="create_order" type="button">新增订单</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <form action="{{ url('admin/order') }}" method="get" class="form-inline" id="search">
                                <div class="form-group ">
                                    <label for="key">关键词:</label>
                                    <input type="text" class="form-control" name="key"
                                           value="{{ $request->input('key')}}" id="key"
                                           placeholder="">
                                </div>
                                <div class="form-group ">
                                    <label for="start_time">创建日期开始:</label>
                                    <input class="form-control time" type="text" name="start_time"
                                           value="{{ $request->input('start_time') }}" id="start_time">
                                </div>
                                <div class="form-group">
                                    <label for="end_time">创建日期结束:</label>
                                    <input class="form-control time" type="text" name="end_time"
                                           value="{{ $request->input('end_time') }}" id="end_time">
                                </div>
                                <div class="form-group ">
                                    <label for="use_start_time time">取车时间起始:</label>
                                    <input class="form-control time" type="text" name="use_start_time"
                                           id="use_start_time" value="{{ $request->input('use_start_time') }}">
                                </div>
                                <div class="form-group">
                                    <label for="use_end_time ">取车时间结束:</label>
                                    <input class="form-control time" type="text" name="use_end_time" id="use_end_time"
                                           value="{{ $request->input('use_end_time')  }}">
                                </div>
                                <hr>
                                <div class="form-group ">
                                    <label for="status">订单状态:</label>
                                    <label class="radio-inline">
                                        <input type="radio" id="" name="status" value="" checked> 全部
                                    </label>
                                    @foreach(\App\Model\Order::$status as $key=>$status)
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="{{$key}}"
                                                   @if($request->status == $key) checked @endif> {{$status}}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="form-group" style="margin-left:50px">
                                    <label for="platform">来源:</label>
                                    <select name="platform" id="platform" class="form-control">
                                        <option value="">请选择</option>
                                        @foreach($platforms as $platform)
                                            <option value="{{$platform->id}}" @if($platform->id == $request->platform) selected @endif>{{$platform->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if(session('admin')->is_supper_admin)
                                    <div class="form-group" style="margin-left:50px">
                                        <label for="city">城市:</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="">请选择</option>
                                            @foreach($citys as $city)
                                                <option value="{{$city->code}}" @if($city->code == $request->city) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="store">门店:</label>
                                    <select name="store" id="store" class="form-control">
                                        <option value="">全部</option>
                                        @foreach($stores as $store)
                                            <option value="{{$store->id}}" @if($store->id == $request->store) selected @endif>{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <button type="submit" form="search" class="form-control btn btn-primary">搜索</button>
                                    <button type="button" form="search" class="form-control btn btn-primary down"
                                            name="excel" value="1">下载
                                    </button>
                                </div>
                                <hr>
                            </form>
                            <hr>
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer " v-cloak>
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th width="35px">id</th>
                                            <th width="35px">
                                                <table>
                                                    <tr>
                                                        <td>平台</td>
                                                    </tr>
                                                    <tr>
                                                        <td>订单号</td>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th width="35px">车辆型号</th>
                                            <th width="35px">车辆牌照</th>
                                            <th width="35px">门店</th>
                                            <th width="35px">城市</th>
                                            <th width="35px">
                                                <table>
                                                    <tr>
                                                        <td>取车门店</td>
                                                    </tr>
                                                    <tr>
                                                        <td>还车门店</td>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th width="35px">
                                                <table>
                                                    <tr>
                                                        <td>用户姓名</td>
                                                    </tr>

                                                    <tr>
                                                        <td>用户手机</td>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th width="35px">用车时间</th>
                                            <th width="35px">订单价格</th>
                                            <th width="35px">订单状态</th>
                                            <th width="35px">
                                                <table>
                                                    <tr>
                                                        <td>创建时间</td>
                                                    </tr>
                                                </table>
                                                </th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(order , key) in orderList">
                                            <td>
                                                <span :class="['status-color','status-' + order.status]"></span>
                                                @{{ order.id }}
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>@{{ order.get_platform.name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: url(/public/images/line.png); height: 20px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@{{ order.oth_order_id }}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <td>
                                                <span class="bg-blue">@{{ order.car_patt_name.get_com_name.name }}@{{ order.car_patt_name.name }}</span>
                                            </td>
                                            <td>@{{ order.license_plate }}</td>
                                            <td>@{{ order.get_store.name}}</td>
                                            <td>@{{ order.get_city_by_code.name }}</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>@{{ order.get_pickup_store.name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: url(/public/images/line.png); height: 20px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@{{ order.get_return_store.name}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @{{ order.use_name }}
                                                            <div class="label label-danger pull-right" v-for="tag in order.get_tag">@{{ tag.name }}</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: url(/public/images/line.png); height: 20px;">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@{{ order.use_phone }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td><span class="bg-warning">@{{ order.pickup_time }}</span></td>
                                                    <tr>
                                                        <td><span class="bg-success">@{{ order.return_time }}</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <code>¥@{{ order.price }}</code>
                                            </td>
                                            <td>@{{ orderStatus[order.status] }}</td>
                                            <td>
                                                @{{ order.created_at }}
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td class="button-td">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-warning dropdown-toggle btn-xs"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    处理订单 <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#" @click="dispatch(order)">分配车辆</a>
                                                                    </li>
                                                                    <li><a href="#"
                                                                           @click="handle_pickup(order)">办理取车</a></li>
                                                                    <li><a href="#"
                                                                           @click="handle_return(order)">办理还车</a></li>
                                                                    <li><a href="#"
                                                                           @click="handle_cancel(order)">取消订单</a></li>
                                                                </ul>
                                                            </div>
                                                            <div style="height: 5px;"></div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-info dropdown-toggle btn-xs"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    详细信息
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="#" @click="order_info(order)">详细信息</a>
                                                                        <a href="#" @click="edit_order(order)">修改订单信息</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td  class="button-td">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-info dropdown-toggle btn-xs"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    订单日志 <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#" @click="order_log(order)">订单日志</a>
                                                                    </li>
                                                                    <li><a href="#" @click="handle_log(order)">处理日志</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div style="height: 5px;"></div>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-xs"
                                                                    @click="index_desc(order)">订单备注
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {!! $list->appends($_GET)->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.commons.handle_pickup_modal')
    @include('admin.commons.dispatch_modal')
    @include('admin.commons.order_desc_modal')
    @include('admin.commons.handle_return_modal')
    @include('admin.commons.handle_log')
    @include('admin.commons.order_info_modal')
    @include('admin.commons.order_log_modal')
    @include('admin.commons.create_order_modal')
    @include('admin.commons.edit_order_modal')
@endsection

@push('addcss')
<style>
    .status-color {
        display: inline-block;
        height: 10px;
        width: 10px;
        border-radius: 2px;
    }

    .status-2 {
        border: 1px solid #2a3f54;
        background: #fcff00;
    }

    .status--1 {
        border: 1px solid #2a3f54;
        background: #FF0000;
    }

    .status-1 {
        border: 1px solid #2a3f54;
        background: #33cc33;
    }

    .status-3 {
        border: 1px solid #2a3f54;
        background: #000033;
    }

    .status-666 {
        border: 1px solid #2a3f54;
        background: #FFF;
    }
    .button-td{
        padding-right:20px;
    }

</style>
@endpush
@push('addjs')
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://cdn.bootcss.com/xlsx/0.11.18/xlsx.full.min.js"></script>

<!-- FileSaver.js is the library of choice for Chrome -->
<script src="https://cdn.bootcss.com/FileSaver.js/2014-11-29/FileSaver.min.js"></script>

<!-- FileSaver doesn't work in older IE and newer Safari; Downloadify is the flash fallback -->
<script src="https://cdn.bootcss.com/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="/public/js/downloadify.min.js"></script>
<script src="https://cdn.bootcss.com/Base64/1.0.1/base64.min.js"></script>


{{--<script src="{{ asset("public/js/countdown.min.js") }}"></script>--}}
<!-- vue start -->
<script>
    $(function () {
        $('#create_order').on('click', function () {
            $('#create-order-modal').modal('show');
        });
    });
</script>
<script>
    $(function () {
        //datetime 选择器初始化
        $.date($('[name=start_time]')[0]);
        $.date($('[name=end_time]')[0]);
        $.date($('[name=use_start_time]')[0]);
        $.date($('[name=use_end_time]')[0]);

        $('#city').on('change', function () {
            var cityCode = $(this).find(':selected').val();
            $.load();
            $.load(cityCode);
            $.getData('/admin/storeByCityCode', {
                code: cityCode
            }, function (res) {
                $.close();
                if (res.result.code == 1) {
                    $('#store').empty().append(new Option('全部'));
                    $.each(res.stores, function (key, value) {
                        var nowOption = new Option(value.name, value.id);
                        $('#store').append(nowOption);
                    });
                } else {
                    $.alert(res.result.message || '请求失败');
                }
            });
        });
    });
    var orderVue = new Vue({
        el: '#table',
        data: {
            orderList:{!! json_encode($list->all()) !!},
            orderStatus:{!! json_encode(\App\Model\Order::$status) !!}
        },
        methods: {
            handle_pickup: function (order) {
                $('#handle_pickup_modal').modal('show', {order: order});
            },
            dispatch: function (order) {
                $('#dispatch_modal').modal('show', {order: order});
            },
            index_desc: function (order) {
                $('#order-desc-modal').modal('show', {order: order});
            },
            handle_return: function (order) {
                $('#handle_return_modal').modal('show', {order: order});
            },
            handle_log: function (order) {
                $('#handle_log_modal').modal('show', {order: order});
            },
            handle_cancel: function (order) {
                vthis = this;
                $.confirm('确定要取消该订单吗？', function () {
                    var data = {};
                    data.order = order.id;
                    $.postData('/admin/cancelOrder', data, function (res) {
                        if(res.result.code == 1){
                            $.msg('取消成功');
                            for(var i=0, count = orderVue.orderList.length; i<count; ++i ){
                                if(orderVue.orderList[i].id == res.order.id){
                                    orderVue.orderList.splice(i, 1, res.order);
                                    break;
                                }
                            }
                        }
                    })
                })
            },
            order_info: function (order) {
                $('#order_info_modal').modal('show', {order: order});
            },
            edit_order: function (order) {
                $('#edit_order_modal').modal('show', {order: order});
            },
            order_log: function (order) {
                $('#order_log_modal').modal('show', {order: order});
            }
        },
        created: function () {

        }
    });
</script>
<!-- vue end -->
<script>
    $('.handle_pickup').on('click', function () {

    });

    $('.down').on('click', function () {
        var data = {};
        data.key = $('#key').val();
        data.start_time = $('#start_time').val();
        data.end_time = $('#end_time').val();
        data.use_start_time = $('#use_start_time').val();
        data.use_end_time = $('#use_end_time').val();
        data.status = $('[name=status]:checked').val();
        data.city = $('#city').val();
        data.store = $('#store').val();
        data.platform = $('#platform').val();

        $.getData('/admin/order', data, function(res){
            var ws_data = [
                [ "id", "平台", "订单号", "车辆型号", "车辆牌照", "门店", "城市", '取车门店', '还车门店', '用户姓名','用户手机','取车时间','还车时间','订单价格','订单状态','创建时间' ],
            ];

            $.each(res.list, function(k, v){
                var temp = [];
                temp.push(v.id);
                temp.push(v.get_platform.name);
                temp.push(v.oth_order_id);
                temp.push(v.car_patt_name.get_com_name.name + v.car_patt_name.name);
                temp.push(v.license_plate);
                temp.push(v.get_store.name);
                temp.push(v.get_city_by_code.name);
                temp.push(v.get_pickup_store.name);
                temp.push(v.get_return_store.name);
                temp.push(v.use_name);
                temp.push(v.use_phone);
                temp.push(v.pickup_time);
                temp.push(v.return_time);
                temp.push(v.price);
                temp.push(orderVue.orderStatus[v.status]);
                temp.push(v.created_at);
                ws_data.push(temp);
            });

            wb = new XLSX.utils.book_new();
            var new_ws_name = "欧亚出行";

            $.log(ws_data);
            var ws = XLSX.utils.aoa_to_sheet(ws_data);
            wb.SheetNames.push(new_ws_name);
            wb.Sheets[new_ws_name] = ws;
            var wopts = { bookType:'xlsx', bookSST:false, type:'array' };
            var wbout = XLSX.write(wb,wopts);
            saveAs(new Blob([wbout],{type:"application/octet-stream"}), "欧亚出行订单"+Math.random()+".xlsx");
        });
    });
</script>
@endpush