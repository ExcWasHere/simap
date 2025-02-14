<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Berita Acara Penegahan</title>
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
        header {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        header > img,
        header > section {
            display: inline-block;
            vertical-align: top;
        }
        header > img {
            margin-right: 1.5rem;
            width: 20%;
        }
        header > section {
            width: 75%;
            text-align: center;
            line-height: 1.5;
        }
        header > section > h5 {
            font-size: 14px;
            font-weight: bold;
        }
        header > section > h6 {
            font-size: 10px;
            font-weight: normal;
        }
        hr {
            margin: 8px 0;
        }
        main {
            line-height: 1.5;
        }
        main > h6:first-child {
            margin-bottom: 2px;
            font-weight: bold;
            text-align: center;
        }
        main > h6:nth-child(2),
        main > h6:nth-child(3) {
            font-weight: normal;
            text-align: justify;
        }
        .table-main {
            width: 100%;
            border-collapse: collapse;
        }
        .table-main td {
            vertical-align: top;
            font-size: 12px;
        }
        .table-main td:first-child {
            width: 5%;
        }
        .table-indent {
            margin-left: 32px;
        }
        .table-indent td {
            vertical-align: top;
            font-size: 12px;
        }
        .signature-img-1 {
            position: absolute;
            top: 610px;
            right: 68px;
            height: 60px;
            max-width: 150px;
        }
        .signature-img-2 {
            position: absolute;
            top: 750px;
            right: 72px;
            height: 60px;
            max-width: 150px;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        footer {
            margin-top: 30px;
            font-size: 10px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('img/logo-dokumen.png') }}" alt="Logo" />
        <section>
            <h5>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
            <h5>DIREKTORAT JENDERAL BEA DAN CUKAI</h5>
            <h5>KANTOR WILAYAH DJBC JAWA TIMUR II</h5>
            <h5>KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI</h5>
            <h5>TIPE MADYA PABEAN C BLITAR</h5>
            <h6>JALAN SUDANCO SUPRIADI NO. 60 KOTAK POS 23 – Blitar</h6>
            <h6>TELEPON (0342) 801655; FAKSIMILE (0342) 801546; SITUS www.beacukai.go.id</h6>
        </section>
    </header>
    <hr />
    <main>
        <h6>
            BERITA ACARA PENEGAHAN
            <br />
            Nomor : {{ $penindakan->no_sbp }}
        </h6>
        <h6>
            Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }}, berdasarkan Surat Perintah:
            {{ $penindakan->no_print }} tanggal {{ $penindakan->tanggal_print->format('d F Y') }}, Kami yang bertanda
            tangan di bawah ini dalam rangka pengamanan hak-hak negara, telah melakukan penegahan terhadap*:
        </h6>
        <table class="table-main">
            <tr>
                <td>a.</td>
                <td class="text-bold">
                    Sarana Pengangkut:
                </td>
            </tr>
        </table>
        <table class="table-indent">
            <tr>
                <td>Nama dan Jenis Sarana Pengangkut</td>
                <td>: {{ $penindakan->nama_jenis_sarkut }}</td>
            </tr>
            <tr>
                <td>Nahkoda/Pilot/Pengemudi</td>
                <td>: {{ $penindakan->pengemudi }}</td>
            </tr>
            <tr>
                <td>Nomor Register/Polisi</td>
                <td>: {{ $penindakan->no_polisi }}</td>
            </tr>
        </table>
        <table class="table-main">
            <tr>
                <td>b.</td>
                <td class="text-bold">
                    Barang:
                </td>
            </tr>
        </table>
        <table class="table-indent">
            <tr>
                <td>Jumlah/Jenis/Ukuran</td>
                <td>: {{ $penindakan->jenis_barang }} sebanyak {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</td>
            </tr>
            <tr>
                <td>Pemilik/Yang Menguasai</td>
                <td>: {{ $penindakan->nama_pemilik }}</td>
            </tr>
            <tr>
                <td>Nomor Identitas</td>
                <td>: {{ $penindakan->no_ktp }}</td>
            </tr>
        </table>
        <h6>Penegahan disaksikan oleh Pemilik/Yang Menguasai:</h6>
        <table class="table-main">
            <tr>
                <td style="width: 25%;">Nama</td>
                <td>: {{ $penindakan->nama_pemilik }}</td>
            </tr>
            <tr>
                <td>Alamat Tempat Tinggal</td>
                <td>: {{ $penindakan->alamat }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $penindakan->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Identitas (KTP)</td>
                <td>: {{ $penindakan->no_ktp }}</td>
            </tr>
        </table>
        <h6 class="text-right" style="margin-top: 24px;">Blitar, {{ $penindakan->tanggal_sbp->format('d F Y') }}</h6>
        <table style="width: 100%">
            <tr>
                <td style="vertical-align: top; width: 50%; font-size: 12px">
                    Pemilik/Yang Menguasai
                    <br /><br /><br />
                    {{ $penindakan->nama_pemilik }}
                </td>
                <td style="vertical-align: top; width: 50%; text-align: right; font-size: 12px">
                    Yang Melakukan Pemeriksaan :
                    @if($penindakan->ttd_petugas_1)
                        <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" class="signature-img-1" />
                        <br /><br /><br /><br /><br />
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
                    @if($penindakan->ttd_petugas_2)
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
    </main>
    <footer>
        *Coret yang tidak perlu
        <br />
        Yang dimaksud dengan barang yang dikuasai negara adalah barang yang untuk sementara waktu penguasaannya
        berada pada negara sampai dapat ditentukan status barang yang sebenarnya. Perubahan status ini dimaksudkan
        agar pejabat bea dan cukai dapat memproses barang tersebut secara administrasi sampai dapat dibuktikan bahwa
        telah terjadi kesalahan atau sama sekali tidak terjadi kesalahan.
    </footer>
</body>

</html>