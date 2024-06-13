<!doctype html>
<html lang="en">

<head>
    <title>Invoice {{ $row->code }}</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14pt;
    }

    .header {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    table.data {
        border: 1px solid;
        width: 100%;
        border-collapse: collapse;
    }

    table.data>tbody>tr>td {
        border: 1px solid;
        padding: 5px;
    }

    table.data>thead>tr>th {
        border: 1px solid;
        background-color: #eaeaea;
        padding: 5px;
    }

    table.data>tbody>tr>th {
        border: 1px solid;
        background-color: #eaeaea;
        padding: 5px;
        text-align: left;
    }
</style>

<body>
    <div class="header">
        <h1>Invoice Pesanan</h1>
        <h2>{{ $row->code }}</h2>
    </div>
    <table class="data">
        <tr>
            <th>Nama Menu</th>
            <th>@</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        @php
            $counter = 1;
            $subtotal = 0;
        @endphp
        @foreach ($row->ItemTransaksi as $item)
            @php
                $subtotal += $item->price * $item->qty;
            @endphp
            <tr>
                <td>{{ isset($item->Menu) ? $item->Menu->nama : 'Menu Tidak Ditemukan' }}</td>
                <td class="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="right">{{ $item->qty }}</td>
                <td class="right">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: center; font-weight: bold;">Discount ({{ $row->discount }}%) :</td>
            <td class="right">Rp {{ number_format($subtotal * ($row->discount / 100), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; font-weight: bold;">Total :</td>
            @php
                $discountedAmount = $subtotal * ($row->discount / 100);
                $totalAfterDiscount = $subtotal - $discountedAmount;
            @endphp
            <td class="right">Rp {{ number_format($totalAfterDiscount, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
