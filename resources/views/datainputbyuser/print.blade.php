<!DOCTYPE html>
<html>
<head>
	<title>Report Data Peserta</title>
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
            <tr>
                <td>NIP</td>
                <td><b>{{ $datapeserta->nis }}</b></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><b>{{ $datapeserta->nama }}</b></td>
            </tr>
            <tr>
                <td>No. Handpohone</td>
                <td><b>@if($datapeserta->nohp == NULL) - @else {{ $datapeserta->nohp }} @endif</b></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><b>@if($datapeserta->email == NULL) - @else {{ $datapeserta->email }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><b>@if($datapeserta->jeniskelamin == NULL) - @else {{ $datapeserta->jeniskelamin }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis kelas</td>
                <td><b>{{ $datapeserta->jeniskelas->name }}</b></td>
            </tr>
            @if($datapeserta->jeniskelas->id == 1 || $datapeserta->jeniskelas->id == 3)
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td><b>@if($datapeserta->tempatlahir == NULL) - @else {{ $datapeserta->tempatlahir }}, {{ $datapeserta->tanggallahir }} @endif</b></td>
            </tr>
            <tr>
                <td>Usia</td>
                <td><b>@if($datapeserta->usia == NULL) - @else {{ $datapeserta->usia }} @endif</b></td>
            </tr>
            <tr>
                <td>No. HP Darurat</td>
                <td><b>@if($datapeserta->nohpdarurat == NULL) - @else {{ $datapeserta->nohpdarurat }} @endif</b></td>
            </tr>
            <tr>
                <td>Alamat Lengkap</td>
                <td><b>@if($datapeserta->alamatlengkap == NULL) - @else {{ $datapeserta->alamatlengkap }} @endif</b></td>
            </tr>
            <tr>
                <td>Didaftarkan Oleh</td>
                <td><b>@if($datapeserta->didaftarkanoleh == NULL) - @else {{ $datapeserta->didaftarkanoleh }} @endif</b></td>
            </tr>
            <tr>
                <td>Mengetahui Duta Bangsa</td>
                <td><b>@if($datapeserta->mengetahuidb == NULL) - @else {{ $datapeserta->mengetahuidb }} @endif</b></td>
            </tr>
            @endif
            <tr>
                <td>Latar Belakang</td>
                <td><b>@if($datapeserta->latarbelakang == NULL) - @else {{ $datapeserta->latarbelakang }} @endif</b></td>
            </tr>
            @if($datapeserta->latarbelakang == "bekerja")
            <tr>
                <td>Perusahaan</td>
                <td><b>@if($datapeserta->perusahaan == NULL) - @else {{ $datapeserta->perusahaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Jenis Industri</td>
                <td><b>@if($datapeserta->jenisindustri == NULL) - @else {{ $datapeserta->jenisindustri }} @endif</b></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td><b>@if($datapeserta->departemenpeserta == NULL) - @else {{ $datapeserta->departemenpeserta }} @endif</b></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><b>@if($datapeserta->jabatan == NULL) - @else {{ $datapeserta->jabatan }} @endif</b></td>
            </tr>
            <tr>
                <td>Level Jabatan</td>
                <td><b>@if($datapeserta->leveljabatan == NULL) - @else {{ $datapeserta->leveljabatan }} @endif</b></td>
            </tr>
            @elseif($datapeserta->latarbelakang == "kuliah")
            <tr>
                <td>Universitas</td>
                <td><b>@if($datapeserta->universitas == NULL) - @else {{ $datapeserta->universitas }} @endif</b></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td><b>@if($datapeserta->jurusan == NULL) - @else {{ $datapeserta->jurusan }} @endif</b></td>
            </tr>
            @elseif($datapeserta->latarbelakang == "sekolah")
            <tr>
                <td>Sekolah</td>
                <td><b>@if($datapeserta->namasekolah == NULL) - @else {{ $datapeserta->namasekolah }} @endif</b></td>
            </tr>
            @endif
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td><b>@if($datapeserta->tanggalpelaksanaan == NULL) - @else {{ $datapeserta->tanggalpelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Judul Program</td>
                <td><b>@if($datapeserta->judulprogram == NULL) - @else {{ strtoupper($datapeserta->judulprogram) }} @endif</b></td>
            </tr>
            <tr>
                <td>Lokasi Pelaksanaan</td>
                <td><b>@if($datapeserta->lokasipelaksanaan == NULL) - @else {{ $datapeserta->lokasipelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Kota Pelaksanaan</td>
                <td><b>@if($datapeserta->kotapelaksanaan == NULL) - @else {{ $datapeserta->kotapelaksanaan }} @endif</b></td>
            </tr>
            <tr>
                <td>Akun Instagram</td>
                <td><b>@if($datapeserta->akuninstagram == NULL) - @else {{ $datapeserta->akuninstagram }} @endif</b></td>
            </tr>
            <tr>
                <td>Materi</td>
                <td><b>@if($datapeserta->materi == NULL) - @else {{ $datapeserta->materi }} @endif</b></td>
            </tr>
            <tr>
                <td>Di Input Oleh</td>
                <td><b>@if($datapeserta->posted_by == NULL) - @else {{ $datapeserta->posted_by }}, {{ $datapeserta->created_at }} @endif</b></td>
            </tr>
            <tr> 
                <td><p>&nbsp;</p></td>
                <td><p>&nbsp;</p></td>
            </tr>
            <tr> 
                <td><p>&nbsp;</p></td>
                <td><p>&nbsp;</p></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>
<script type="text/javascript">
    window.print();
</script>