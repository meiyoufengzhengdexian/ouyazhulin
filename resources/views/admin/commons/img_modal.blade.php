<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>


    .modal-body {

    }

    .dui {
        border: 2px solid #F00;
        width: 71px;
    }

</style>
<div class="modal fade bs-example-modal-lg" id="img-modal" tabindex="-1" role="dialog"
     aria-labelledby="img-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">上传图片</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <label for="uploadfile">
                            <img :src="img_path" class="img-responsive upload_img">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="form-inline">
                            <input type="file" name="upload_file" class="form-control" id="uploadfile" @change="upload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-img-confirm"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    current_img = null;
    $imgInput = null;
    defaultImg = '/public/images/dui.png';

    $img_modal_vue = new Vue({
        el: '#img-modal',
        data: {
            img_path: '',
            pre_view: ['pre_view']
        },
        methods: {
            upload: function () {
                var data = new FormData();
                if($('#uploadfile')[0].files.length == 0 ){
                    return;
                }
                data.append('uploadImg', $('#uploadfile')[0].files[0]);
                vthis = this;
                $('.model-img-confirm').html('请等待...');
                if (!$('.model-img-confirm')[0].hasAttribute('disabled')) {
                    $('.model-img-confirm').attr('disabled', 'disabled')
                }
                $.ajax({
                    url: '/admin/vue/img',
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status == true) {
                            vthis.img_path = '/storage/app/' + res.img.path;
                            current_img = vthis.img_path;
                            $('.model-img-confirm').html('确定').removeAttr('disabled');
                        }
                    }
                });
            }
        },
        created: function () {

        }
    });

    $('#img-modal').on('shown.bs.modal', function (e) {
        $img = e.relatedTarget.$img;
        $imgInput = e.relatedTarget.$imgInput;
        $img_modal_vue.img_path = e.relatedTarget.defaultImg;

    });
    $('#img-modal').on('hide.bs.modal', function () {
    });

    $('.model-img-confirm').on('click', function () {
        if (current_img != null) {
            $img.attr('src', current_img);
            $imgInput.val(current_img);
        }
        $('#img-modal').modal('hide');
    });

</script>