@extends('layout.admin')

@section('right_col')
<div class="right_col">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Price_info列表</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
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
                                                                                                                                                                                <th width="35px">订单价格</th>
                                                                                                                                                                                <th width="35px">基础服务费</th>
                                                                                                                                                                                <th width="35px">服务费</th>
                                                                                                                                                                                <th width="35px">超小时费/每小时</th>
                                                                                                                                                                                <th width="35px">超公里费/每公里</th>
                                                                                                                                                                                <th width="35px">基础授权费</th>
                                                                                                                                                                                <th width="35px">违章押金</th>
                                                                                                                                                                                <th width="35px">异地还车费</th>
                                                                                                                                                                                <th width="35px">夜间取车费</th>
                                                                                                                                                                                <th width="35px">夜间换车费</th>
                                                                                                                                                                                <th width="35px">夜间开始时间</th>
                                                                                                                                                                                <th width="35px">夜间结束时间</th>
                                                                                                                                                                                <th width="35px">平台</th>
                                                                                                                                                                                                                                                                                                                                                                                        <th width="75px">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $v)
                                    <tr>
                                                                                                                                    <td>{{ $v->id }}</td>
                                                                                                                                                                                <td>{{ $v->price }}</td>
                                                                                                                                                                                <td>{{ $v->basic_service_fee }}</td>
                                                                                                                                                                                <td>{{ $v->service_fee }}</td>
                                                                                                                                                                                <td>{{ $v->ultra_hour_fee }}</td>
                                                                                                                                                                                <td>{{ $v->ultra_km_fee }}</td>
                                                                                                                                                                                <td>{{ $v->pre_authorization_fee }}</td>
                                                                                                                                                                                <td>{{ $v->Illegal_deposit }}</td>
                                                                                                                                                                                <td>{{ $v->off_site_fee }}</td>
                                                                                                                                                                                <td>{{ $v->night_pickup_fee }}</td>
                                                                                                                                                                                <td>{{ $v->night_return_fee }}</td>
                                                                                                                                                                                <td>{{ $v->night_start }}</td>
                                                                                                                                                                                <td>{{ $v->night_end }}</td>
                                                                                                                                                                                <td>{{ $v->platform }}</td>
                                                                                                                                                                                                                                                                                                                                                
                                        <td>
                                            <a href="{{ url('admin/price_info/'.$v->id.'/edit')  }}" class="btn btn-info btn-xs">编辑</a>
                                            <a href="{{ url('admin/price_info', ['id'=>$v->id])  }}"
                                               class="btn btn-danger btn-xs del">删除</a>
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
<script>
    $(function () {
        $('#datatable').DataTable();
        $('body').on('click', '.del', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var _this = this;
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function (res) {
                    var status = res.status | 0;
                    if (status) {
                        $(_this).parents('tr').fadeOut(300, function () {
                            $(this).remove();
                        });
                    }
                },
                error: function (res) {
                    console.log(res);
                }
            });
        });
        @foreach ($errors -> all() as $e)
        new PNotify({
            title: 'Oh No!',
            text: '{{ $e }}',
            type: 'error'
        });
        @endforeach
    });


</script>
@endpush