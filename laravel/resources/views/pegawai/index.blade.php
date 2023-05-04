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
        <h1 class="page-header">{{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
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
                                        <a class="label label-info"
                                            href="{{ url(route('pegawai.show', $pegawai->id)) }}" style='display: inline-block; margin-bottom: 10px;'>Detail</a>
                                        <a class="label label-primary"
                                            href="{{ url(route('pegawai.edit', $pegawai->id)) }}" style='display: inline-block; margin-bottom: 10px;'>Edit</a>
                                        <form action="{{ url(route('pegawai.destroy', $pegawai->id)) }}"
                                            method='post' style='display: inline-block;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $pegawai->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $pegawai->id }}'
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

<script>
    const locationHrefHapusSemua = "{{ url('pegawai/hapus_semua') }}";
    const locationHrefAktifkanSemua = "{{ url('pegawai/aktifkan_semua') }}";
    const locationHrefCreate = "{{ url('pegawai/create') }}";
    var columnOrders = [10];
    var urlSearch = "{{ url('pegawai') }}";
    var q = "{{ $_GET['q'] ?? '' }}";
    var placeholder = "Filter...";
    var tampilkan_buttons = true;
    var button_manual = true;
</script>
@endsection