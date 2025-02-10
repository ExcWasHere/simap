<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lampiran Berita Acara Pemeriksaan</title>
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
        }
        .signature-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .signature-header p {
            margin: 5px 0;
        }
        .signature-left {
            text-align: left;
            width: 45%;
        }
        .signature-right {
            text-align: left;
            width: 45%;
        }
        .signature-content {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature-box {
            width: 45%;
        }
        .signature-box p {
            margin: 5px 0;
        }
        .footer-note {
            font-size: 8pt;
            text-align: left;
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
        .signature-box img {
            max-width: 150px;
            margin: 10px 0;
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Lampiran Berita Acara Pemeriksaan</h2>
        <div class="nomor-tanggal">
            <p>Nomor : {{ str_replace('PRINT', 'Riksa', $penindakan->no_print) }}</p>
            <p>Tanggal : {{ $penindakan->tanggal_print->format('d F Y') }}</p>
        </div>
    </div>

    <div class="content">
        <div class="content-title">LAPORAN HASIL PEMERIKSAAN</div>
        <div class="hasil-pemeriksaan">
            <p>Hasil pemeriksaan kedapatan:</p>
            <p>Terdapat Barang Kena Cukai {{ $penindakan->jenis_barang }} TANPA DILEKATI PITA CUKAI {{ $penindakan->uraian_bhp }} SEBANYAK {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</p>
        </div>
    </div>

    <div class="signature-container">
        <div class="signature-header">
            <div class="signature-left">
                <p>{{ $penindakan->lokasi_penindakan }}, {{ $penindakan->tanggal_print->format('d F Y') }}</p>
            </div>
        </div>
        <div class="signature-content">
            <div class="signature-box">
                <p>Pemilik/Importir/Eksportir/Kuasanya/Saksi*</p>
                <br><br><br>
                <p>{{ $penindakan->pelaku }}</p>
            </div>
            <div class="signature-box">
                <p>Yang Melakukan Pemeriksaan:</p>
                @if($penindakan->ttd_petugas_1)
                    <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1">
                @else
                    <br><br><br>
                @endif
                <p>{{ $penindakan->petugas_1 }}</p>
                <p>NIP {{ $penindakan->petugas_1 }}</p>
                <br>
                @if($penindakan->ttd_petugas_2)
                    <img src="{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2">
                @else
                    <br><br><br>
                @endif
                <p>{{ $penindakan->petugas_2 }}</p>
                <p>NIP {{ $penindakan->petugas_2 }}</p>
            </div>
        </div>
    </div>

</body>
</html>