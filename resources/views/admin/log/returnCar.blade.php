<table class="table table-bordered">
    <tr>
        <td colspan="4">
            还车
        </td>
    </tr>
    <tr>
        <td align="right" valign="middle">还车时间：</td>
        <td>{{ $p->return_time }}</td>
        <td align="right" valign="middle">Admin：</td>
        <td>{{  $p->admin }}</td>
    </tr>
    <tr>
        <td align="right" valign="middle">油量差：</td>
        <td>{{ $p->diff_oil }}L</td>
        <td align="right" valign="middle">还车里程：</td>
        <td>{{ $p->return_km }}km</td>
    </tr>
    <tr>
        <td align="right" valign="middle">超公里数：</td>
        <td>{{ $p->ultra_km }}km</td>
        <td align="right" valign="middle">超小时数：</td>
        <td>{{ $p->ultra_hour }}h</td>
    </tr>
    <tr>
        <td align="right" valign="middle">违章罚款：</td>
        <td>¥{{ $p->Illegal_deposit }}</td>
        <td align="right" valign="middle">其他费用：</td>
        <td>¥{{ $p->oth_fee }}</td>
    </tr>
    <tr>
        <td align="right" valign="middle">仍需支付：</td>
        <td> <span class="bg-blue">¥{{ $p->need_pay }}</span></td>
        <td align="right" valign="middle"></td>
        <td></td>
    </tr>
    <tr>
        <td align="right" valign="middle">备注：</td>
        <td colspan="3">
            <p>
                {{ $p->desc }}
            </p>
        </td>
    </tr>
</table>