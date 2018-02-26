<!-- Modal -->
<div class="modal fade" id="car-transmission-create" tabindex="-1" role="dialog" aria-labelledby="car-transmission-create-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">添加变速箱型号</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="model-car-transmission-name">名称：</label>
                                <input type="text" class="form-control" id="model-car-transmission-name">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-car-transmission-name-save">保存修改</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#car-transmission-create').on('hide.bs.modal', function(){
        var $select = $('[name=transmission]');
        $.getData('/admin/transmission', [], function(res){
            if(res.result.code == 1){
                $select.empty();
                $.each(res.data, function(key, value){
                    var o = new Option(value.name, value.id);
                    $select.append(o);
                });
            }
        });
    });
    $('.model-car-transmission-name-save').on('click',saveTransmission);
    $('#model-car-transmission-name').keypress(function(e){
        var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (keyCode == 13){
            saveTransmission();
        }
    });

    function saveTransmission(){
        var data = {
            name:$('#model-car-transmission-name').val()
        };
        $.postData('/admin/transmission', data, function(res){
            if(res.result.code == 1){
                layui.use('layer', function(){
                    $('#car-transmission-create').modal('hide');
                    $('#model-transmission-name').val('');
                    layer.msg('添加成功');
                });
            }
        });
    }
</script>