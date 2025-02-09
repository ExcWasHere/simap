<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Berita Acara Serah Terima</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 2.5cm;
            color: #000;
        }
        .header {
            width: 100%;
            margin-bottom: 20px;
        }
        .header table {
            width: 100%;
            border-spacing: 0;
        }
        .header .logo {
            width: auto;
            height: 90;   
            vertical-align: top;
            margin-right: 15px;
        }
        .header-text {
            text-align: center;
            padding-left: 10px;
            line-height: 1.2;   
        }
        .header .bold-text {
            font-weight: bold;
            margin: 1px 0;
            font-size: 12pt;      
        }
        .header .small-text {
            font-size: 9pt;
            margin: 1px 0;
            color: #333;
        }
        .header-line {
            border-bottom: 2px double #000;
            margin: 6px 0 25px 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin: 30px 0;
        }
        .title p {
            margin: 5px 0;
            font-size: 14pt;
        }
        .content {
            text-align: justify;
            margin: 30px 0;
            line-height: 1.6;
        }
        .content-section {
            margin: 10px 0;
        }
        .signatures {
            margin-top: 60px;
        }
        .signatures table {
            width: 100%;
        }
        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .footer-note {
            margin-top: 20px;
            font-style: italic;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 55px;">
                    <img src="{{ public_path('img/logo-dokumen.png') }}" class="logo" alt="Logo">
                </td>
                <td class="header-text">
                    <p class="bold-text">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</p>
                    <p class="bold-text">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                    <p class="bold-text">KANTOR WILAYAH DJBC JAWA TIMUR II</p>
                    <p class="bold-text">KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI</p>
                    <p class="bold-text">TIPE MADYA PABEAN C BLITAR</p>
                    <p class="small-text">JALAN SUDANCO SUPRIADI NO. 60 KOTAK POS 23 – Blitar</p>
                    <p class="small-text">TELEPON (0342) 801655; FAKSIMILE (0342) 801546; SITUS www.beacukai.go.id</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="header-line"></div>

    <div class="title">
        <p>BERITA ACARA SERAH TERIMA</p>
        <p>Nomor : {{ $penindakan->no_print }}</p>
    </div>

    <div class="content">
        <p>Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }}, Saya/Kami* yang bertanda tangan di bawah bertindak untuk/atas nama pemilik barang, telah menyerahkan:</p>

        <div class="content-section">
            <p>1. Sarana Pengangkut*</p>
            <div style="margin-left: 20px;">
                <p>a. Jenis Sarana Pengangkut : {{ $penindakan->nama_jenis_sarkut }}</p>
                <p>b. No Reg/No Polisi : {{ $penindakan->no_polisi }}</p>
            </div>
        </div>

        <div class="content-section">
            <p>2. Barang*</p>
            <div style="margin-left: 20px;">
                <p>a. Jml/No Petikemas/Kemasan : {{ $penindakan->jenis_barang }} sebanyak {{ $penindakan->jumlah }} {{ $penindakan->kemasan }} {{ $penindakan->uraian_bhp }}</p>
                <p>b. Jumlah/Jenis Barang : {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</p>
            </div>
        </div>

        <div class="content-section">
            <p>3. Dokumen*</p>
            <div style="margin-left: 20px;">
                <p>a. Jenis/No dan Tgl Dokumen : {{ $penindakan->no_sbp }}</p>
            </div>
        </div>

        <div class="content-section">
            <p>4. Orang*</p>
            <div style="margin-left: 20px;">
                <p>a. Nama : {{ $penindakan->nama_pemilik }}</p>
                <p>b. No Identitas : {{ $penindakan->no_ktp }}</p>
            </div>
        </div>

        <p>Diserahkan kepada :</p>
        <div style="margin-left: 20px;">
            <p>Nama : {{ $penindakan->petugas_1 }}</p>
            <p>NIP/ No Identitas : {{ $penindakan->petugas_1 }}</p>
        </div>

        <p>Menerima penyerahan untuk/atas nama: -</p>
        <p>Penyerahan dilaksanakan dalam rangka: {{ $penindakan->jenis_pelanggaran }}</p>

        <p>Demikian Berita Acara ini dibuat dengan sebenarnya.</p>
    </div>

    <div class="signatures">
        <p style="text-align: right">Blitar, {{ $penindakan->tanggal_print->format('d F Y') }}</p>
        <table>
            <tr>
                <td>
                    <p>Yang menerima,</p>
                    <br><br><br>
                    <p>{{ $penindakan->petugas_1 }}</p>
                    <p>NIP {{ $penindakan->petugas_1 }}</p>
                </td>
                <td>
                    <p>Yang menyerahkan,</p>
                    <br><br><br>
                    <p>{{ $penindakan->nama_pemilik }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer-note">
        <p>*Coret yang tidak perlu</p>
    </div>
</body>
</html>