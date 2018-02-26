@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>编辑Return_price</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/return_price/$data->id") }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <span class="section">Return_price信息</span>
                                                                                                                                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="order">订单</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="order" class="form-control col-md-7 col-xs-12" name="order" placeholder="请输入订单" required="required" value="{{ $data->order }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="return_km">还车公里数</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="return_km" class="form-control col-md-7 col-xs-12" name="return_km" placeholder="请输入还车公里数" required="required" value="{{ $data->return_km }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="return_oil">还车油量</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="return_oil" class="form-control col-md-7 col-xs-12" name="return_oil" placeholder="请输入还车油量" required="required" value="{{ $data->return_oil }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="return_time">还车时间</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="return_time" class="form-control col-md-7 col-xs-12" name="return_time" placeholder="请输入还车时间" required="required" value="{{ $data->return_time }}" type="text">
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
                                       for="oil_fee">燃油费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="oil_fee" class="form-control col-md-7 col-xs-12" name="oil_fee" placeholder="请输入燃油费" required="required" value="{{ $data->oil_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="cleaning_fee">清洁费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="cleaning_fee" class="form-control col-md-7 col-xs-12" name="cleaning_fee" placeholder="请输入清洁费" required="required" value="{{ $data->cleaning_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="lost_wages">误工费</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="lost_wages" class="form-control col-md-7 col-xs-12" name="lost_wages" placeholder="请输入误工费" required="required" value="{{ $data->lost_wages }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="oth_fee">其他费用</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="oth_fee" class="form-control col-md-7 col-xs-12" name="oth_fee" placeholder="请输入其他费用" required="required" value="{{ $data->oth_fee }}" data-validate-minmax="0," type="number">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="desc">备注</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="desc" class="form-control col-md-7 col-xs-12" name="desc" placeholder="请输入备注" required="required" value="{{ $data->desc }}" type="text">
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