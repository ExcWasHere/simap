<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lampiran Berita Acara Pencacahan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            margin-bottom: 20px;
        }
        .header h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .nomor-tanggal {
            margin-bottom: 30px;
        }
        .nomor-tanggal p {
            margin: 5px 0;
        }
        .content {
            margin-bottom: 20px;
        }
        .content-title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .hasil-pemeriksaan {
            margin: 20px 0;
        }
        .hasil-pemeriksaan p {
            margin: 5px 0;
            text-align: justify;
        }
        .signature-container {
            margin-top: 100px;
            text-align: center;
        }
        .signature {
            display: inline-block;
            width: 45%;
            text-align: center;
            vertical-align: top;
        }
        .footer-note {
            font-size: 8pt;
            text-align: left;
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Lampiran Berita Acara Pencacahan</h2>
        <div class="nomor-tanggal">
            <p>Nomor : {{ $penindakan->no_print }}</p>
            <p>Tanggal : {{ $penindakan->tanggal_print->format('d F Y') }}</p>
        </div>
    </div>

    <div class="content">
        <div class="content-title">LAMPIRAN HASIL PENCACAHAN</div>
        <div class="hasil-pemeriksaan">
            <p>Hasil pemeriksaan kedapatan:</p>
            <p>Terdapat Barang Kena Cukai {{ $penindakan->jenis_barang }} TANPA DILEKATI PITA CUKAI {{ $penindakan->uraian_bhp }} SEBANYAK {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</p>
        </div>
    </div>

    <div class="signature-container">
        <p>Yang Melakukan Pencacahan,</p>
        <div style="margin-top: 20px;">
            <div class="signature">
                <br><br><br>
                <p>{{ $penindakan->petugas_1 }}</p>
                <p>NIP {{ $penindakan->petugas_1 }}</p>
            </div>
            <div class="signature">
                <br><br><br>
                <p>{{ $penindakan->petugas_2 }}</p>
                <p>NIP {{ $penindakan->petugas_2 }}</p>
            </div>
        </div>
    </div>

</body>
</html> 