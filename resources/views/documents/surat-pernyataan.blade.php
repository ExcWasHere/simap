<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .content {
            margin-bottom: 20px;
            text-align: justify;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .personal-info {
            margin-bottom: 20px;
        }
        .personal-info p {
            margin: 5px 0;
        }
        .statement {
            text-align: justify;
            margin: 20px 0;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer-note {
            font-size: 8pt;
            text-align: left;
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>SURAT PERNYATAAN</h2>
    </div>

    <div class="content">
        <p>Yang bertandatangan di bawah ini:</p>
        
        <div class="personal-info">
            <p>Nama : {{ $penindakan->pelaku }}</p>
            <p>Tempat / Tanggal Lahir : {{ $penindakan->tempat_lahir }}, {{ $penindakan->tanggal_lahir->format('d F Y') }}</p>
            <p>Pekerjaan : {{ $penindakan->pekerjaan }}</p>
            <p>Alamat : {{ $penindakan->alamat }}</p>
            <p>Identitas (KTP/SIM/Paspor*) : {{ $penindakan->no_ktp }}</p>
        </div>

        <div class="statement">
            <p>Dengan ini menyatakan saya telah kedapatan menyimpan, menimbun, memiliki, menjual, memberikan, menawarkan, menyerahkan, dan/atau
            menyediakan {{ $penindakan->jenis_barang }} dan saya berjanji untuk tidak lagi menyimpan, menimbun, memiliki, menjual, memberikan,
            menawarkan, menyerahkan, dan/atau menyediakan {{ $penindakan->jenis_barang }}. Bilamana di kemudian hari saya terbukti menyimpan,
            menimbun, memiliki, menjual, memberikan, menawarkan, menyerahkan, dan/atau menyediakan {{ $penindakan->jenis_barang }} lagi kepada orang
            lain, saya menyatakan bersedia dikenakan sanksi sesuai dengan peraturan perundang – undangan yang berlaku.</p>

            <p>Demikian surat pernyataan ini saya buat dengan sungguh-sungguh tanpa ada paksaan dari pihak manapun.</p>
        </div>
    </div>

    <div class="footer">
        <p>{{ $penindakan->lokasi_penindakan }}, {{ $penindakan->tanggal_sbp->format('d F Y') }}</p>
        <p>Yang membuat pernyataan</p>
        <br><br><br>
        <p>{{ $penindakan->pelaku }}</p>
    </div>
</body>
</html> 