@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>价格列表</h3>
                </div>
                <div class="title_right">
                    {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                            {{--<span class="input-group-btn">--}}
                              {{--<button class="btn btn-default" type="button">Go!</button>--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <form action="{{ url('admin/price') }}" method="get" class="form-inline" id="search">
                            <div class="form-group">
                                <label for="city">城市:</label>
                                <select name="city" id="city" class="form-control">
                                    @foreach($citys as $city)
                                        <option value="{{$city->code}}" @if($city->code == $request->city) selected @endif>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="store">门店:</label>
                                <select name="store" id="store" class="form-control">
                                    <option value="">全部</option>
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}" @if($store->id == $request->store) selected @endif>{{$store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <button class="btn btn-primary form-control"> 搜索</button>
                            </div>
                        </form>
                        <div class="x_content">
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer" v-cloak>
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th width="35px">id</th>
                                            <th width="35px">门店</th>
                                            <th width="35px">车辆型号</th>
                                            <th width="35px">基础服务费</th>
                                            <th width="35px">服务费</th>
                                            <th width="35px">超小时费/每小时</th>
                                            <th width="35px">长公里费/每公里</th>
                                            <th width="35px">基础授权费</th>
                                            <th width="35px">违章押金</th>
                                            <th width="35px">异地还车费</th>
                                            <th width="35px">夜间取车费</th>
                                            <th width="35px">夜间还车费</th>
                                            <th width="35px">夜间开始时间</th>
                                            <th width="35px">夜间结束时间</th>
                                            <th width="35px">平台</th>
                                            <th width="35px">状态</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="v in list">
                                                <td>@{{ v.id }}</td>
                                                <td>@{{ v.get_store.name }}</td>
                                                <td>@{{ v.car_patt_name.name }}</td>
                                                <td>@{{ v.basic_service_fee }}</td>
                                                <td>@{{ v.service_fee }}</td>
                                                <td>@{{ v.ultra_hour_fee }}</td>
                                                <td>@{{ v.ultra_km_fee }}</td>
                                                <td>@{{ v.pre_authorization_fee }}</td>
                                                <td>@{{ v.Illegal_deposit }}</td>
                                                <td>@{{ v.off_site_fee }}</td>
                                                <td>@{{ v.night_give_fee }}</td>
                                                <td>@{{ v.night_return_fee }}</td>
                                                <td>@{{ v.night_start_time }}</td>
                                                <td>@{{ v.night_end_time }}</td>
                                                <td>@{{ v.platform_name.name }}</td>
                                                <td>@{{ status[v.status] }}</td>
                                                <td>
                                                    <a :href="'/admin/price/'+ v.id+'/edit'"
                                                       class="btn btn-info btn-xs">编辑</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! $list->appends($_GET)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addcss')


@endpush

@push('addjs')
<script src="https://cdn.bootcss.com/vue/2.5.13/vue.min.js"></script>
<script>
    var vm = new Vue({
        el:'#table',
        data:{
            list:{!! json_encode($list->all()) !!},
            status:{!! json_encode(\App\Model\Price::$status) !!}
        },
        methods:{

        }
    });
</script>
<script>
    $(function () {
        @foreach ($errors -> all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach
    });
</script>
<script src="{{ asset('/public/js/city.js') }}"></script>
@endpush