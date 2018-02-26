<table class="table table-bordered">
    <tr>
        <td colspan="4">
            取车
        </td>
    </tr>
    <tr>
        <td align="right">实际取车时间：</td>
        <td colspan="3">{{ $p->pickup_time }}</td>
    </tr>
    <tr>
        <td align="right">取车油量：</td>
        <td>
            {{ $p->oil }} 升
        </td>
        <td align="right">取车里程：</td>
        <td>{{ $p->km }} km</td>
    </tr>
    <tr>
        <td align="right">其他费用：</td>
        <td colspan="3">{{ $p->oth_fee }}</td>
    </tr>
    <tr>
        <td align="right">取车备注：</td>
        <td colspan="3">
            {{ $p->desc }}
        </td>
    </tr>
    <tr>
        <td colspan="" align="right">
            已支付金额:
        </td>
        <td colspan="3">
            <p>¥{{ $p->paid }}</p>
        </td>
    </tr>
</table>