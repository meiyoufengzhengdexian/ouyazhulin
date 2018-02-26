<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<style>


</style>
<div class="modal fade bs-example-modal-lg" id="order-desc-modal" tabindex="-1" role="dialog"
     aria-labelledby="order-desc-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label" v-model="desc">订单备注</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="3" placeholder="订单备注" v-model="desc"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary order-desc-confirm" @click="order_desc"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>

    $order_desc_vue = new Vue({
        el: '#order-desc-modal',
        data: {
            desc:'',
            order:{}
        },
        methods: {
            refreshDesc:function () {
                this.desc = this.order.desc;
            },
            order_desc: function () {
                $.load();
                vthis = this;
                $.postData('/admin/orderDesc', {
                    order:this.order.id,
                    desc: this.desc
                }, function(res){
                    $.close();
                    if(res.result.code == 1){
                        $.msg('更新成功');
                        vthis.order.desc = vthis.desc;
                        $('#order-desc-modal').modal('hide');
                    }else{
                        $.alert(res.result.message);
                    }
                })
            }
        },
        created: function () {

        }
    });

    $('#order-desc-modal').on('shown.bs.modal', function (e) {
//        $img = e.relatedTarget.$img;
//        $imgInput = e.relatedTarget.$imgInput;
//        $img_modal_vue.img_path = e.relatedTarget.defaultImg;
        $order_desc_vue.order = e.relatedTarget.order;
        $order_desc_vue.refreshDesc();

    });
    $('#order-desc-modal').on('hide.bs.modal', function () {
    });


</script>