@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>管理员列表</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                            <span class="input-group-btn">
                              {{--<button class="btn btn-default" type="button">Go!</button>--}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th width="35px">id</th>
                                            <th width="35px">管理员名</th>
                                            <th width="35px">登录名</th>
                                            <th width="35px">状态</th>
                                            <th width="35px">修改日期</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>
                                                    @if($v->is_supper_admin)
                                                        <code>{{ $v->name }}</code>
                                                    @else
                                                        {{ $v->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $v->account }}</td>
                                                <td class="show-status">{{ $v->status == 1? '启用':'禁用' }}</td>
                                                <td>{{ $v->updated_at }}</td>
                                                <td>
                                                    <a href="{{ url('admin/edit_passwd').'?id='.$v->id }}"
                                                       class="btn btn-info btn-xs">修改密码</a>
                                                    @if(\App\Model\Admin::getAdmin()->is_supper_admin && $v->name != 'admin2' )
                                                        <button data-url="{{ url('admin/user/status', ['status' => 1])}}"
                                                                data-id="{{$v->id}}"
                                                                data-status="1"
                                                                class="btn btn-success btn-xs status">启用
                                                        </button>
                                                        <button data-url="{{ url('admin/user/status', ['status' => 0]) }}"
                                                                data-id="{{$v->id}}"
                                                                data-status="0"
                                                                class="btn btn-danger btn-xs status">禁用
                                                        </button>
                                                        @if(!$v->is_supper_admin)
                                                            <a href="{{ url('admin/user/addStore', ['id' => $v->id]) }}"
                                                               class="btn btn-link">管理@门店</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addcss')
<!-- Datatables -->
<link href="{{ asset('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
      rel="stylesheet">
<link href="{{ asset('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
      rel="stylesheet">
<link href="{{ asset('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('addjs')
<script src="{{ asset('public/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<script>
    $(function () {
        $('#datatable').DataTable();

        @foreach ($errors -> all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach
    });

    @if (\Illuminate\Support\Facades\Session::has('success'))
    new PNotify({
        title: '操作成功',
        text: "{{\Illuminate\Support\Facades\Session::get('success')}}",
        type: 'success'
    });
    @endif

</script>
<script>
    $(function () {
        $('.status').on('click', function () {
            var url = $(this).data('url');
            var id = $(this).data('id');
            var $this = $(this);
            $.postData(url, {
                id: id
            }, function (res) {
                if (res.result.code == 1) {
                    $.msg('操作成功');
                    $td = $this.parents('tr').find('.show-status');
                    $td.html($this.data('status') == '1' ? '启用' : '禁用')
                } else {
                    $.alert(res.result.message || '操作失败');
                }
            })
        });
    });
</script>
@endpush