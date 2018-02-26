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
                              action="{{ url('admin/additional_service') }}" method="post">
                            {{ csrf_field() }}
                            <span class="section">Additional_service信息</span>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">增值服务名</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name"
                                           placeholder="请输入增值服务名" required="required" value="" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">描述</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="desc" class="form-control col-md-7 col-xs-12" name="desc"
                                           placeholder="请输入描述" required="required" value="" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">价格</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="price" class="form-control col-md-7 col-xs-12" name="price"
                                           placeholder="请输入价格" required="required" value="" data-validate-minmax="0,"
                                           type="number">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="type" id="type" class="form-control">
                                        @foreach(\App\Model\Additional_service::$status as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
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