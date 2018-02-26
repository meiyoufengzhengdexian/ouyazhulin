@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>仓库列表</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                            <span class="input-group-btn">
                              {{--<button class="btn btn-default" type="button">Go!</button>--}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel" id="app" v-cloak>
                        <div class="x_content">

                            <form class="form-inline">
                                <div class="form-group">
                                    <label for="city">城市</label>
                                    <select name="city" id="city" class="form-control">
                                        @foreach($citys as $city)
                                            <option value="{{$city->code}}"
                                                    @if($city->code == $request->city) selected @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="store">门店</label>
                                    <select name="store" id="store" class="form-control" v-model="store">
                                        <option value="">全部</option>
                                        @foreach($stores as $store)
                                            <option value="{{$store->id}}"
                                                    @if($store->id == $request->store) selected @endif>{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="com">车辆品牌</label>
                                    <select name="com" id="com" class="form-control">
                                        @foreach($carComments as $com)
                                            <option value="{{$com->id}}"
                                                    @if($com->id== $request->com) selected @endif>{{$com->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="car_patt">车辆型号</label>
                                    <select name="car_patt" id="car_patt" class="form-control" v-model="car_patt">
                                        <option value="">全部</option>
                                        @foreach($carPatts as $car_patt)
                                            <option value="{{$car_patt->id}}"
                                                    @if($car_patt->id == $request->car_patt) selected @endif>{{$car_patt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="start_time">起始时间</label>
                                    <input type="text" name="start_time" class="form-control" id="start_time"
                                           placeholder="过滤起始时间">
                                </div>

                                <div class="form-group">
                                    <label for="end_time">结束时间</label>
                                    <input type="email" name="end_time" class="form-control" id="end_time"
                                           placeholder="过滤结束时间">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button" @click="search">搜索</button>
                                </div>
                            </form>
                            <hr>
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer warehousetable">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <tr>
                                            <td>~</td>
                                            @for($i=0; $i<24;++$i)
                                                <td>{{$i}}</td>
                                            @endfor
                                        </tr>
                                        <tr v-for="(day, key) in list">
                                            <td>@{{ day.date }}</td>
                                            <td v-for="(hour, hkey) in day.sub"  :class="{danger:hour >= day.count, success: day.count - hour >= 2,warning:day.count-hour == 1  }">
                                                <span>
                                                    @{{ hour }}/@{{ day.count }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
<style>
    .warehousetable td:hover{
        background: #2a3f54;
        color:#FFF;
    }
    .red{
        color:#F00;
    }
    .warehousetable td.success:hover{
        color: #73879C;;
    }
    .warehousetable td.warning:hover{
        color: #73879C;;
    }
</style>
@endpush

@push('addjs')

<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
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

    @if (\Illuminate\Support\Facades\Session::has('success'))
    new PNotify({
        title: '操作成功',
        text: "{{\Illuminate\Support\Facades\Session::get('success')}}",
        type: 'success'
    });
    @endif

</script>
<script src="https://cdn.bootcss.com/vue/2.5.13/vue.min.js"></script>
<script>
    var vm = new Vue({
        el: "#app",
        data: {
            list: [

            ],
            store: '',
            car_patt: '',
            start_time: '',
            end_time: ''
        },
        methods: {
            search: function () {
                if (this.store == '' || this.car_patt == '' || this.start_time == '' || this.end_time == '') {
                    $.alert('请输入搜索条件');
                    return;
                }
                var data = {
                    store: this.store,
                    car_patt: this.car_patt,
                    start_time: this.start_time,
                    end_time: this.end_time
                };
                vthis = this;
                $.getData('/admin/warehouse_search', data, function (res) {
                    console.log(res);
                    if (res.result.code == 1) {
                        vthis.list = res.list;
                    }
                });

            }
        },
        mounted: function () {
//            $.date($('#start_time')[0]);
//            $.date($('#end_time')[0]);
            vthis = this;
            layui.use('laydate', function () {
                layui.laydate.render({
                    elem: '#start_time',
                    done: function (val) {
                        vthis.start_time = val;
                    }
                });
                layui.laydate.render({
                    elem: '#end_time',
                    done: function (val) {
                        vthis.end_time = val;
                    }
                });
            });
        }
    });
</script>
<script>

</script>
<script src="{{ asset('/public/js/city.js') }}"></script>
<script src="{{ asset('public/js/com.js') }}"></script>
@endpush