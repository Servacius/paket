<tr>
    <td class="text-center">{{ $paket->nik_pemilik }}</td>
    <td>{{ $paket->nama_pemilik }}</td>
    <td>{{ $paket->no_telepon }}</td>
    <td>{{ $paket->jenis_paket }}</td>
    <td class="text-center">{{ $paket->tanggal_sampai }}</td>
    @if ($paket->tanggal_pengantaran != "")
        <td class="text-center">{{ $paket->tanggal_pengantaran }}</td>
    @elseif ($paket->tanggal_diambil != "")
        <td class="text-center">{{ $paket->tanggal_diambil }}</td>
    @else
        <td class="text-center">{{ "" }}</td>
    @endif
    @if ($paket->cara_penerimaan == "ambil_sendiri")
        <td class="text-center">{{ "Ambil Sendiri" }}</td>
    @elseif ($paket->cara_penerimaan == "diantar")
        <td class="text-center">{{ "Diantar" }}</td>
    @else
        <td class="text-center">{{ "" }}</td>
    @endif
    </td>
</tr>