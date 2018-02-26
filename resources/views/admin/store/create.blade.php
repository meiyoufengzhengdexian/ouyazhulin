@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>添加新分类</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{ url('admin/store') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">门店</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">门店/提车点名称</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                           placeholder="请输入门店/提车点名称" required="required" value="{{old('name')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="person">联系人</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="person" class="form-control col-md-7 col-xs-12" name="person"
                                           placeholder="请输入联系人" required="required" value="{{old('person')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">联系人手机</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="phone" class="form-control col-md-7 col-xs-12" name="phone"
                                           placeholder="请输入联系人手机" required="required" value="{{old('phone')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="open_time">开门时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="open_time" class="form-control col-md-7 col-xs-12" name="open_time"
                                           placeholder="请输入开门时间" required="required" value="{{old('open_time')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="close_time">关门时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="close_time" class="form-control col-md-7 col-xs-12" name="close_time"
                                           placeholder="请输入关门时间" required="required" value="{{old('close_time')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location_poi">地理坐标</label>
                                <div class="col-md-5 col-sm-5 col-xs-11">
                                    <input id="location_poi" class="form-control col-md-7 col-xs-12" name="location_poi"
                                           placeholder="请输入地理坐标 （例：126.251133,45.625854）" required="required"
                                           value="{{old('location_poi')}}"
                                           type="text">
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <a class="btn btn-link" href="http://lbs.amap.com/console/show/picker" target="_blank">高德坐标拾取</a>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="location_name">详细地址</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="location_name" class="form-control col-md-7 col-xs-12"
                                           name="location_name" placeholder="请输入详细地址" required="required"
                                           value="{{old('location_name')}}"
                                           type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">城市</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <select id="sheng" class="form-control">
                                                <option value="">请选择</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <select id="city" name="city" class="form-control">
                                                <option value="">请选择</option>
                                            </select>
                                            <input type="hidden" name="city_name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="minimal_advance_booking_time">最小提前预定小时数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <input type="number" placeholder="天" name="m_d" class="form-control">
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <select name="m_i" class="form-control">
                                                <option value="0">小时</option>
                                                @for($i=0; $i<24; ++$i)
                                                    <option value="{{ $i }}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <select name="m_m" class="form-control">
                                                <option value="0">分钟</option>
                                                <option value="0">0</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="the_larges_advance_scheduled_time">最大提前预定小时数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <input type="number" placeholder="天" name="t_d" class="form-control">
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <select name="t_i" class="form-control">
                                                <option value="00">小时</option>
                                                @for($i=0; $i<24; ++$i)
                                                    <option value="{{ $i }}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <select name="t_m" class="form-control">
                                                <option value="00">分钟</option>
                                                <option value="00">0</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{----}}
                                    {{--<input id="the_larges_advance_scheduled_time"--}}
                                           {{--class="form-control col-md-7 col-xs-12"--}}
                                           {{--name="the_larges_advance_scheduled_time" placeholder="请输入最大提前预定小时数"--}}
                                           {{--required="required" data-validate-minmax="0," type="number"--}}
                                           {{--value="{{old('the_larges_advance_scheduled_time', 0)}}"--}}
                                    {{-->--}}
                                </div>
                            </div>

                            {{--<div class="item form-group">--}}
                                {{--<label class="control-label col-md-3 col-sm-3 col-xs-12"--}}
                                       {{--for="the_larges_advance_scheduled_time">有损金额百分比</label>--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--<input id="cancel_pre"--}}
                                           {{--class="form-control col-md-7 col-xs-12"--}}
                                           {{--name="cancel_pre" placeholder="超过免费取消时间需扣费比例"--}}
                                           {{--required="required" data-validate-minmax="0," type="number"--}}
                                           {{--value="{{old('cancel_pre', 0)}}"--}}
                                    {{-->--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="diff_store_rank">异门店还车等级</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="diff_store_rank" id="diff_store_rank" class="form-control">
                                        <option value="SCSS">同城市同门店</option>
                                        <option value="SCDS">同城市异门店</option>
                                        <option value="DCDS">异城市异门店</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="payment_method">支付方式</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        @foreach($pay_method_names as $pay_method)
                                            <option value="{{ $pay_method->id }}"
                                                    @if(old('payment_method') == $pay_method->id) selected @endif>
                                                {{ $pay_method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="type" id="type" class="form-control">
                                        <option value="1" @if(old('type') == 1) selected @endif>门店</option>
                                        <option value="2" @if(old('type') == 2) selected @endif>提车点</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group mendian">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rent_pre">租金加价百分比</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="rent_pre" class="form-control col-md-7 col-xs-12" name="rent_pre"
                                           placeholder="请输入租金加价百分比" required="required" value="{{old('rent_pre', 0)}}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>

                            <div class="item form-group mendian">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fee">手续加价百分比</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="fee" class="form-control col-md-7 col-xs-12" name="fee"
                                           placeholder="请输入手续加价百分比" required="required" value="{{old('fee', 0)}}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>

                            <div class="item form-group mendian">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="store">所属门店</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="store" id="stores" class="form-control">
                                        @foreach($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">是否开启</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="checkbox" class="js-switch" data-switchery="true"
                                           checked
                                           name="status" value="1" id="status">
                                </div>
                            </div>

                            <div class="item form-group return_store">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="return_store">可还车门店/提车点</label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @foreach($stores as $store)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="return_store[]"
                                                   value="{{$store->id}}"> {{$store->name}}
                                        </label>
                                    @endforeach
                                </div>

                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary return">取消</button>
                                    <button id="send" type="submit" class="btn btn-success">确定</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
    <link href="{{ asset('public/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/admin/store.css') }}">
@endpush
@push('addjs')
    <script src="{{ asset('public/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('public/vendors/validator/validator.js') }}"></script>
    {!! \App\Lib\Gaode::getScriptTag() !!}
    <script>
        @foreach($errors->all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach
    </script>

    <script src="{{asset('public/js/admin/store.js')}}"></script>
@endpush