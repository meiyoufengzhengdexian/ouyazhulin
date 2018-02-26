<?php
$admin = \App\Model\Admin::getAdmin();
if($admin->is_supper_admin){
    $stores = \App\Model\Store::all();
}else{
    $stores = $admin->getStores;
}
?>
<!-- Modal -->
<div class="modal fade" id="add_car_modal" tabindex="-1" role="dialog" aria-labelledby="add_car_modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">添加车辆</h4>
            </div>
            <div class="modal-body">
                <form id="add_car_modal_form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="store">所属门店</label>
                            <select name="store" id="store" class="form-control">
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="car_com">车辆品牌</label>
                                    <select id="car_com" class="form-control">
                                        <option value="all">全部</option>
                                        @foreach($carComs as $carCom)
                                            <option value="{{ $carCom->id }}">{{ $carCom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="car_patt">车辆型号</label>
                                    <select name="car_patt" id="car_patt" class="form-control">
                                        @foreach($carPatts as $carPatt)
                                            <option value="{{ $carPatt->id }}">{{ $carPatt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="license_plate">车牌号</label>
                            <input type="text" class="form-control" id="license_plate" placeholder="车牌号" required
                                   name="license_plate">
                        </div>
                        <div class="form-group">
                            <label for="km">已行驶公里数</label>
                            <input type="text" class="form-control" id="km" placeholder="Km" required name="km">
                        </div>
                        <div class="form-group">
                            <label for="color">车辆颜色</label>
                            <input type="text" class="form-control" id="color" placeholder="车身颜色" required name="color">
                        </div>
                        <div class="form-group">
                            <label for="status">状态</label>
                            <select name="status" id="status" class="form-control">
                                @foreach($carStatus as $status)
                                    <option value="{{ $status['id'] }}" @if($status['default']) selected @endif>{{ $status['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary add_car_modal-save">保存修改</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#add_car_modal').on('show.bs.modal', function (e) {
        data = e.relatedTarget;
    });
    $('#add_car_modal').on('hide.bs.modal', function () {
        console.log('add_car_modal hide');
    });

    $('#model-car-com-name').keypress(function (e) {
        var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (keyCode == 13) {
            model_car_com_save();
        }
    });

    $('.add_car_modal-save').on('click', add_car_modal_save);

    function add_car_modal_save() {
        var form = $('#add_car_modal_form');
        var formdata = new FormData(form[0]);

        data = {};
        data.car_patt = formdata.get('car_patt');
        data.license_plate = formdata.get('license_plate');
        data.km = formdata.get('km');
        data.color = formdata.get('color');
        data.status = formdata.get('status');
        data.store = formdata.get('store');

        $.postData('/admin/car', data, function(res){
            if(res.result.code == 1){
                form[0].reset();
                $('#add_car_modal').modal('toggle');
                layui.use('layer', function(){
                    layui.layer.msg('添加成功');
                });
            }
        })
    }

    var car_patt = {!! json_encode($carPatts) !!};
    $('#car_com').on('change', function () {
        $this = $(this);
        $('[name=car_patt]').empty().append(new Option('暂无'));
        $.each(car_patt, function (key, value) {
            if (value.com == $this.val() || $this.val() == 'all') {
                if ($('[name=car_patt] option').length == 1 && $('[name=car_patt] option').html() == '暂无') {
                    $('[name=car_patt]').empty();
                }

                $('[name=car_patt]').append(new Option(value.name, value.id));
            }
        });
    });
</script>