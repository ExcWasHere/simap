<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lampiran Berita Acara Pemeriksaan</title>
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
    </style>
</head>

<body>
    <h6>Lampiran Berita Acara Pemeriksaan</h6>
    <table class="table">
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td>{{ str_replace('PRINT', 'Riksa', $penindakan->no_print) }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $penindakan->tanggal_print->format('d F Y') }}</td>
        </tr>
    </table>
    <br />
    <h6 style="text-align: center">
        LAPORAN HASIL PEMERIKSAAN
    </h6>
    <h6 style="font-weight: normal; line-height: 1.5">
        Hasil pemeriksaan kedapatan:
        <br />
        Terdapat Barang Kena Cukai {{ $penindakan->jenis_barang }} TANPA DILEKATI PITA CUKAI
        {{ $penindakan->uraian_bhp }} SEBANYAK {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}
    </h6>
    <h6 style="margin-top: 24px; text-align: right">Blitar, {{ $penindakan->tanggal_sbp->format('d F Y') }}</h6>
    <table class="table">
        <tr>
            <td style="vertical-align: top; width: 50%; font-size: 12px">
                Pemilik/Yang Menguasai
                <br /><br /><br /><br /><br />
                {{ $penindakan->nama_pemilik }}
            </td>
            <td style="vertical-align: top; width: 50%; text-align: right; font-size: 12px">
                Yang Melakukan Pemeriksaan :
                <br />
                <br />
                @if ($penindakan->ttd_petugas_1)
                    <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" class="signature-img" />
                @else
                    <br /><br /><br />
                @endif
                <br />
                {{ $penindakan->petugas_1 }}
                <br />
                NIP {{ $penindakan->petugas_1 }}
            </td>
        </tr>
    </table>
    <table class="table" style="margin-top: 20px">
        <tr>
            <td style="vertical-align: top; text-align: right; font-size: 12px">
                @if ($penindakan->ttd_petugas_2)
                    <img src="{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2" class="signature-img" />
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