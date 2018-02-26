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
                              action="{{ url('admin/car_patt') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Car_patt信息</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="com">车辆品牌</label>
                                <div class="col-md-5 col-sm-5 col-xs-11">
                                    <select name="com" id="com" class="form-control">
                                        @foreach($car_com_names as $car_com)
                                            <option value="{{ $car_com->id }}">{{ $car_com->sort . $car_com->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <button class="btn btn-primary add-car-com">添加品牌</button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">车辆型号名</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                           placeholder="请输入车辆型号名" required="required" value="" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="site">乘坐人数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="site" class="form-control col-md-7 col-xs-12" name="site"
                                           placeholder="请输入乘坐人数" required="required" value="" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="luggage">行李箱数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="luggage" class="form-control col-md-7 col-xs-12" name="luggage"
                                           placeholder="请输入行李箱数" required="required" value="" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-6" for="model">厢式</label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <select name="model" id="model" class="form-control">
                                        @foreach($car_model_names as $car_model)
                                            <option value="{{ $car_model->id }}">{{ $car_model->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-6">
                                    <button type="button" class="btn btn-primary add-car-model">
                                        添加
                                    </button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="fuel_tank_capacity">油箱容量</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="fuel_tank_capacity" class="form-control col-md-7 col-xs-12"
                                           name="fuel_tank_capacity" placeholder="请输入油箱容量" required="required" value=""
                                           data-validate-minmax="0," type="number">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="img">车型图片</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <img src="/public/images/timg.gif" alt="" class="img-responsive upload_img" id="show_upload_img">
                                    <input id="img"
                                           name="img" placeholder="车型图片" required="required" value=""
                                           data-validate-minmax="0," type="hidden">
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <button class="btn btn-primary select-img" type="button">选择图片</button>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car_type">车辆类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="car_type" id="car_type" class="form-control">
                                        @foreach($car_type_names as $car_type)
                                            <option value="{{ $car_type->id }}">{{ $car_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="transmission">变速箱类型</label>
                                <div class="col-md-5 col-sm-5 col-xs-1">
                                    <select name="transmission" id="transmission" class="form-control">
                                        @foreach($car_transmission_names as $car_transmission)
                                            <option value="{{ $car_transmission->id }}">{{ $car_transmission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <button type="button" class="btn btn-primary add-car-transmission">
                                        添加
                                    </button>
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
        {{--data-toggle="modal" data-target="#myModal"--}}
        @include('admin.commons.car_patt_create')
        @include('admin.commons.car_com_create')
        @include ('admin.commons.car_transmission_create')
        @include ('admin.commons.img_modal')
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

    $(function () {
        $('.add-car-model').on('click', function () {
            $('#car-model-create').modal('toggle', {id:10});
        });
        $('.add-car-com').on('click', function(){
            $('#car-com-create').modal('toggle');
        });
        $('.add-car-transmission').on('click', function () {
            $('#car-transmission-create').modal('toggle');
        });
        $('.select-img').on('click', function(){
            $('#img-modal').modal('toggle', {
                $img:$('#show_upload_img'),
                $imgInput:$('[name=img]'),
                defaultImg:$($('[name=img]')).val()
            });
        });
    })

</script>
@endpush