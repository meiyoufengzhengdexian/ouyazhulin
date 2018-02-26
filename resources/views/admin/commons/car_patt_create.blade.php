<!-- Modal -->
<div class="modal fade" id="car-model-create" tabindex="-1" role="dialog" aria-labelledby="car-model-create-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="car-patt-create-label">添加车厢类型</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="model-model-name">名称：</label>
                                <input type="text" class="form-control" id="model-model-name">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-model-save">保存修改</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#car-model-create').on('shown.bs.modal', function(e){
        console.log(e.relatedTarget.id);
    });

    $('#car-model-create').on('hide.bs.modal', function(){
        var $select = $('[name=model]');
        $.getData('/admin/car_model', [], function(res){
            if(res.result.code == 1){
                $select.empty();
                $.each(res.data, function(key, value){
                    var o = new Option(value.name, value.id);
                    $select.append(o);
                });
            }
        });
    });

    $('#model-model-name').keypress(function(e){
        var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (keyCode == 13){
            model_model_name_save();
        }
    });
    $('.model-model-save').on('click', function(){
        var data = {
            name:$('#model-model-name').val()
        };
        $.postData('/admin/car_model', data, model_model_name_save);
    });
    function model_model_name_save(res){
        if(res.result.code == 1){
            layui.use('layer', function(){
                $('#car-model-create').modal('hide');
                layer.msg('添加成功');
                $('#model-model-name').val('')
            });
        }
    }
</script>