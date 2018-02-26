<?php
$additionalServices = \App\Model\Additional_service::where('type', 1)->get();
?>
@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>修改价格</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/price/$data->id") }}" method="post">
                            <input type="hidden" name="platform" value="{{$data->platform}}">
                            <input type="hidden" name="car_patt" value="{{$data->car_patt}}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <span class="section">修改价格</span>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="platform">平台</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="platform" id="platform" class="form-control" disabled>
                                        @foreach($platform_names as $platform)
                                            <option
                                                    @if($platform->id == $data->platform)
                                                    selected="true"
                                                    @endif
                                                    value="{{ $platform->id }}">{{ $platform->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="car_patt">车辆型号</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="car_patt" id="car_patt" class="form-control" disabled="">
                                        @foreach($car_patt_names as $car_patt)
                                            <option
                                                    @if($car_patt->id == $data->car_patt)
                                                    selected="true"
                                                    @endif
                                                    value="{{ $car_patt->id }}">{{ $car_patt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="basic_service_fee">基础服务费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="basic_service_fee" class="form-control col-md-7 col-xs-12"
                                           name="basic_service_fee" placeholder="请输入基础服务费" required="required"
                                           value="{{ $data->basic_service_fee }}" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="service_fee">服务费(每天)</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="service_fee" class="form-control col-md-7 col-xs-12" name="service_fee"
                                           placeholder="请输入服务费" required="required" value="{{ $data->service_fee }}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="ultra_hour_fee">超小时费/每小时</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="ultra_hour_fee" class="form-control col-md-7 col-xs-12"
                                           name="ultra_hour_fee" placeholder="请输入超小时费/每小时" required="required"
                                           value="{{ $data->ultra_hour_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="ultra_km_fee">超公里费/每公里</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="ultra_km_fee" class="form-control col-md-7 col-xs-12" name="ultra_km_fee"
                                           placeholder="请输入长公里费/每公里" required="required"
                                           value="{{ $data->ultra_km_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="pre_authorization_fee">基础授权费(押金)</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pre_authorization_fee" class="form-control col-md-7 col-xs-12"
                                           name="pre_authorization_fee" placeholder="请输入基础授权费" required="required"
                                           value="{{ $data->pre_authorization_fee }}" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="Illegal_deposit">违章押金</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="Illegal_deposit" class="form-control col-md-7 col-xs-12"
                                           name="Illegal_deposit" placeholder="请输入违章押金" required="required"
                                           value="{{ $data->Illegal_deposit }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="off_site_fee">异地还车费/每公里</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="off_site_fee" class="form-control col-md-7 col-xs-12" name="off_site_fee"
                                           placeholder="请输入异地还车费" required="required" value="{{ $data->off_site_fee }}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_give_fee">夜间取车费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_give_fee" class="form-control col-md-7 col-xs-12"
                                           name="night_give_fee" placeholder="请输入夜间取车费" required="required"
                                           value="{{ $data->night_give_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_return_fee">夜间还车费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_return_fee" class="form-control col-md-7 col-xs-12"
                                           name="night_return_fee" placeholder="请输入夜间还车费" required="required"
                                           value="{{ $data->night_return_fee }}" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_start_time">夜间开始时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_start_time" class="form-control col-md-7 col-xs-12"
                                           name="night_start_time" placeholder="请输入夜间开始时间" required="required"
                                           value="{{ $data->night_start_time }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_end_time">夜间结束时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_end_time" class="form-control col-md-7 col-xs-12"
                                           name="night_end_time" placeholder="请输入夜间结束时间" required="required"
                                           value="{{ $data->night_end_time }}" type="text">
                                </div>
                            </div>



                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">是否开启</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="status" id="status" class="form-control">
                                        @foreach( \App\Model\Price::$status as $key=>$value )
                                            <option value="{{$key}}"
                                                    @if($key == $data->status) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">可选增值服务</label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @foreach($additionalServices as $additionalService)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="additional_service[]"
                                                   value="{{$additionalService->id}}"
                                                   @if($data->getAdditional->contains($additionalService)) checked @endif> {{$additionalService->name}}
                                            ¥{{$additionalService->price}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary return">取消</button>
                                    <button id="send" type="submit" class="btn btn-success">确定</button>
                                    {{-- data-id = price id--}}
                                    <button class="btn btn-info" id="set-price-float" type="button" data-id="{{ $data->id }}">设置价格浮动</button>
                                    <button class="btn btn-dark" id="price_float_cat" type="button" data-id="{{ $data->id }}">查看价格浮动列表</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin/commons/set_price_float_modal')
    @include('admin/commons/price_float_cat_modal')
@endsection

@push('addcss')
    <link rel="stylesheet"
          href="{{ asset('public/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin/store.css') }}">
@endpush
@push('addjs')
    <script src="{{ asset('public/vendors/validator/validator.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <script src="{{ asset('public/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script>
        @foreach($errors->all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach

        $('#night_start_time, #night_end_time').datetimepicker({
            language: 'zh-CN',
            todayHighlight: 1,
            todayBtn: 1,
            startView: 1,
            format: 'hh:ii:00'
        });

        $('#set-price-float').on('click', function(){
            $this = $(this);
            $('#set_price_float_modal').modal('toggle', {
                price:$this.data('id')
            });
        });
        $('#price_float_cat').on('click', function(){
            $this = $(this);
            $('#price_float_cat_modal').modal('toggle', {
                price:$this.data('id')
            });
        });
//price_float_cat

    </script>
@endpush