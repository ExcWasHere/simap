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
        body > h6:first-child {
            font-weight: bold;
        }
        h6 {
            font-weight: normal;
        }
        .text-right {
            margin-top: 24px;
            text-align: right;
        }
        .signature-img-1 {
            position: absolute;
            top: 230px;
            right: 68px;
            height: 60px;
            max-width: 150px;
        }
        .signature-img-2 {
            position: absolute;
            top: 340px;
            right: 72px;
            height: 60px;
            max-width: 150px;
        }
    </style>
</head>

<body>
    <h6>Lampiran Berita Acara Pemeriksaan</h6>
    <table>
        <tr>
            <td style="vertical-align: top; font-size: 12px">Nomor</td>
            <td style="vertical-align: top; font-size: 12px">:</td>
            <td style="vertical-align: top; font-size: 12px">{{ str_replace('PRINT', 'Riksa', $penindakan->no_print) }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top; font-size: 12px">Tanggal</td>
            <td style="vertical-align: top; font-size: 12px">:</td>
            <td style="vertical-align: top; font-size: 12px">{{ $penindakan->tanggal_print->format('d F Y') }}</td>
        </tr>
    </table>
    <br />
    <h6 style="font-weight: bold; text-align: center">
        LAPORAN HASIL PEMERIKSAAN
    </h6>
    <h6>
        Hasil pemeriksaan kedapatan:
        <br />
        Terdapat Barang Kena Cukai {{ $penindakan->jenis_barang }} TANPA DILEKATI PITA CUKAI
        {{ $penindakan->uraian_bhp }} SEBANYAK {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}
    </h6>
    <h6 class="text-right">Blitar, {{ $penindakan->tanggal_sbp->format('d F Y') }}</h6>
    <table style="width: 100%">
        <tr>
            <td style="vertical-align: top; width: 50%; font-size: 12px">
                Pemilik/Yang Menguasai
                <br /><br /><br />
                {{ $penindakan->nama_pemilik }}
            </td>
            <td style="vertical-align: top; width: 50%; text-align: right; font-size: 12px">
                Yang Melakukan Pemeriksaan :
                @if ($penindakan->ttd_petugas_1)
                    <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" class="signature-img-1" />
                    <br /><br /><br /><br /><br /><br />
                @else
                    <br /><br /><br />
                @endif
                {{ $penindakan->petugas_1 }}
                <br />
                NIP {{ $penindakan->petugas_1 }}
            </td>
        </tr>
    </table>
    <table style="margin-top: 8px; width: 100%">
        <tr>
            <td colspan="2" style="vertical-align: top; text-align: right; font-size: 12px">
                @if ($penindakan->ttd_petugas_2)
                    <img src="{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2" class="signature-img-2" />
                    <br /><br /><br /><br /><br />
                @else
                    <br /><br /><br />
                @endif
                {{ $penindakan->petugas_2 }}
                <br />
                NIP {{ $penindakan->petugas_2 }}
            </td>
        </tr>
    </table>
</body>

</html>