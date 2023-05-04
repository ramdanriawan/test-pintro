@extends('layouts.app')

@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <em class="fa fa-home"></em>
            </a>
        </li>

        <li class="active">{{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}: {{ $pegawai->nama }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Data Pribadi</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=20>No</th>
                                    <th>Jabatan</th>
                                    <th>Nip</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Tgl Mulai Kerja</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawais as $pegawai)
                                <tr data-id='{{ $pegawai->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $pegawai->riwayat_jabatans->where('status', 'Aktif')->first()->nama_jabatan ?? "-" }}</td>
                                    <td>{{ $pegawai->nip }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->tanggal_lahir }}</td>
                                    <td>{{ $pegawai->tempat_lahir }}</td>
                                    <td>{{ $pegawai->jenis_kelamin }}</td>
                                    <td>{{ $pegawai->agama }}</td>
                                    <td>{{ $pegawai->alamat }}</td>
                                    <td>{{ $pegawai->no_telp }}</td>
                                    <td>{{ $pegawai->tgl_mulai_kerja }}</td>
                                    <td>{{ $pegawai->status }}</td>
                                    
                                    <td class="text-center">
                                        <a class="label label-primary"
                                            href="{{ url(route('pegawai.edit', $pegawai->id)) }}" style='display: inline-block; margin-bottom: 10px;'>Edit</a>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h3>Data Riwayat Jabatan</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=20>No</th>
                                    <th>Pegawai</th>
                                    <th>Jabatan</th>
                                    <th>Gaji</th>
                                    <th>Tunjangan</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai->riwayat_jabatans as $riwayat_jabatan)
                                <tr data-id='{{ $riwayat_jabatan->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $riwayat_jabatan->pegawai->nama }}</td>
                                    <td>{{ $riwayat_jabatan->nama_jabatan }}</td>
                                    <td>{{ toIdr($riwayat_jabatan->gaji_jabatan) }}</td>
                                    <td>{{ toIdr($riwayat_jabatan->tunjangan_jabatan) }}</td>
                                    <td>{{ $riwayat_jabatan->nomor_sk }}</td>
                                    <td>{{ $riwayat_jabatan->tanggal }}</td>
                                    <td>{{ $riwayat_jabatan->status }}</td>
                                    
                                    <td class="text-center">
                                        <a class="label label-primary"
                                            href="{{ url(route('riwayat_jabatan.edit', $riwayat_jabatan->id)) }}">Edit</a>
                                        <form action="{{ url(route('riwayat_jabatan.destroy', $riwayat_jabatan->id)) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $riwayat_jabatan->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $riwayat_jabatan->id }}'
                                                style="display: none;"></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Data Cuti</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=20>No</th>
                                    <th>Pegawai</th>
                                    <th>No Permohonan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai->cutis as $cuti)
                                <tr data-id='{{ $cuti->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $cuti->pegawai->nama }}</td>
                                    <td>{{ $cuti->nomor_permohonan }}</td>
                                    <td>{{ $cuti->tanggal_mulai }}</td>
                                    <td>{{ $cuti->tanggal_selesai }}</td>
                                    <td>{{ $cuti->keterangan }}</td>
                                    
                                    <td class="text-center">
                                        <a class="label label-primary"
                                            href="{{ url(route('cuti.edit', $cuti->id)) }}">Edit</a>
                                        <form action="{{ url(route('cuti.destroy', $cuti->id)) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $cuti->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $cuti->id }}'
                                                style="display: none;"></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h3>Data Pribadi</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=20>No</th>
                                    <th>Pegawai</th>
                                    <th>Gaji</th>
                                    <th>Tunjangan</th>
                                    <th>Periode</th>
                                    <th>Tahun</th>
                                    <th>Tanggal</th>
                                    <th>Catatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai->penggajians as $penggajian)
                                <tr data-id='{{ $penggajian->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $penggajian->pegawai->nama }}</td>
                                    <td>{{ toIdr($penggajian->gaji) }}</td>
                                    <td>{{ toIdr($penggajian->tunjangan) }}</td>
                                    <td>{{ $penggajian->periode }}</td>
                                    <td>{{ $penggajian->tahun }}</td>
                                    <td>{{ $penggajian->tanggal }}</td>
                                    <td>{{ $penggajian->catatan }}</td>
                                                                        
                                    <td class="text-center">
                                        <a class="label label-primary"
                                            href="{{ url(route('penggajian.edit', $penggajian->id)) }}">Edit</a>
                                        <form action="{{ url(route('penggajian.destroy', $penggajian->id)) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $penggajian->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $penggajian->id }}'
                                                style="display: none;"></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h3>Data Absensi</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=20>No</th>
                                    <th>Pegawai</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai->absensis as $absensi)
                                <tr data-id='{{ $absensi->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $absensi->pegawai->nama }}</td>
                                    <td>{{ $absensi->tanggal }}</td>
                                    <td>{{ $absensi->jam_masuk }}</td>
                                    <td>{{ $absensi->jam_keluar }}</td>
                                    
                                    <td class="text-center">
                                        @if(!$absensi->jam_masuk)
                                        <a class="label label-success"
                                            href="{{ url(route('absensi.edit', $absensi->id)) }}?absen_masuk=klik" onclick='confirm("Yakin akan absen masuk?")'>Absen Masuk</a>
                                        @endif
                                        
                                        @if(!$absensi->jam_keluar)
                                            <a class="label label-warning"
                                            href="{{ url(route('absensi.edit', $absensi->id)) }}?absen_keluar=klik"  onclick='confirm("Yakin akan absen keluar?")'>Absen Keluar</a>
                                        @endif

                                        <form action="{{ url(route('absensi.destroy', $absensi->id)) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $absensi->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $absensi->id }}'
                                                style="display: none;"></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection