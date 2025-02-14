<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Berita Acara Pemeriksaan</title>
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
            BERITA ACARA PEMERIKSAAN
            <br />
            Nomor : {{ $penindakan->no_sbp }}
        </h6>
        <h6>
            Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }}, berdasarkan Surat Perintah / Surat
            Tugas nomor : {{ $penindakan->no_print }} tanggal {{ $penindakan->tanggal_print->format('d F Y') }}, Kami
            yang bertanda tangan di bawah ini:
        </h6>
        <table style="width: 100%; border-collapse: collapse">
            <tr>
                <td style="vertical-align: top; width: 5%; font-size: 12px">1.</td>
                <td style="vertical-align: top; font-size: 12px">Nama / NIP</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->petugas_1 }} / {{ $penindakan->petugas_1 }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Pangkat / Gol</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">PENGATUR / II/C</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Jabatan</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">PELAKSANA PEMERIKSA</td>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 5%; font-size: 12px">2.</td>
                <td style="vertical-align: top; font-size: 12px">Nama / NIP</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->petugas_2 }} / {{ $penindakan->petugas_2 }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Pangkat / Gol</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">Pengatur Tk.I / II.d</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Jabatan</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">PELAKSANA PEMERIKSA</td>
            </tr>
        </table>
        <h6>Telah melakukan pemeriksaan atas :</h6>
        <table style="width: 100%; border-collapse: collapse">
            <tr style="font-weight: bold">
                <td style="vertical-align: top; width: 5%; font-size: 12px">a.</td>
                <td style="vertical-align: top; font-size: 12px">Barang yang ditimbun / disimpan di Kawasan Pabean / Kawasan Berikat / Bangunan atau tempat lain</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Nama pemilik / yang menguasai</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->nama_pemilik }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Alamat pemilik yang menguasai</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->alamat }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Alamat bangunan / tempat lain</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->bangunan }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Identitas pemilik yang menguasai (KTP)</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->no_ktp }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Jumlah/Jenis/Ukuran</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->jenis_barang }} sebanyak {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Pemilik/Yang Menguasai</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->nama_pemilik }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Tempat/Lokasi Penindakan</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->lokasi_penindakan }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td style="vertical-align: top; width: 5%; font-size: 12px">b.</td>
                <td style="vertical-align: top; font-size: 12px">Sarana pengangkut dan atau barang diatasnya</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Nama dan Jenis Sarana Pengangkut</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->nama_jenis_sarkut }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Nahkoda/Pilot/Pengemudi</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->pengemudi }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Nomor Register/Polisi</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->no_polisi }}</td>
            </tr>
        </table>
        <h6>Hasil pemeriksaan : {{ $penindakan->uraian_bhp }}</h6>
        <h6>Pemeriksaan disaksikan oleh Pemilik Barang/Kuasanya :</h6>
        <table style="width: 100%; border-collapse: collapse">
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; width: 25%; font-size: 12px">Nama</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->nama_pemilik }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Tempat / Tanggal Lahir</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->tempat_lahir }}, {{ $penindakan->tanggal_lahir->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Alamat Tempat Tinggal</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->alamat }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Pekerjaan</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="width: 5%"></td>
                <td style="vertical-align: top; font-size: 12px">Identitas (KTP)</td>
                <td style="vertical-align: top; font-size: 12px">:</td>
                <td style="vertical-align: top; font-size: 12px">{{ $penindakan->no_ktp }}</td>
            </tr>
        </table>
        <h6>Demikian Berita Acara ini dibuat dengan sebenarnya.</h6>
        <h6 style="margin-top: 24px; text-align: right">Blitar, {{ $penindakan->tanggal_sbp->format('d F Y') }}</h6>
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
                        <img src="{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" style="position: absolute; top: 880px; right: 68px; height: 60px; max-width: 150px" />
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
                        <img src="{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2" style="position: absolute; top: 90px; right: 72px; height: 60px; max-width: 150px" />
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
</body>

</html>