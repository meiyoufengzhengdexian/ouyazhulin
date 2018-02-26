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
                              action="{{ url('admin/price') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Price信息</span>

                                                                                                                                ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car_patt">车辆型号</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="car_patt" id="car_patt" class="form-control">
                                                @foreach($car_patt_names as $car_patt)
                                                    <option value="{{ $car_patt->id }}">{{ $car_patt->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="basic_service_fee">基础服务费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="basic_service_fee" class="form-control col-md-7 col-xs-12" name="basic_service_fee" placeholder="请输入基础服务费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service_fee">服务费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="service_fee" class="form-control col-md-7 col-xs-12" name="service_fee" placeholder="请输入服务费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ultra_hour_fee">超小时费/每小时</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="ultra_hour_fee" class="form-control col-md-7 col-xs-12" name="ultra_hour_fee" placeholder="请输入超小时费/每小时" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ultra_km_fee">长公里费/每公里</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="ultra_km_fee" class="form-control col-md-7 col-xs-12" name="ultra_km_fee" placeholder="请输入长公里费/每公里" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pre_authorization_fee">基础授权费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pre_authorization_fee" class="form-control col-md-7 col-xs-12" name="pre_authorization_fee" placeholder="请输入基础授权费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Illegal_deposit">违章押金</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="Illegal_deposit" class="form-control col-md-7 col-xs-12" name="Illegal_deposit" placeholder="请输入违章押金" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="off_site_fee">异地还车费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="off_site_fee" class="form-control col-md-7 col-xs-12" name="off_site_fee" placeholder="请输入异地还车费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="night_give_fee">夜间取车费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="night_give_fee" class="form-control col-md-7 col-xs-12" name="night_give_fee" placeholder="请输入夜间取车费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="night_return_fee">夜间还车费</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="night_return_fee" class="form-control col-md-7 col-xs-12" name="night_return_fee" placeholder="请输入夜间还车费" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="night_start_time">夜间开始时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="night_start_time" class="form-control col-md-7 col-xs-12" name="night_start_time" placeholder="请输入夜间开始时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="night_end_time">夜间结束时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="night_end_time" class="form-control col-md-7 col-xs-12" name="night_end_time" placeholder="请输入夜间结束时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="platform">平台</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="platform" id="platform" class="form-control">
                                                @foreach($platform_names as $platform)
                                                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">状态</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="status" class="form-control col-md-7 col-xs-12" name="status" placeholder="请输入状态" required="required" value="" type="text">
                                    </div>
                                </div>
                                                                                                                                                                                                                                        
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary">取消</button>
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