@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>车辆列表</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <button class="btn btn-primary btn-sm" type="button" id="add_car">添加车辆</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="key" name="key" value="{{$request->input('key', '')}}" style="margin-left: 10px;">
                                        <button class="btn btn-dark btn-xs">搜索</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th width="35px">id</th>
                                            <th width="35px">车辆型号</th>
                                            <th width="35px">车辆牌照</th>
                                            <th width="35px">行驶公里数</th>
                                            <th width="35px">颜色</th>
                                            <th width="35px">状态</th>
                                            <th width="35px">所属门店</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $v)
                                            <tr>
                                                <td>{{ $v->id }}</td>
                                                <td>{{ $v->car_patt_name->name }}</td>
                                                <td>{{ $v->license_plate }}</td>
                                                <td>{{ $v->km }}</td>
                                                <td>{{ $v->color }}</td>
                                                <td>{{ $v->status }}</td>
                                                <td>
                                                    <a href="{{ url('admin/carPoint?store='.$v->store) }}"
                                                       class="store_name">{{ $v->getStore->name }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/car/'.$v->id.'/edit')  }}"
                                                       class="btn btn-info btn-xs">编辑</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(method_exists($list, 'appends'))
                                    {{ $list->appends($_GET)->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.commons.add_car_modal')
    </div>


@endsection

@push('addcss')
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
    $('#add_car').on('click', function () {
        $('#add_car_modal').modal('toggle', {
            store: $('.data').data('store')
        });
    });

    $('#add_store_admin').on('click', function () {
        $('#add_admin_modal').modal('toggle', {
            store: $('.data').data('store')
        });
    });
</script>
@endpush