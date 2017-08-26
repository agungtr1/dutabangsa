<!DOCTYPE html>
<html>
    <head>
    <title>Data Peserta Duta Bangsa</title>
    <style>
        /* --------------------------------------------------------------
        Hartija Css Print Framework
        * Version: 1.0
        -------------------------------------------------------------- */
        body {
        width:100% !important;
        margin:0 !important;
        padding:0 !important;
        line-height: 1.45;
        font-family: Garamond,"Times New Roman", serif;
        color: #000;
        background: none;
        font-size: 14pt; }
        /* Headings */
        h1,h2,h3,h4,h5,h6 { page-break-after:avoid; }
        h1{font-size:19pt;}
        h2{font-size:17pt;}
        h3{font-size:15pt;}
        h4,h5,h6{font-size:14pt;}
        p, h2, h3 { orphans: 3; widows: 3; }
        code { font: 12pt Courier, monospace; }
        blockquote { margin: 1.2em; padding: 1em; font-size: 12pt; }
        hr { background-color: #ccc; }
        /* Images */
        img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
        a img { border: none; }
        /* Links */
        a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;color:#333; }
        a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ")"; font-size: 90%; }
        abbr[title]:after { content: " (" attr(title) ")"; }
        /* Don't show linked images */
        a[href^="http://"] {color:#000; }
        a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after {content: " (" attr(href) ") "; display:none; }
        /* Don't show links that are fragment identifiers, or use the `javascript:` pseudo protocol . . taken from html5boilerplate */
        a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}
        /* Table */
        table { margin: 1px; text-align:left; }
        th { border-bottom: 1px solid #333; font-weight: bold; }
        td { border-bottom: 1px solid #333; }
        th,td { padding: 4px 10px 4px 0; }
        tfoot { font-style: italic; }
        caption { background: #fff; margin-bottom:2em; text-align:left; }
        thead {display: table-header-group;}
        img,tr {page-break-inside: avoid;}
        /* Hide various parts from the site
        #header, #footer, #navigation, #rightSideBar, #leftSideBar
        {display:none;}
        */
    </style>
</head>

<body>
    <h1>Data Peserta Duta Bangsa</h1>
    <hr>
    <table>
        <thead style="text-align: center;">
            <tr>
                <td>Keterangan</td>
                <td>Data Peserta</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datapeserta as $dp)
            <tr>
                <td>NIP</td>
                <td><b>{{ $dp->nis }}</b></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><b>{{ $dp->nama }}</b></td>
            </tr>
            <tr>
                <td>No. Handpohone</td>
                <td><b>@if($dp->nohp == NULL) - @else {{ $dp->nohp }} @endif</b></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><b>@if($dp->email == NULL) - @else {{ $dp->email }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><b>@if($dp->jeniskelamin == NULL) - @else {{ $dp->jeniskelamin }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis kelas</td>
                <td><b>{{ $dp->jeniskelas->name }}</b></td>
            </tr>
            @if($dp->jeniskelas->id == 1 || $dp->jeniskelas->id == 3)
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td><b>@if($dp->tempatlahir == NULL) - @else {{ $dp->tempatlahir }}, {{ $dp->tanggallahir }} @endif</b></td>
            </tr>
            <tr>
                <td>Usia</td>
                <td><b>@if($dp->usia == NULL) - @else {{ $dp->usia }} @endif</b></td>
            </tr>
            <tr>
                <td>No. HP Darurat</td>
                <td><b>@if($dp->nohpdarurat == NULL) - @else {{ $dp->nohpdarurat }} @endif</b></td>
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td><b>@if($dp->alamatlengkap == NULL) - @else {{ $dp->alamatlengkap }} @endif</b></td>
            </tr>
            <tr>
                <td>Didaftarkan Oleh</td>
                <td><b>@if($dp->didaftarkanoleh == NULL) - @else {{ $dp->didaftarkanoleh }} @endif</b></td>
            </tr>
            <tr>
                <td>Mengetahui Duta Bangsa</td>
                <td><b>@if($dp->mengetahuidb == NULL) - @else {{ $dp->mengetahuidb }} @endif</b></td>
            </tr>
            @endif
            <tr>
                <td>Latar Belakang</td>
                <td><b>@if($dp->latarbelakang == NULL) - @else {{ $dp->latarbelakang }} @endif</b></td>
            </tr>
            @if($dp->latarbelakang == "bekerja")
            <tr>
                <td>Perusahaan</td>
                <td><b>@if($dp->perusahaan == NULL) - @else {{ $dp->perusahaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis Industri</td>
                <td><b>@if($dp->jenisindustri == NULL) - @else {{ $dp->jenisindustri }} @endif</b></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td><b>@if($dp->departemenpeserta == NULL) - @else {{ $dp->departemenpeserta }} @endif</b></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><b>@if($dp->jabatan == NULL) - @else {{ $dp->jabatan }} @endif</b></td>
            </tr>
            <tr>
                <td>Level Jabatan</td>
                <td><b>@if($dp->leveljabatan == NULL) - @else {{ $dp->leveljabatan }} @endif</b></td>
            </tr>
            @elseif($dp->latarbelakang == "kuliah")
            <tr>
                <td>Universitas</td>
                <td><b>@if($dp->universitas == NULL) - @else {{ $dp->universitas }} @endif</b></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td><b>@if($dp->jurusan == NULL) - @else {{ $dp->jurusan }} @endif</b></td>
            </tr>
            @elseif($dp->latarbelakang == "sekolah")
            <tr>
                <td>Sekolah</td>
                <td><b>@if($dp->namasekolah == NULL) - @else {{ $dp->namasekolah }} @endif</b></td>
            </tr>
            @endif
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td><b>@if($dp->tanggalpelaksanaan == NULL) - @else {{ $dp->tanggalpelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Judul Program</td>
                <td><b>@if($dp->judulprogram == NULL) - @else {{ strtoupper($dp->judulprogram) }} @endif</b></td>
            </tr>
            <tr>
                <td>Lokasi Pelaksanaan</td>
                <td><b>@if($dp->lokasipelaksanaan == NULL) - @else {{ $dp->lokasipelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Kota Pelaksanaan</td>
                <td><b>@if($dp->kotapelaksanaan == NULL) - @else {{ $dp->kotapelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Akun Instagram</td>
                <td><b>@if($dp->akuninstagram == NULL) - @else {{ $dp->akuninstagram }} @endif</b></td>
            </tr>
            <tr>
                <td>Materi</td>
                <td><b>@if($dp->materi == NULL) - @else {{ $dp->materi }} @endif</b></td>
            </tr>
            <tr>
                <td>Di Input Oleh</td>
                <td><b>@if($dp->posted_by == NULL) - @else {{ $dp->posted_by }}, {{ $dp->created_at }} @endif</b></td>
            </tr>
            <tr> 
                <td><p>&nbsp;</p></td>
                <td><p>&nbsp;</p></td>
            </tr>
            <tr> 
                <td><p>&nbsp;</p></td>
                <td><p>&nbsp;</p></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>