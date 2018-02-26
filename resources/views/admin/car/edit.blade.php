@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>编辑Car</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/car/$data->id") }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <span class="section">Car信息</span>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="car_patt">车辆型号</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="car_patt" id="car_patt" class="form-control">
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
                                       for="license_plate">车辆牌照</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="license_plate" class="form-control col-md-7 col-xs-12"
                                           name="license_plate" placeholder="请输入车辆牌照" required="required"
                                           value="{{ $data->license_plate }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="km">行驶公里数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="km" class="form-control col-md-7 col-xs-12" name="km"
                                           placeholder="请输入行驶公里数" required="required" value="{{ $data->km }}"
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="color">颜色</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="color" class="form-control col-md-7 col-xs-12" name="color"
                                           placeholder="请输入颜色" required="required" value="{{ $data->color }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="status">状态</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" @if($data->status == 1) selected @endif>启用</option>
                                        <option value="0" @if($data->status == 0) selected @endif>禁用</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="store">所属门店</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="store" id="store" class="form-control">
                                        @foreach($stores as $store)
                                            @endforeach
                                        <option value="{{ $store->id }}" @if($data->store == $store->id) selected @endif>{{ $store->name }}</option>
                                    </select>
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
@endpush
@push('addjs')
<script src="{{ asset('public/vendors/validator/validator.js') }}"></script>
<script>
    @foreach($errors->all() as $e)
        new PNotify({
        title: 'Oh No!',
        text: '{{ $e }}',
        type: 'error'
    });
    @endforeach


</script>
@endpush