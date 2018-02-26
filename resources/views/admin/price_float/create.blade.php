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
                              action="{{ url('admin/price_float') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Price_float信息</span>

                                                                                                                                ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">价格</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price" class="form-control col-md-7 col-xs-12" name="price" placeholder="请输入价格" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num">值</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="num" class="form-control col-md-7 col-xs-12" name="num" placeholder="请输入值" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_type">值类型</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="num_type" class="form-control col-md-7 col-xs-12" name="num_type" placeholder="请输入值类型" required="required" value="" data-validate-minmax="0," type="number">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="float_type">浮动类型</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="float_type" class="form-control col-md-7 col-xs-12" name="float_type" placeholder="请输入浮动类型" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="week">星期</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="week" class="form-control col-md-7 col-xs-12" name="week" placeholder="请输入星期" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_date">开始日期</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="start_date" class="form-control col-md-7 col-xs-12" name="start_date" placeholder="请输入开始日期" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_date">结束日期</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="end_date" class="form-control col-md-7 col-xs-12" name="end_date" placeholder="请输入结束日期" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time">开始时间</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="start_time" class="form-control col-md-7 col-xs-12" name="start_time" placeholder="请输入开始时间" required="required" value="" type="text">
                                    </div>
                                </div>
                                                            ;
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time">结束日期</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="end_time" class="form-control col-md-7 col-xs-12" name="end_time" placeholder="请输入结束日期" required="required" value="" type="text">
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