@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="page-title">
            <div class="title_left">
                <h2>编辑Img</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" novalidate data-parsley-validate
                              action="{{  url("admin/img/$data->id") }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <span class="section">Img信息</span>
                                                                                                                                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="path">路径</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="path" class="form-control col-md-7 col-xs-12" name="path" placeholder="请输入路径" required="required" value="{{ $data->path }}" type="text">
                                </div>
                            </div>
                                                                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="type">类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="type" class="form-control col-md-7 col-xs-12" name="type" placeholder="请输入类型" required="required" value="{{ $data->type }}" type="text">
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