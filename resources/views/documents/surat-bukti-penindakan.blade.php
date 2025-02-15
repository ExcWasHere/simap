<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Bukti Penindakan</title>
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
        main > h6 {
            margin-bottom: 2px;
            font-weight: bold;
            text-align: center;
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
            SURAT BUKTI PENINDAKAN
            <br />
            Nomor : {{ $penindakan->no_sbp }}
        </h6>
        <table class="table">
            <tr>
                <td style="width: 2.5%">1.</td>
                <td>
                    Dasar penindakan, Surat Perintah Nomor : {{ $penindakan->no_print }} tanggal : {{ $penindakan->tanggal_print->format('d F Y') }}
                </td>
            </tr>
            <tr>
                <td style="width: 2.5%">2.</td>
                <td>
                    Perintah yang dilaksanakan : Penghentian, pemeriksaan, penegahan, penyegelan, penghentian pembongkaran dan/atau penegahan di bidang HKI*.
                </td>
            </tr>
            <tr>
                <td style="width: 2.5%">3.</td>
                <td>
                    <span class="text-bold">Obyek Penindakan:</span>
                    <br />
                    <span class="text-bold">Sarana Pengangkut:</span>
                </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td style="width: 2.5%"></td>
                <td style="width: 25%">Nama dan Jenis Sarana Pengangkut</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->nama_jenis_sarkut }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%"></td>
                <td style="width: 25%">Nahkoda/Pilot/Pengemudi</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->pengemudi }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%"></td>
                <td style="width: 25%">Nomor Register/Polisi</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->no_polisi }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%"></td>
                <td class="text-bold">Barang:</td>
            </tr>
            <tr>
                <td style="width: 2.5%"></td>
                <td style="width: 25%">Jumlah/Jenis Barang</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->jenis_barang }} sebanyak {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td style="width: 2.5%">4.</td>
                <td style="width: 25%">Lokasi Penindakan</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->lokasi_penindakan }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%">5.</td>
                <td style="width: 25%">Uraian Penindakan</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->uraian_bhp }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%">6.</td>
                <td style="width: 25%">Alasan Penindakan</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->uraian_bhp }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%">7.</td>
                <td style="width: 25%">Jenis Pelanggaran</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->jenis_pelanggaran }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%">8.</td>
                <td style="width: 25%">Tindakan yang diambil</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->pasal }}</td>
            </tr>
            <tr>
                <td style="width: 2.5%">9.</td>
                <td>Waktu Penindakan</td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td style="width: 30%">Dimulai Tanggal</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->waktu_awal_penindakan->format('d F Y') }} jam {{ $penindakan->waktu_awal_penindakan->format('H:i') }} WIB</td>
            </tr>
            <tr>
                <td style="width: 30%">Berakhir</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->waktu_akhir_penindakan->format('d F Y') }} jam {{ $penindakan->waktu_akhir_penindakan->format('H:i') }} WIB</td>
            </tr>
            <tr>
                <td style="width: 30%">Hal yang terjadi</td>
                <td style="width: 2%">:</td>
                <td>{{ $penindakan->uraian_bhp }}</td>
            </tr>
        </table>
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
                    @if($penindakan->ttd_petugas_1)
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
                    @if($penindakan->ttd_petugas_2)
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
        <footer>
            *Coret yang tidak perlu
            <br />
            Yang dimaksud dengan barang yang dikuasai negara adalah barang yang untuk sementara waktu penguasaannya
            berada pada negara sampai dapat ditentukan status barang yang sebenarnya. Perubahan status ini dimaksudkan
            agar pejabat bea dan cukai dapat memproses barang tersebut secara administrasi sampai dapat dibuktikan bahwa
            telah terjadi kesalahan atau sama sekali tidak terjadi kesalahan.
        </footer>
    </main>
</body>

</html>