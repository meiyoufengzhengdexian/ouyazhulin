@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>编辑Price_info</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/price_info/$data->id") }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <span class="section">Price_info信息</span>
                                                                                                                                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="price">订单价格</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="price" class="form-control col-md-7 col-xs-12" name="price" placeholder="请输入订单价格" required="required" value="{{ $data->price }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="basic_service_fee">基础服务费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="basic_service_fee" class="form-control col-md-7 col-xs-12" name="basic_service_fee" placeholder="请输入基础服务费" required="required" value="{{ $data->basic_service_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="service_fee">服务费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="service_fee" class="form-control col-md-7 col-xs-12" name="service_fee" placeholder="请输入服务费" required="required" value="{{ $data->service_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="ultra_hour_fee">超小时费/每小时</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="ultra_hour_fee" class="form-control col-md-7 col-xs-12" name="ultra_hour_fee" placeholder="请输入超小时费/每小时" required="required" value="{{ $data->ultra_hour_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="ultra_km_fee">超公里费/每公里</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="ultra_km_fee" class="form-control col-md-7 col-xs-12" name="ultra_km_fee" placeholder="请输入超公里费/每公里" required="required" value="{{ $data->ultra_km_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="pre_authorization_fee">基础授权费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pre_authorization_fee" class="form-control col-md-7 col-xs-12" name="pre_authorization_fee" placeholder="请输入基础授权费" required="required" value="{{ $data->pre_authorization_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="Illegal_deposit">违章押金</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="Illegal_deposit" class="form-control col-md-7 col-xs-12" name="Illegal_deposit" placeholder="请输入违章押金" required="required" value="{{ $data->Illegal_deposit }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="off_site_fee">异地还车费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="off_site_fee" class="form-control col-md-7 col-xs-12" name="off_site_fee" placeholder="请输入异地还车费" required="required" value="{{ $data->off_site_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_pickup_fee">夜间取车费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_pickup_fee" class="form-control col-md-7 col-xs-12" name="night_pickup_fee" placeholder="请输入夜间取车费" required="required" value="{{ $data->night_pickup_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_return_fee">夜间换车费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_return_fee" class="form-control col-md-7 col-xs-12" name="night_return_fee" placeholder="请输入夜间换车费" required="required" value="{{ $data->night_return_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_start">夜间开始时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_start" class="form-control col-md-7 col-xs-12" name="night_start" placeholder="请输入夜间开始时间" required="required" value="{{ $data->night_start }}" type="text">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="night_end">夜间结束时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="night_end" class="form-control col-md-7 col-xs-12" name="night_end" placeholder="请输入夜间结束时间" required="required" value="{{ $data->night_end }}" type="text">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="platform">平台</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="platform" class="form-control col-md-7 col-xs-12" name="platform" placeholder="请输入平台" required="required" value="{{ $data->platform }}" type="text">
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