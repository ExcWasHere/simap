<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Berita Acara Pencacahan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            line-height: 1.3;
            margin: 2cm;
        }
        .header {
            text-align: center;
            line-height: 1.1;
            display: flex;
            flex-direction: row;    
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 10px;
        }
        .header p {
            margin: 0;
        }
        .header .logo {
            width: 55px;                      
            height: auto;         
            margin-top: 5px;       
            flex-shrink: 0;       
        }
        .header-text {
            text-align: center;
            flex-grow: 1;         
            margin-left: 20px;    
        }
        .header .bold-text {
            font-weight: bold;
        }
        .header .small-text {
            font-size: 10pt;
        }
        .header-line {
            border-bottom: 2px solid black;
            margin: 10px 0;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
        .content {
            text-align: justify;
            margin-top: 20px;
        }
        .signatures {
            margin-top: 50px;
            text-align: center;
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
        <img src="{{ public_path('img/logo-dokumen.png') }}" class="logo" alt="Logo">
        <div class="header-text">
            <p class="bold-text">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</p>
            <p class="bold-text">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
            <p class="bold-text">KANTOR WILAYAH DJBC JAWA TIMUR II</p>
            <p class="bold-text">KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI</p>
            <p class="bold-text">TIPE MADYA PABEAN C BLITAR</p>
            <p class="small-text">JALAN SUDANCO SUPRIADI NO. 60 KOTAK POS 23 – Blitar</p>
            <p class="small-text">TELEPON (0342) 801655; FAKSIMILE (0342) 801546; SITUS www.beacukai.go.id</p>
        </div>
    </div>
    <div class="header-line"></div>

    <div class="title">
        <p>BERITA ACARA PENCACAHAN</p>
        <p>Nomor : {{ $penindakan->no_print }}</p>
    </div>

    <div class="content">
        <p>Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }} bertempat di KPPBC Tipe Madya Pabean C Blitar, Kami :</p>

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

        <p>Telah melakukan pencacahan terhadap Barang hasil Penindakan yang berasal dari penindakan di {{ $penindakan->lokasi_penindakan }} pada tanggal {{ $penindakan->tanggal_sbp->format('d F Y') }}, berupa {{ $penindakan->jenis_barang }} dengan jumlah {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}.</p>

        <p>Atas Barang Hasil Penindakan tersebut diatas kemudian dilakukan penyimpanan di Gudang BHP di KPPBC TMP C Blitar.</p>

        <p>Demikian Berita Acara ini dibuat dengan sebenarnya dan ditandatangani pada tempat dan waktu tersebut diatas.</p>
    </div>

    <div class="signatures">
        <p>Yang Melakukan Pencacahan,</p>
        <br><br><br>
        <table width="100%">
            <tr>
                <td width="50%" style="text-align: center">
                    <p>{{ $penindakan->petugas_2 }}</p>
                </td>
                <td width="50%" style="text-align: center">
                    <p>{{ $penindakan->petugas_1 }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>