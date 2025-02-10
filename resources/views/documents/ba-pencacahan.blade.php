<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Berita Acara Pencacahan</title>
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

        .content table {
            margin: 15px 0;
        }

        .content td {
            padding: 5px 3px;
        }

        .signatures {
            margin-top: 60px;
            text-align: center;
        }

        .signatures table {
            width: 100%;
        }

        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signatures img {
            max-width: 150px;
            margin: 10px 0;
            height: auto;
        }

        .sign-column {
            display: inline-block;
            width: 45%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 3px;
            vertical-align: top;
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
        <p>BERITA ACARA PENCACAHAN</p>
        <p>Nomor : {{ $penindakan->no_print }}</p>
    </div>

    <div class="content">
        <p>Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }} bertempat di KPPBC Tipe Madya Pabean
            C Blitar, Kami :</p>

        <table>
            <tr>
                <td width="140">Nama</td>
                <td width="10">:</td>
                <td>{{ $penindakan->petugas_1 }}</td>
            </tr>
        </table>

        <p>Bersama – sama dengan :</p>

        <table>
            <tr>
                <td width="140">Nama</td>
                <td width="10">:</td>
                <td>{{ $penindakan->petugas_2 }}</td>
            </tr>
        </table>

        <p>Telah melakukan pencacahan terhadap Barang hasil Penindakan yang berasal dari penindakan di
            {{ $penindakan->lokasi_penindakan }} pada tanggal {{ $penindakan->tanggal_sbp->format('d F Y') }}, berupa
            {{ $penindakan->jenis_barang }} dengan jumlah {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}.</p>

        <p>Atas Barang Hasil Penindakan tersebut diatas kemudian dilakukan penyimpanan di Gudang BHP di KPPBC TMP C
            Blitar.</p>

        <p>Demikian Berita Acara ini dibuat dengan sebenarnya dan ditandatangani pada tempat dan waktu tersebut diatas.
        </p>
    </div>

    <div class="signatures">
        <p style="text-align: right">Blitar, {{ $penindakan->tanggal_print->format('d F Y') }}</p>
        <p>Yang Melakukan Pencacahan,</p>
        <table>
            <tr>
                <td>
                    <p>Pemilik/Importi/Eksportir/Kuasanya/Saksi* </p>
                    <br><br><br>
                    <p>{{ $penindakan->petugas_2 }}</p>
                    <p>NIP {{ $penindakan->petugas_2 }}</p>
                </td>
                <td>
                    @if ($penindakan->ttd_petugas_1)
                        <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" style="height: 60px;">
                    @else
                        <br><br><br>
                    @endif
                    <p>{{ $penindakan->petugas_1 }}</p>
                    <p>NIP {{ $penindakan->petugas_1 }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
