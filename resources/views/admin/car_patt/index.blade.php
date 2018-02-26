@extends('layout.admin')

@section('right_col')

    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>车型</h3>
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
                                           style="vertical-align: middle; margin-bottom: 0;" v-cloak>
                                        <thead>
                                        <tr>
                                            <th width="35px">id</th>
                                            <th width="35px">车辆品牌</th>
                                            <th width="35px">车辆型号名</th>
                                            <th width="35px">乘坐人数</th>
                                            <th width="35px">行李箱数</th>
                                            <th width="35px">厢式</th>
                                            <th width="35px">油箱容量</th>
                                            <th width="35px">车辆类型</th>
                                            <th width="35px">变速箱类型</th>
                                            <th width="35px">状态</th>
                                            <th width="75px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, key) in list" :key="key">
                                                <td>@{{ item.id }}</td>
                                                <td>@{{ item.get_com_name.name }}</td>
                                                <td>@{{ item.name }}</td>
                                                <td>@{{ item.site }}</td>
                                                <td>@{{ item.luggage }}</td>
                                                <td>@{{ item.car_model_name.name }}</td>
                                                <td>@{{ item.fuel_tank_capacity }}</td>
                                                <td>@{{ item.car_type_name.name }}</td>
                                                <td>@{{ item.transmission_namename }}</td>
                                                <td>@{{ item.status == 1 ? '启用' : '禁用'  }}</td>
                                                <td>
                                                    <a :href="'/admin/car_patt/'+ item.id + '/edit'"
                                                       class="btn btn-info btn-xs">编辑</a>
                                                </td>
                                            </tr>
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
    <link href="{{ asset('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
          rel="stylesheet">

@endpush

@push('addjs')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
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
        carPattVue = new Vue({
            el: '#datatable',
            data:{
                list:{!! json_encode($list) !!}
            },
            methods:{

            },
            mounted:function () {
                $('#datatable').DataTable();
            },
            created:function () {
                
            }
        });
        $(function () {

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

        @if (\Illuminate\Support\Facades\Session::has('success'))
        new PNotify({
            title: '操作成功!',
            text: '{{\Illuminate\Support\Facades\Session::get('success')}}',
            type: 'success'
        });
        @endif
    </script>

@endpush