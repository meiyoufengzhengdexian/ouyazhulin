@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>门店/提车点</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <span class="input-group-btn">
                                @if(session('admin')->is_supper_admin)
                                    <a class="btn btn-primary" type="button" href="/admin/store/create">添加门店</a>
                                @endif()
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
                                            <th width="35px">门店名称</th>
                                            <th width="35px">联系人</th>
                                            <th width="35px">营业时间</th>
                                            <th width="35px">详细地址</th>
                                            <th width="35px">类型</th>
                                            <th width="35px">价格调整</th>
                                            <th width="35px">最小提前预定时间</th>
                                            <th width="35px">最大提前预定时间</th>
                                            <th width="35px">支付方式</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>
                                                    <a href="{{ url('admin/carPoint?store='.$v->id) }}"
                                                       class="store_name">{{ $v->name }}</a>
                                                </td>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td>{{ $v->person }}</td>
                                                        </tr>
                                                        <tr class="table-border-top">
                                                            <td>{{ $v->phone }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    {{ $v->open_time }}~{{ $v->close_time }}
                                                </td>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td>
                                                                {{ $v->getCity->name or $v->city }}
                                                            </td>
                                                        </tr>
                                                        <tr class="table-border-top">
                                                            <td> {{ $v->location_name }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>{{ $v->type == 1 ? '门店' : '提车点' }}</td>
                                                <td>
                                                    @if($v->type == 1)
                                                        ~
                                                    @else
                                                        <table width="100%" height="100%">
                                                            <tr>
                                                                <td>租金调整 <span style="color: #c9302c;">{{ $v->rent_pre }}
                                                                        %</span></td>
                                                            </tr>
                                                            <tr class="table-border-top">
                                                                <td>手续费调整 <span style="color: #c9302c;">{{ $v->fee }}
                                                                        %</span></td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                </td>
                                                <td>{{ $v->minimal_advance_booking_time }}</td>
                                                <td>{{ $v->the_larges_advance_scheduled_time }}</td>
                                                <td>{{ $v->pay_method_name->name }}</td>
{{--                                                <td>{{ $v->diff_store_rank }}</td>--}}
                                                <td>
                                                    @if(\App\Model\Admin::getAdmin()->is_supper_admin == 1)
                                                        <a href="{{ url('admin/store/'.$v->id.'/edit')  }}"
                                                           class="btn btn-info btn-xs">编辑</a>
                                                    @else
                                                        <a href="{{ url('admin/store/'.$v->id.'/edit')  }}"
                                                           class="btn btn-info btn-xs">设置</a>
                                                    @endif
                                                    @if(\App\Model\Admin::getAdmin()->is_supper_admin == 1)
                                                        <select class="status" data-id="{{ $v->id }}">
                                                            <option value="1" @if($v->status == 1) selected @endif>已启用
                                                            </option>
                                                            <option value="0" @if($v->status == 0) selected @endif>已禁用
                                                            </option>
                                                        </select>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pull-right links">
                                    @if(method_exists($list, 'appends'))
                                        {{ $list->appends($_GET)->links() }}
                                    @endif
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
<link rel="stylesheet" href="{{ asset('public/css/admin/store.css') }}">
<style>
    .store_name {
        text-decoration: underline;
    }
</style>
@endpush

@push('addjs')

<script>
    $(function () {
        @foreach ($errors -> all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach
    });

    $(function () {
        $('.status').on('change', function () {
            $.postData('/admin/store_status', {id: $(this).data('id')}, function () {
                $.alert('操作成功');
            });
        });
    });
</script>

@endpush