<!-- Modal -->
<div class="modal fade" id="car-com-create" tabindex="-1" role="dialog" aria-labelledby="car-com-create-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">添加车辆品牌</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="model-car-com-name">名称：</label>
                                <input type="text" class="form-control" id="model-car-com-name">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-car-com-save">保存修改</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#car-com-create').on('hide.bs.modal', function(){
        var $select = $('[name=com]');
        $.getData('/admin/car_com', [], function(res){
            if(res.result.code == 1){
                $select.empty();
                $.each(res.data, function(key, value){
                    var o = new Option(value.sort + value.name, value.id);
                    $select.append(o);
                });
            }
        });
    });

    $('#model-car-com-name').keypress(function(e){
        var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (keyCode == 13){
            model_car_com_save();
        }
    });
    $('.model-car-com-save').on('click', model_car_com_save);

    function model_car_com_save(){
        var data = {
            name:$('#model-car-com-name').val()
        };
        $.postData('/admin/car_com', data, function(res){
            if(res.result.code == 1){
                layui.use('layer', function(){
                    $('#car-com-create').modal('hide');
                    $('#model-com-name').val('');
                    layer.msg('添加成功');
                });
            }
        });
    }
</script>