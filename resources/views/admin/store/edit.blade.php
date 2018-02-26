@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>编辑门店</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/store/$data->id") }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <span class="section">Store信息</span>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="name">门店名称</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                           placeholder="请输入门店名称" required="required" value="{{ $data->name }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="person">联系人</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="person" class="form-control col-md-7 col-xs-12" name="person"
                                           placeholder="请输入联系人" required="required" value="{{ $data->person }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="phone">联系人手机</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="phone" class="form-control col-md-7 col-xs-12" name="phone"
                                           placeholder="请输入联系人手机" required="required" value="{{ $data->phone }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="open_time">开门时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="open_time" class="form-control col-md-7 col-xs-12" name="open_time"
                                           placeholder="请输入开门时间" required="required" value="{{ $data->open_time }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="close_time">关门时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="close_time" class="form-control col-md-7 col-xs-12" name="close_time"
                                           placeholder="请输入关门时间" required="required" value="{{ $data->close_time }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="location_poi">地理坐标</label>
                                <div class="col-md-5 col-sm-5 col-xs-11">
                                    <input id="location_poi" class="form-control col-md-7 col-xs-12" name="location_poi"
                                           placeholder="请输入地理坐标" required="required" value="{{ $data->location_poi }}"
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
                                           value="{{ $data->location_name }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="city">城市</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span style="line-height: 34px;padding: 11px" class="show-city"> {{ $data->getCity->name }}</span> <span style="width: 50px">  </span>
                                    <button class="btn btn-link city" style="margin-bottom: 0" type="button">修改</button>
                                    <input type="hidden" name="city_name" value="{{ $data->getCity->name }}">
                                    <input type="hidden" name="city" value="{{ $data->city }}">
                                </div>
                            </div>
                            @if( $data->type == 2)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="rent_pre">租金加价百分比</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="rent_pre" class="form-control col-md-7 col-xs-12" name="rent_pre"
                                           placeholder="请输入租金加价百分比" required="required" value="{{ $data->rent_pre }}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="fee">手续加价百分比</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="fee" class="form-control col-md-7 col-xs-12" name="fee"
                                           placeholder="请输入手续加价百分比" required="required" value="{{ $data->fee }}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            @endif
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="minimal_advance_booking_time">最小提前预定时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span style="line-height: 34px;padding: 11px" class="minimal_advance_booking_time">
                                        {{ $data->minimal_advance_booking_time  }}</span> <span style="width: 50px">
                                    </span>
                                    <button class="btn btn-link minimal_advance_booking_time" style="margin-bottom: 0" type="button">修改</button>
                                    <input type="hidden" name="minimal_advance_booking_time_change" value="0">
                                    <input type="hidden" name="m_d">
                                    <input type="hidden" name="m_i">
                                    <input type="hidden" name="m_m">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="the_larges_advance_scheduled_time">最大提前预定时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span style="line-height: 34px;padding: 11px" class="the_larges_advance_scheduled_time">
                                       {{ $data->the_larges_advance_scheduled_time }}</span> <span style="width: 50px">
                                    </span>
                                    <button class="btn btn-link the_larges_advance_scheduled_time" style="margin-bottom: 0" type="button">修改</button>
                                    <input type="hidden" name="the_larges_advance_scheduled_time_change" value="0">
                                    <input type="hidden" name="t_d">
                                    <input type="hidden" name="t_i">
                                    <input type="hidden" name="t_m">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="payment_method">支付方式</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        @foreach($pay_method_names as $pay_method)
                                            <option
                                                    @if($pay_method->id == $data->payment_method)
                                                    selected="true"
                                                    @endif
                                                    value="{{ $pay_method->id }}">{{ $pay_method->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($data->type == 2)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="store">所属门店</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="store" id="store" class="form-control">
                                        @foreach($stores as $store)
                                            <option value="{{ $store->id }}" @if($store->id == $data->store) selected @endif>{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            {{--<div class="item form-group">--}}
                                {{--<label class="control-label col-md-3 col-sm-3 col-xs-12"--}}
                                       {{--for="diff_store_rank">异门店还车等级</label>--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--<input id="diff_store_rank" class="form-control col-md-7 col-xs-12"--}}
                                           {{--name="diff_store_rank" placeholder="请输入异门店还车等级" required="required"--}}
                                           {{--value="{{ $data->diff_store_rank }}" type="text">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="item form-group">--}}
                                {{--<label class="control-label col-md-3 col-sm-3 col-xs-12"--}}
                                       {{--for="status">状态</label>--}}
                                {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                    {{--<select name="status" id="status">--}}
                                        {{--<option value="1">开启</option>--}}
                                        {{--<option value="1">关闭</option>--}}
                                    {{--</select>--}}
                                    {{--<input id="status" class="form-control col-md-7 col-xs-12" name="status"--}}
                                           {{--placeholder="请输入状态" required="required" value="{{ $data->status }}"--}}
                                           {{--type="text">--}}
                                {{--</div>--}}
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
    @include ('admin.commons.city_modal')
    @include('admin.commons.time_modal')
@endsection

@push('addcss')
@endpush
@push('addjs')
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
    $(function(){
        $.time($('#open_time')[0]);
        $.time($('#close_time')[0]);

        $('.city').on('click', function () {
            $('#city-modal').modal('show', {
                'city_name_dom':$(this).siblings('[name=city_name]'),
                'city_id_dom':$(this).siblings('[name=city]'),
                'city_show':$('.show-city'),
            });
        });

        $('button.minimal_advance_booking_time').on('click', function(){
            $('#time-modal').modal('show', {
                day_dom:$('[name=m_d]'),
                h_dom:$('[name=m_i]'),
                m_dom:$('[name=m_m]'),
                show_dom:$('span.minimal_advance_booking_time'),
                flag_dom:$('input[name=minimal_advance_booking_time_change]')
            });
        });

        $('button.the_larges_advance_scheduled_time').on('click', function(){
            $('#time-modal').modal('show', {
                day_dom:$('[name=t_d]'),
                h_dom:$('[name=t_i]'),
                m_dom:$('[name=t_m]'),
                show_dom:$('span.the_larges_advance_scheduled_time'),
                flag_dom:$('input[name=the_larges_advance_scheduled_time_change]')
            });
        });

    });

</script>
@endpush