<!-- Modal -->
<script src="{{ asset('/public/js/jquery-laravel-ajax.js') }}"></script>

<div class="modal fade bs-example-modal-lg" id="time-modal" tabindex="-1" role="dialog"
     aria-labelledby="time-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">时间</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-label-left form-time-modal">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="minimal_advance_booking_time">修改时间</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <input type="number" placeholder="天" name="_m_d" class="form-control" min="0">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <select name="_m_i" class="form-control">
                                        <option value="0">小时</option>
                                        @for($i=0; $i<24; ++$i)
                                            <option value="{{ $i }}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <select name="_m_m" class="form-control">
                                        <option value="0">分钟</option>
                                        <option value="0">0</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-city-confirm"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    $time_modal_vue = new Vue({
        el: '#time-modal',
        data: {
            day_dom: {},
            h_dom: {},
            m_dom: {}
        },
        methods: {

        }
    });

    $('#time-modal').on('shown.bs.modal', function (e) {
        $time_modal_vue.day_dom = e.relatedTarget.day_dom;
        $time_modal_vue.h_dom = e.relatedTarget.h_dom;
        $time_modal_vue.m_dom = e.relatedTarget.m_dom;
        $time_modal_vue.show_dom = e.relatedTarget.show_dom;
        $time_modal_vue.flag_dom = e.relatedTarget.flag_dom;

    });
    $('#time-modal').on('hide.bs.modal', function () {

    });

    $('.model-city-confirm').on('click', function () {
        root = $('#time-modal');

        $($time_modal_vue.day_dom).val(root.find('[name=_m_d]').val());
        $($time_modal_vue.h_dom).val(root.find('[name=_m_i]').val());
        $($time_modal_vue.m_dom).val(root.find('[name=_m_m]').val());
        $( $time_modal_vue.show_dom).html(root.find('[name=_m_d]').val() + '天' + root.find('[name=_m_i]').val() + '时' + root.find('[name=_m_m]').val() + '分');
        $($time_modal_vue.flag_dom).val(1);
        $('.form-time-modal')[0].reset();
        $('#time-modal').modal('hide');
    });


</script>