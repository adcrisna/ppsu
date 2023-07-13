<table>
    <thead>
        <tr>
            <th>No</th>&nbsp;
            <th>Mulai</th>
            <th>Selesai</th>
            <th>TIM</th>
            <th>Sumber Informasi</th>
            <th>Kondisi Lapangan</th>
            <th>Penanganan</th>
            <th>Proses Pengerjaan</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kegiatan as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ @$value->tanggal_mulai }}</td>
                <td>{{ @$value->tanggal_selesai }}</td>
                <td>{{ @$value->Tim->name }}</td>
                <td>{{ @$value->sumber_informasi }}</td>
                <td>{{ @$value->kondisi_lapangan }}</td>
                <td>{{ @$value->penanganan }}</td>
                <td>{{ @$value->proses_pengerjaan }}</td>
                <td>{{ @$value->keterangan }}</td>
                <td>{{ @$value->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
