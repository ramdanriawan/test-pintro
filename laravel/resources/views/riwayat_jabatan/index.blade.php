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
                                @foreach($riwayat_jabatans as $riwayat_jabatan)
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

<script>
    const locationHrefHapusSemua = "{{ url('riwayat_jabatan/hapus_semua') }}";
    const locationHrefAktifkanSemua = "{{ url('riwayat_jabatan/aktifkan_semua') }}";
    const locationHrefCreate = "{{ url('riwayat_jabatan/create') }}";
    var columnOrders = [8];
    var urlSearch = "{{ url('riwayat_jabatan') }}";
    var q = "{{ $_GET['q'] ?? '' }}";
    var placeholder = "Filter...";
    var tampilkan_buttons = true;
    var button_manual = true;
</script>
@endsection