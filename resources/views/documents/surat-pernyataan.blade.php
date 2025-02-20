<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Pernyataan</title>
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
        body > h6:first-child {
            text-align: center;
        }
        body > h6:nth-child(2) {
            margin-top: 12px;
            font-weight: normal;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td {
            vertical-align: top;
            font-size: 12px;
        }
        p {
            margin: 20px 0;
            font-size: 12px;
            text-align: justify;
        }
        footer {
            width: 75%;
            font-weight: normal;
            text-align: right;
        }
        .signature-img {
            height: 60px;
            max-width: 150px;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h6>SURAT PERNYATAAN</h6>
    <h6>Yang bertandatangan di bawah ini :</h6>
    <table class="table">
        <tr>
            <td style="width: 35%">Nama</td>
            <td style="width: 3%">:</td>
            <td>{{ $penindakan->pelaku }}</td>
        </tr>
        <tr>
            <td style="width: 35%">Tempat / Tanggal Lahir</td>
            <td style="width: 3%">:</td>
            <td>{{ $penindakan->tempat_lahir }}, {{ $penindakan->tanggal_lahir->format('d F Y') }}</td>
        </tr>
        <tr>
            <td style="width: 35%">Pekerjaan</td>
            <td style="width: 3%">:</td>
            <td>{{ $penindakan->pekerjaan }}</td>
        </tr>
        <tr>
            <td style="width: 35%">Alamat</td>
            <td style="width: 3%">:</td>
            <td>{{ $penindakan->alamat }}</td>
        </tr>
        <tr>
            <td style="width: 35%">Identitas (KTP/SIM/Paspor*)</td>
            <td style="width: 3%">:</td>
            <td>{{ $penindakan->no_ktp }}</td>
        </tr>
    </table>
    <p>
        Dengan ini menyatakan saya telah kedapatan menyimpan, menimbun, memiliki, menjual, memberikan, menawarkan,
        menyerahkan, dan/atau menyediakan {{ $penindakan->jenis_barang }} dan saya berjanji untuk tidak lagi menyimpan,
        menimbun, memiliki, menjual, memberikan, menawarkan, menyerahkan, dan/atau menyediakan
        {{ $penindakan->jenis_barang }}.
        Bilamana di kemudian hari saya terbukti menyimpan, menimbun, memiliki, menjual, memberikan, menawarkan,
        menyerahkan, dan/atau menyediakan {{ $penindakan->jenis_barang }} lagi kepada orang lain, saya menyatakan
        bersedia dikenakan sanksi sesuai dengan peraturan perundang – undangan yang berlaku.
        <br />
        <br />
        Demikian surat pernyataan ini saya buat dengan sungguh-sungguh tanpa ada paksaan dari pihak manapun.
    </p>
    <footer>
        <h6>{{ $penindakan->lokasi_penindakan }}, {{ $penindakan->tanggal_sbp->format('d F Y') }}</h6>
        <h6>Yang membuat pernyataan</h6>
        @if($penindakan->ttd_pelaku)
            <img src="data:image/png;base64,{{ $penindakan->ttd_pelaku }}" alt="Tanda Tangan Pelaku" class="signature-img" />
        @else
            <br /><br /><br /><br />
        @endif
        <h6>{{ $penindakan->pelaku }}</h6>
    </footer>
</body>

</html>