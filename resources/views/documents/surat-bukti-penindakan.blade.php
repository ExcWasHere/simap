<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Bukti Penindakan</title>
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
            line-height: 1.6;
        }
        .content-section {
            margin: 15px 0;
        }
        .indent {
            margin-left: 20px;
        }
        .signatures {
            margin-top: 50px;
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
            margin-top: 30px;
            font-size: 10pt;
            font-style: italic;
        }
        .signatures img {
            max-width: 150px;
            margin: 10px 0;
            height: 60px;
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
        <p>SURAT BUKTI PENINDAKAN</p>
        <p>Nomor : {{ $penindakan->no_sbp }}</p>
    </div>

    <div class="content">
        <div class="content-section">
            <p>1. Dasar penindakan, Surat Perintah Nomor : {{ $penindakan->no_print }} tanggal : {{ $penindakan->tanggal_print->format('d F Y') }}</p>
            <p>2. Perintah yang dilaksanakan : Penghentian, pemeriksaan, penegahan, penyegelan, penghentian pembongkaran dan/atau penegahan di bidang HKI*.</p>
        </div>

        <div class="content-section">
            <p>3. Obyek Penindakan :</p>
            <div class="indent">
                <p><strong>Sarana Pengangkut:</strong></p>
                <div class="indent">
                    <p>Nama dan Jenis Sarana Pengangkut : {{ $penindakan->nama_jenis_sarkut }}</p>
                    <p>Nahkoda/Pilot/Pengemudi : {{ $penindakan->pengemudi }}</p>
                    <p>Nomor Register/Polisi : {{ $penindakan->no_polisi }}</p>
                </div>

                <p><strong>Barang:</strong></p>
                <div class="indent">
                    <p>Jumlah/Jenis Barang : {{ $penindakan->jenis_barang }} sebanyak {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</p>
                    <p>Pemilik/Yang Menguasai : {{ $penindakan->nama_pemilik }}</p>
                </div>

                <p><strong>Bangunan atau tempat:</strong></p>
                <div class="indent">
                    <p>Alamat Bangunan/Tempat : {{ $penindakan->bangunan }}</p>
                </div>

                <p><strong>Badan:</strong></p>
                <div class="indent">
                    <p>Nama : {{ $penindakan->nama_pemilik }}</p>
                    <p>Tanggal Lahir : {{ $penindakan->tanggal_lahir->format('d F Y') }}</p>
                    <p>Alamat : {{ $penindakan->alamat }}</p>
                    <p>Nomor Identitas : {{ $penindakan->no_ktp }}</p>
                </div>
            </div>
        </div>

        <div class="content-section">
            <p>4. Lokasi Penindakan : {{ $penindakan->lokasi_penindakan }}</p>
            <p>5. Uraian Penindakan : {{ $penindakan->uraian_bhp }}</p>
            <p>6. Alasan Penindakan : {{ $penindakan->uraian_bhp }}</p>
            <p>7. Jenis Pelanggaran : {{ $penindakan->jenis_pelanggaran }}</p>
            <p>8. Tindakan yang diambil : {{ $penindakan->pasal }}</p>
        </div>

        <div class="content-section">
            <p>9. Waktu Penindakan</p>
            <div class="indent">
                <p>Dimulai Tanggal : {{ $penindakan->waktu_awal_penindakan->format('d F Y') }} jam {{ $penindakan->waktu_awal_penindakan->format('H:i') }} WIB</p>
                <p>Berakhir : {{ $penindakan->waktu_akhir_penindakan->format('d F Y') }} jam {{ $penindakan->waktu_akhir_penindakan->format('H:i') }} WIB</p>
                <p>Hal yang terjadi : {{ $penindakan->uraian_bhp }}</p>
            </div>
        </div>

        <div class="signatures">
            <p style="text-align: right">Blitar, {{ $penindakan->tanggal_sbp->format('d F Y') }}</p>
            <table>
                <tr>
                    <td>
                        <p>Pemilik/Yang Menguasai</p>
                        <br><br><br>
                        <p>{{ $penindakan->nama_pemilik }}</p>
                    </td>
                    <td>
                        <p>Yang Melakukan Pemeriksaan :</p>
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
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer-note">
            <p>*Coret yang tidak perlu</p>
            <p>Yang dimaksud dengan barang yang dikuasai negara adalah barang yang untuk sementara waktu penguasaannya berada pada negara sampai dapat ditentukan status barang yang sebenarnya. Perubahan status ini dimaksudkan agar pejabat bea dan cukai dapat memproses barang tersebut secara administrasi sampai dapat dibuktikan bahwa telah terjadi kesalahan atau sama sekali tidak terjadi kesalahan.</p>
        </div>
    </div>
</body>
</html>