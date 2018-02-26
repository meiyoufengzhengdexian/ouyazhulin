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
                              action="{{ url('admin/order') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Order信息</span>

                                                                                                                                ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="oth_order_id">第三方单号</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="oth_order_id" class="form-control col-md-7 col-xs-12" name="oth_order_id" placeholder="请输入第三方单号" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="platform">平台</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="platform" class="form-control col-md-7 col-xs-12" name="platform" placeholder="请输入平台" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">订单价格</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price" class="form-control col-md-7 col-xs-12" name="price" placeholder="请输入订单价格" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car">车辆id</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="car" id="car" class="form-control">
                                                @foreach($car_license_plates as $car)
                                                    <option value="{{ $car->id }}">{{ $car->license_plate }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="license_plate">车辆牌照</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="license_plate" class="form-control col-md-7 col-xs-12" name="license_plate" placeholder="请输入车辆牌照" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="store">门店</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="store" class="form-control col-md-7 col-xs-12" name="store" placeholder="请输入门店" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">城市</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="city" class="form-control col-md-7 col-xs-12" name="city" placeholder="请输入城市" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pickup_store">取车门店</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pickup_store" class="form-control col-md-7 col-xs-12" name="pickup_store" placeholder="请输入取车门店" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="return_store">还车门店</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="return_store" class="form-control col-md-7 col-xs-12" name="return_store" placeholder="请输入还车门店" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pickup_time">取车时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pickup_time" class="form-control col-md-7 col-xs-12" name="pickup_time" placeholder="请输入取车时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="return_time">还车时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="return_time" class="form-control col-md-7 col-xs-12" name="return_time" placeholder="请输入还车时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coupon_code">优惠码</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="coupon_code" class="form-control col-md-7 col-xs-12" name="coupon_code" placeholder="请输入优惠码" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coupon_price">优惠价格</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="coupon_price" class="form-control col-md-7 col-xs-12" name="coupon_price" placeholder="请输入优惠价格" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="use_name">用户姓名</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="use_name" class="form-control col-md-7 col-xs-12" name="use_name" placeholder="请输入用户姓名" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="use_phone">用户手机</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="use_phone" class="form-control col-md-7 col-xs-12" name="use_phone" placeholder="请输入用户手机" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="card_type">证件类型</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="card_type" id="card_type" class="form-control">
                                                @foreach($card_names as $card)
                                                    <option value="{{ $card->id }}">{{ $card->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="card_no">证件编号</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="card_no" class="form-control col-md-7 col-xs-12" name="card_no" placeholder="请输入证件编号" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price_mark">价格标记</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price_mark" class="form-control col-md-7 col-xs-12" name="price_mark" placeholder="请输入价格标记" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cancel_time">取消时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cancel_time" class="form-control col-md-7 col-xs-12" name="cancel_time" placeholder="请输入取消时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cancel_price">损失（取消）费用</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="cancel_price" class="form-control col-md-7 col-xs-12" name="cancel_price" placeholder="请输入损失（取消）费用" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pay_status">支付状态</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="pay_status" id="pay_status" class="form-control">
                                                @foreach($status_names as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">订单状态</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="status" class="form-control col-md-7 col-xs-12" name="status" placeholder="请输入订单状态" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_ref">状态详情</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status_ref" id="status_ref" class="form-control">
                                                @foreach($status_ref_created_ats as $status_ref)
                                                    <option value="{{ $status_ref->id }}">{{ $status_ref->created_at }}</option>
                                                @endforeach
                                            </select>
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