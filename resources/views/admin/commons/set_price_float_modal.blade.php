<!-- Modal -->
<style>
    .bs-callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;
    }

    .bs-callout-danger {
        border-left-color: #ce4844;
    }
</style>
<div class="modal fade bs-example-modal-lg" id="set_price_float_modal" tabindex="-1" role="dialog"
     aria-labelledby="set_price_float_modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">设置价格浮动</h4>
            </div>
            <div class="modal-body">
                <div class="bs-callout bs-callout-danger" id="callout-overview-not-both">
                    <ol>
                        <li> <code>周浮动：</code>即每周N的价格，每周统一。可以单独将周末价设高提高收益</li>
                        <li> <code>日期浮动：</code>即设置一段 <code>日期</code>，在此时间段内价格按照此价来售卖。节假日库存紧张，可调整租金！</li>
                        <li> <code>小时浮动：</code>即设置一段 <code>时间</code>，在此时间段内价格按照此价来售卖。可调整租金！</li>
                    </ol>
                </div>

                <form class="set_price_float_modal_form">
                    <div class="form-group">
                        <label for="num">浮动值</label>
                        <input type="number" class="form-control" name="num" placeholder="浮动值">
                    </div>
                    <div class="input-group">
                        <label><input type="radio"  name="num_type" value="1" checked> 百分比 <code>%</code></label>
                        <label style="padding-left:20px"><input type="radio" name="num_type" value="2">
                            固定值 <code>¥</code></label>
                    </div>
                    <div class="form-group">
                        <select name="float_type" id="float_type" class="form-control">
                            <option value="week_range">星期浮动</option>
                            <option value="date_range">日期浮动</option>
                            <option value="time_range">小时浮动</option>
                        </select>
                    </div>
                    {{--星期浮动--}}
                    <div class="form-group" id="week">
                        <select name="week" class="form-control">
                            @for($i=1; $i<8; $i++)
                                <option value="{{$i}}">星期@if($i==7)日 @else{{ $i }}@endif</option>
                            @endfor
                        </select>
                    </div>
                    {{--日期浮动--}}
                    <div class="form-group" style="display: none" id="date">
                        <div class="row" style="padding:0 10px">
                            <table width="100%">
                                <tr>
                                    <td>起始日期</td>
                                    <td><input type="text" class="form-control" name="start_date"></td>
                                    <td>结束日期</td>
                                    <td><input type="text" class="form-control" name="end_date"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- 时间 --}}
                    <div class="form-group" style="display: none" id="time">
                        <div class="row" style="padding:0 10px">
                            <table width="100%">
                                <tr>
                                    <td>起始时间</td>
                                    <td><input type="text" class="form-control" name="start_time"></td>
                                    <td>结束时间</td>
                                    <td><input type="text" class="form-control" name="end_time"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>

                <div class="bs-callout bs-callout-danger" id="callout-overview-not-both">

                    <h4>价格逻辑：</h4>
                    <ol>
                        <li></li>
                        <li><code>日期浮动>小时浮动>周浮动</code>，因此如果当三者在某一天价格出现重复时，
                            <code>优先</code>显示 <code>日期</code>浮动价格，<code>以此类推！</code></li>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary model-price-float-confirm"> 确定</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
    price = null;
    $('#set_price_float_modal').on('shown.bs.modal', function (e) {
//        $img = e.relatedTarget.$img;
//        $imgInput = e.relatedTarget.$imgInput;
//        $img_modal_vue.img_path = e.relatedTarget.defaultImg;

        price = e.relatedTarget.price;

    });
    $('#set_price_float_modal').on('hide.bs.modal', function () {
    });

    $('.model-img-confirm').on('click', function () {
//        if (current_img != null) {
//            $img.attr('src', current_img);
//            $imgInput.val(current_img);
//        }
//        $('#set_price_float_modal').modal('hide');
    });

    $(function(){
        $root = $('#set_price_float_modal');

        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem:$('[name=start_date]')[0],
                theme: '#2a3f54'
            });
            laydate.render({
                elem:$('[name=end_date]')[0],
                theme: '#2a3f54'
            });
            laydate.render({
                elem:$('[name=start_time]')[0],
                type:'time',
                theme: '#2a3f54'
            });
            laydate.render({
                elem:$('[name=end_time]')[0],
                type:'time',
                theme: '#2a3f54'
            })
        });

        $('#float_type').on('change', function(){
            switch ($(this).val()){
                case 'date_range':
                    $('#time').hide();
                    $('#week').hide();
                    $('#date').show();
                    break;
                case 'time_range':
                    $('#date').hide();
                    $('#week').hide();
                    $('#time').show();
                    break;
                case 'week_range':
                    $('#time').hide();
                    $('#date').hide();
                    $('#week').show();
                    break;
            }
        });

        $('.model-price-float-confirm').on('click', function(){
            loadIndex = $.load();
            $.log(loadIndex);
            var data = {
                price: price,
                num : $('[name=num]').val(),
                num_type: $('[name=num_type]:checked').val(),
                float_type : $('#float_type').val()

            };
            if(data.float_type == 'date_range'){

                data.start_date = $('[name=start_date]').val();
                data.end_date = $('[name=end_date]').val();

            }else if(data.float_type == 'time_range'){
                data.start_time = $('[name=start_time]').val();
                data.end_time = $('[name=end_time]').val();
            }else if(data.float_type == 'week_range'){
                data.week = $('[name=week]').val();
            }

            $.postData('/admin/price_float', data, function(res){
                if(res.result.code ==1){
                    $('.set_price_float_modal_form')[0].reset();
                    $('#week').show();
                    $('#date').hide();
                    $('#time').hide();
                    $.close(loadIndex);
                    $('#set_price_float_modal').modal('hide');
                    $.alert('设置成功');
                }
                return true;
            }, function(){
                $.close();
                return true;
            })
        });
    });



</script>