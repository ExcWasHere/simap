<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Berita Acara Pencacahan</title>
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
        main > h6:last-child {
            margin-top: 16px;
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
        .font-normal {
            font-weight: normal;
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
            BERITA ACARA PENCACAHAN
            <br />
            Nomor : BA-{{ $penindakan->no_print }}/KBC.120302/CACAH/2025
        </h6>
        <h6 class="font-normal">
            Pada hari ini tanggal {{ $penindakan->tanggal_print->format('d F Y') }} bertempat di KPPBC Tipe Madya Pabean
            C Blitar, Kami :
        </h6>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $penindakan->petugas_1 }}</td>
            </tr>
        </table>
        <h6 class="font-normal">Bersama-sama dengan :</h6>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $penindakan->petugas_2 }}</td>
            </tr>
        </table>
        <h6 class="font-normal" style="text-align: justify">
            Telah melakukan pencacahan terhadap Barang hasil Penindakan yang berasal dari penindakan di
            {{ $penindakan->lokasi_penindakan }} pada tanggal {{ $penindakan->tanggal_sbp->format('d F Y') }}, berupa
            {{ $penindakan->jenis_barang }} dengan jumlah {{ $penindakan->jumlah }} {{ $penindakan->kemasan }}.
            <br />
            Atas Barang Hasil Penindakan tersebut diatas kemudian dilakukan penyimpanan di Gudang BHP di KPPBC TMP C
            Blitar.
            <br />
            Demikian Berita Acara ini dibuat dengan sebenarnya dan ditandatangani pada tempat dan waktu tersebut diatas.
        </h6>
        <h6 class="font-normal" style="margin-top: 16px">
            Blitar, {{ $penindakan->tanggal_print->format('d F Y') }}
            <br />
            Yang Melakukan Pencacahan,
        </h6>
        <table class="table">
            <tr>
                <td style="vertical-align: top; width: 30%; font-size: 12px">
                    <br />
                    @if($penindakan->ttd_petugas_1)
                        <img src="data:image/png;base64,{{ $penindakan->ttd_petugas_1 }}" alt="Tanda Tangan Petugas 1" class="signature-img" />
                    @else
                        <br /><br /><br />
                    @endif
                    <br />
                    {{ $penindakan->petugas_1 }}
                    <br />
                    NIP {{ $penindakan->petugas_1 }}
                </td>
                <td style="vertical-align: top; width: 30%; font-size: 12px">
                    <br />
                    @if($penindakan->ttd_petugas_2)
                        <img src="data:image/png;base64,{{ $penindakan->ttd_petugas_2 }}" alt="Tanda Tangan Petugas 2" class="signature-img" />
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
    </main>
</body>

</html>