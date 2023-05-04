<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Laporan</title>
        <style>
            table {
                border-collapse: collapse;
            }

            thead > tr{
                background-color: #0070C0;
                color:#f1f1f1;
            }

            thead > tr > th{
                background-color: #0070C0;
                color:#fff;
                padding: 10px;
                border-color: #fff;
            }

            th, td {
                padding: 2px;
                font-size: 12px;
            }

            th {
                color: #222;
            }

            body{
                font-family:Calibri;
            }
            
            #logo {
                position: absolute;
                right: 0;
                top: 0;
                width: 100px;
                height: 100px;
                margin-right: 20px;
                margin-top: 15px;
            }
            
            .tanda-tangan {
                margin-top: 500px;
                margin-bottom: 20px;
                position: relative;
                bottom: 0;
                right: 0;
                margin-top: 30px;
            }

            .tanda-tangan div {
                width: 300px;
                text-align: center;
                float: right;
            }

            .tanda-tangan-box {
                height: 50px;
            }
            
            * {
                color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        </style>
    </head>

<body onload="window.print()">

    <h1 align='center'>RAMDAN RIAWAN</h1>

    <img id='logo' src="{{ url('image/logo.png') }}" alt="" widht=240 height=240>

		<h3 align="center">LAPORAN PEGAWAI</h3>
		
            <table width="100%" border="1" style='margin-bottom: 250px;'>
                <thead>
                    <tr>
                        <th width=3>No.</th>
                        <th>Nip</th>
                        <th>Jabatan</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Tanggal Mulai Kerja</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pegawais as $pegawai)
                    <tr>
                        <th>{{ $loop->iteration }}.</th>
                        <td>{{ $pegawai->riwayat_jabatans->where('status', 'Aktif')->first()->nama_jabatan ?? "-" }}</td>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->nama }}</td>
                        <td>{{ $pegawai->tanggal_lahir }}</td>
                        <td>{{ $pegawai->tempat_lahir }}</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                        <td>{{ $pegawai->agama }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td>{{ $pegawai->no_telp }}</td>
                        <td>{{ $pegawai->tanggal_mulai_kerja }}</td>
                        <td>{{ $pegawai->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

                <div class='tanda-tangan'>
                    <div class='tanda-tangan-kanan'>
                    <div>Tangkit baru,Sungai gelam, Muaro Jambi</div>
                    <div>{{ date('d-m-Y') }}</div>
            
                    <div class='tanda-tangan-box'>
                    
                    </div>

                    <div>{{ env('OBJECT_SIGNATURE') }}</div>
                </div>
        </div>
	</body>
</html>
