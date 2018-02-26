@extends('layout.admin')

@section('right_col')
    <div class="right_col">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>管理的门店</h3>
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
                            <form action="{{ url('admin/user/addStore') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$id}}">

                                <button></button>
                            <div id="table" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-striped table-bordered dataTable no-footer"
                                           style="vertical-align: middle; margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th width="35px">&nbsp;</th>
                                            <th width="35px">id</th>
                                            <th width="35px">门店名</th>
                                            <th width="35px">城市</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($store as $v)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="stores[]" value="{{$v->id}}" @if($exists_stores->contains($v)) checked @endif>
                                                </td>
                                                <td>{{ $v->id }}</td>
                                                <td>{{$v->name}}</td>
                                                <td>{{ $v->getCity->name }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                <div style="clear: both; height: 20px;"></div>
                                <button type="submit" class="btn btn-primary btn-sm">批量添加</button>
                                <a type="submit" class="btn btn-link btn-sm" href="{{ url('admin/user') }}">返回</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addcss')

@endpush

@push('addjs')

<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
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

    @if (\Illuminate\Support\Facades\Session::has('success'))
    new PNotify({
        title: '操作成功',
        text: "{{\Illuminate\Support\Facades\Session::get('success')}}",
        type: 'success'
    });
    @endif

</script>
@endpush