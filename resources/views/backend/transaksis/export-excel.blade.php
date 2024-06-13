<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($rows as $transaksi)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $transaksi->code }}</td>
                <td>{{ $transaksi->date }}</td>
                <td>{{ $transaksi->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
