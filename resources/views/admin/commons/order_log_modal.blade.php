<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>
<div class="modal fade bs-example-modal-lg" id="order_log_modal" tabindex="-1" role="dialog"
     aria-labelledby="order_log_modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">订单日志</h4>
            </div>
            <div class="modal-body">
                <template v-for="(log, key) in logs">
                    <div class="row">
                        <div class="col-md-12">
                            <code>@{{ log.created_at }}</code>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" v-html="log.message"></div>
                    </div>
                </template>
                <template v-if="logs.lenght == 0">
                    <div class="row">
                        <div class="col-md-12">
                            无日志信息
                        </div>
                    </div>
                </template>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>

    $order_log_modal_vue = new Vue({
        el: '#order_log_modal',
        data: {
            order: {},
            logs: []
        },
        methods: {
            refresh: function () {
                var url = '/admin/orderLog';
                var data = {
                    order: this.order.id
                };
                var vthis = this;
                $.load();
                $.getData(url, data, function (res) {
                    $.close();
                    if (res.result.code == 1) {
                        vthis.logs = res.log;
                    } else {
                        $.alert(res.result.message);
                    }
                }, function () {
                    $.close();
                    return true;
                })
            }
        },
        created: function () {

        }
    });

    $('#order_log_modal').on('shown.bs.modal', function (e) {
//        $img = e.relatedTarget.$img;
//        $imgInput = e.relatedTarget.$imgInput;
//        $img_modal_vue.img_path = e.relatedTarget.defaultImg;
        order = e.relatedTarget.order;
        $order_log_modal_vue.order = order;
        $order_log_modal_vue.refresh();
    });
    $('#order_log_modal').on('hide.bs.modal', function () {
    });

</script>