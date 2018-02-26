<?php
$priceFloatList = \App\Model\Price_float::where('price', $data->id)->orderBy('created_at', 'desc')->orderBy('float_type')->get();
?>

<div class="modal fade bs-example-modal-lg" id="price_float_cat_modal" tabindex="-1" role="dialog"
     aria-labelledby="price_float_cat_modal-label">
    <div class="modal-dialog modal-lg" role="document" id="price_float_cat_vue">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="car-patt-create-label">查看此价格浮动</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>浮动类型</td>
                        <td>浮动范围</td>
                        <td>浮动值</td>
                        <td>创建日期</td>
                        <td>操作</td>
                    </tr>

                    <template v-if="list.length > 0">
                        <tr v-for="(item, index) in list" :key="item.id">
                            <td>
                                <template v-if="item.float_type == 'week_range'">
                                    周浮动
                                </template>
                                <template v-else-if="item.float_type == 'date_range'">
                                    日期浮动
                                </template>
                                <template v-else>
                                    小时浮动
                                </template>
                            </td>
                            <td>
                                <template v-if="item.float_type == 'week_range'">
                                    星期@{{ item.week == 7 ? '日':item.week }}
                                </template>
                                <template v-else-if="item.float_type == 'date_range'">
                                    @{{ item.start_date }} ~ @{{ item.end_date }}
                                </template>
                                <template v-else>
                                    @{{ item.start_time }} ~ @{{ item.end_time }}
                                </template>
                            </td>
                            <td>
                                <code>
                                    @{{ item.num }}<span v-if="item.num_type == 1">%</span><span v-else>¥</span>
                                </code>
                            </td>
                            <td>@{{ item.created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs"
                                        @click="price_float_cat_del(index, item)">删除
                                </button>
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="5" style="text-align: center">暂无数据!</td>
                        </tr>
                    </template>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

<script>

    $('#price_float_cat_modal').on('show.bs.modal', function (e) {
//        $img = e.relatedTarget.$img;
//        $imgInput = e.relatedTarget.$imgInput;
//        $img_modal_vue.img_path = e.relatedTarget.defaultImg;

        price_float_cat_modal.price = e.relatedTarget.price;
        price_float_cat_modal.refresh();
    });
    $('#price_float_cat_modal').on('hide.bs.modal', function () {

    });

    price_float_cat_modal = new Vue({
        el: '#price_float_cat_vue',
        data: {
            list:{!! json_encode($priceFloatList) !!},
            price:0
        },
        methods: {
            refresh: function () {
                var vthis = this;
                $.load();
                $.getData('/admin/price_float', {
                    price: vthis.price
                }, function (res) {
                    if (res.result.code == 1) {
                        vthis.list = res.list;
                    }
                    $.close();
                })
            },
            price_float_cat_del: function (key, item) {
                var vthis = this;
                $.confirm('确定要删除？', function () {
                    $.load();
                    $.ajax({
                        url: '/admin/price_float/' + item.id,
                        type: 'DELETE',
                        success: function (res) {
                            $.close();
                            if (res.result.code == 1) {
                                vthis.list.splice(key, 1);
                            } else {
                                $.alert('删除失败，', res.result.message);
                            }
                        }
                    });
                });
            }
        },
        created: function () {

        }
    });

</script>