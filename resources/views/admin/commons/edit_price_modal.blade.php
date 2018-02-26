<!-- Modal -->
<div class="modal fade" id="add_admin_modal" tabindex="-1" role="dialog" aria-labelledby="add_admin_modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">编辑价格</h4>
            </div>
            <div class="modal-body">
                <form id="add_admin_modal_form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name">管理员名称</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="建议填写[真实姓名@手机号]方便联系" required>
                            </div>
                            <div class="form-group">
                                <label for="account">账号</label>
                                <input type="text" class="form-control" id="account" placeholder="登录账号" required
                                       name="account">
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" id="password" placeholder="登录密码" required name="password"  maxlength="20">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">确认密码</label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="登录密码" required
                                       name="password_confirmation" maxlength="20">
                            </div>
                            <input type="hidden" name="store" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary add_admin_modal-save">保存修改</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#add_admin_modal').on('show.bs.modal', function (e) {
        data = e.relatedTarget;
        if(data.store){
            $('[name=store]').val(data.store);
            $('.has-store').show();
        }

    });

    $('#add_admin_modal').on('hide.bs.modal', function () {
        console.log('add_admin_modal hide');
    });

    $('#model-car-com-name').keypress(function (e) {
        var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (keyCode == 13) {
            model_car_com_save();
        }
    });

    $('.add_admin_modal-save').on('click', add_admin_modal_save);

    function add_admin_modal_save() {
        var form = $('#add_admin_modal_form');
        var formdata = new FormData(form[0]);

        data = {};
        data.name = formdata.get('name');
        data.account = formdata.get('account');
        data.password = formdata.get('password');
        data.password_confirmation = formdata.get('password_confirmation');
        data.store = formdata.get('store');

        $.postData('/admin/admin', data, function (res) {
            if (res.result.code == 1) {
                form[0].reset();
                $('#add_admin_modal').modal('toggle');
                layui.use('layer', function () {
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