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
                              action="{{  url("admin/edit_passwd") }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <span class="section">修改密码</span>
                            @if(!\App\Model\Admin::getAdmin()->is_supper_admin || $user->is_supper_admin || \App\Model\Admin::getAdmin()->id == $user->id)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="old_passwd">原密码</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="old_passwd" class="form-control col-md-7 col-xs-12" name="old_passwd"
                                           placeholder="请输入原密码" required="required"
                                           type="password">
                                </div>
                            </div>
                            @endif
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="new_passwd">新密码</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="new_passwd" class="form-control col-md-7 col-xs-12" name="new_passwd"
                                           placeholder="请输入新密码" required="required"
                                           type="password">
                                </div>
                            </div>
                            {{--_confirmation--}}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                       for="_confirmation">请在输入一次</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="_confirmation" class="form-control col-md-7 col-xs-12" name="new_passwd_confirmation"
                                           placeholder="请输入新密码" required="required"
                                           type="password">
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