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
                              action="{{ url('admin/pickup_price') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Pickup_price信息</span>

                                                                                                                                ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pickup_time">取车时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pickup_time" class="form-control col-md-7 col-xs-12" name="pickup_time" placeholder="请输入取车时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order">订单</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="order" id="order" class="form-control">
                                                @foreach($order_ids as $order)
                                                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pickup_oil">取车油量</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pickup_oil" class="form-control col-md-7 col-xs-12" name="pickup_oil" placeholder="请输入取车油量" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pickup_km">取车公里数</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="pickup_km" class="form-control col-md-7 col-xs-12" name="pickup_km" placeholder="请输入取车公里数" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paid">已付金额</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="paid" class="form-control col-md-7 col-xs-12" name="paid" placeholder="请输入已付金额" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="oth_fee">其他费用</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="oth_fee" class="form-control col-md-7 col-xs-12" name="oth_fee" placeholder="请输入其他费用" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">备注</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="desc" name="desc" class="form-control col-md-7 col-xs-12"></textarea>
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