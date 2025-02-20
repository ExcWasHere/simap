<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lampiran Berita Acara Pencacahan</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            margin: 64px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }
        body h6:first-child {
            font-weight: normal;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            vertical-align: top;
            font-size: 12px;
        }
        .table td:first-child {
            width: 5%;
        }
        .signature-img {
            height: 60px;
            max-width: 150px;
            display: block;
            margin-bottom: 10px;
        }
        .font-normal {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <h6>Lampiran Berita Acara Pencacahan</h6>
    <table class="table">
        <tr>
            <td style="width: 15%">Nomor</td>
            <td style="width: 2%">:</td>
            <td>{{ str_replace('PRINT', 'Riksa', $penindakan->no_print) }}</td>
        </tr>
        <tr>
            <td style="width: 15%">Tanggal</td>
            <td style="width: 2%">:</td>
            <td>{{ $penindakan->tanggal_print->format('d F Y') }}</td>
        </tr>
    </table>
    <br />
    <h6 style="text-align: center">
        LAMPIRAN HASIL PENCACAHAN
    </h6>
    <h6 class="font-normal" style="margin-top: 16px">
        Hasil pemeriksaan kedapatan:
        <br />
        Terdapat Barang Kena Cukai {{ $penindakan->jenis_barang }} TANPA DILEKATI PITA CUKAI
        {{ $penindakan->uraian_bhp }} SEBANYAK {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}
    </h6>
    <h6 class="font-normal" style="margin-top: 16px">
        Blitar, {{ $penindakan->tanggal_print->format('d F Y') }}
        <br />
        Yang Melakukan Pencacahan,
    </h6>
    <table class="table">
        <tr>
            <td style="vertical-align: top; width: 30%; font-size: 12px">
                <br />
                @if($penindakan->ttd_petugas_1)
                    <img src="data:image/png;base64,{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" class="signature-img" />
                @else
                    <br /><br /><br />
                @endif
                <br />
                {{ $penindakan->petugas_1 }}
                <br />
                NIP {{ $penindakan->petugas_1 }}
            </td>
            <td style="vertical-align: top; width: 30%; font-size: 12px">
                <br />
                @if($penindakan->ttd_petugas_2)
                    <img src="data:image/png;base64,{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2" class="signature-img" />
                @else
                    <br /><br /><br />
                @endif
                <br />
                {{ $penindakan->petugas_2 }}
                <br />
                NIP {{ $penindakan->petugas_2 }}
            </td>
        </tr>
    </table>
</body>

</html>