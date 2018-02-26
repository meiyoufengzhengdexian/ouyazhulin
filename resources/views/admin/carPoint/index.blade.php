@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="data" data-store="{{$request->store}}">
            <div class="page-title">
                <div class="title_left">
                    <h3>提车点</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <button class="btn btn-primary btn-sm" type="button" id="add_store_admin">添加管理员</button>
                            <button class="btn btn-primary btn-sm" type="button" id="add_car">添加车辆</button>
                            <a href="{{url('admin/car?store='.$store->id)}}" class="btn btn-link btn-sm">查看车辆</a>
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
                                            <th width="35px">提车点名称</th>
                                            <th width="35px">联系人</th>
                                            <th width="35px">营业时间</th>
                                            <th width="35px">详细地址</th>
                                            <th width="35px">价格调整</th>
                                            <th width="35px">最小提前预定时间</th>
                                            <th width="35px">最大提前预定时间</th>
                                            <th width="35px">支付方式</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($carPoints as $v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>{{ $v->name }}</td>
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
                                                <td>{{ $v->open_time }}~{{ $v->close_time }}
                                                </td>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td>{{ $v->getCity->name }}</td>
                                                        </tr>
                                                        <tr class="table-border-top">
                                                            <td> {{ $v->location_name }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    @if($v->type == 1)
                                                        ~
                                                    @else
                                                        <table width="100%" height="100%">
                                                            <tr>
                                                                <td>租金 <span style="color: #c9302c;">{{ $v->rent_pre }}
                                                                        %</span></td>
                                                            </tr>
                                                            <tr class="table-border-top">
                                                                <td>手续费 <span style="color: #c9302c;">{{ $v->fee }}
                                                                        %</span></td>
                                                            </tr>
                                                        </table>
                                                    @endif
                                                </td>
                                                <td>{{ $v->minimal_advance_booking_time }}</td>
                                                <td>{{ $v->the_larges_advance_scheduled_time }}</td>
                                                <td>{{ $v->pay_method_name->name }}</td>
                                                <td>
                                                    <a href="{{ url('admin/store/'.$v->id.'/edit')  }}"
                                                       class="btn btn-info btn-xs">编辑</a>
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
        @include('admin.commons.add_car_modal')
        @include('admin.commons.add_admin_modal')
    </div>

@endsection

@push('addcss')
<link rel="stylesheet" href="{{ asset('public/css/admin/store.css') }}">
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

</script>
<script>
    $('#add_car').on('click', function(){
        $('#add_car_modal').modal('toggle', {
            store:$('.data').data('store')
        });
    });

    $('#add_store_admin').on('click', function(){
        $('#add_admin_modal').modal('toggle', {
            store:$('.data').data('store')
        });
    });
</script>
@endpush