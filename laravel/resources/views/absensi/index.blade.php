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
                                    <th>Nip</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
                                    <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absensis as $absensi)
                                <tr data-id='{{ $absensi->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $absensi->pegawai->nama }}</td>
                                    <td>{{ $absensi->pegawai->riwayat_jabatans->where('status', 'Aktif')->first()->nama_jabatan ?? "-" }}</td>
                                    <td>{{ $absensi->pegawai->nip }}</td>
                                    <td>{{ $absensi->tanggal }}</td>
                                    <td>{{ $absensi->jam_masuk }}</td>
                                    <td>{{ $absensi->jam_keluar }}</td>
                                    
                                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
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
                                    @endif

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
    const locationHrefHapusSemua = "{{ url('absensi/hapus_semua') }}";
    const locationHrefAktifkanSemua = "{{ url('absensi/aktifkan_semua') }}";
    const locationHrefCreate = "{{ url('absensi/create') }}";

    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
    var columnOrders = [5];
    var tampilkan_buttons = true;
    var button_manual = true;
    @else
    var columnOrders = [4];
    var tampilkan_buttons = false;
    var button_manual = false;
    @endif
    
    var urlSearch = "{{ url('absensi') }}";
    var q = "{{ $_GET['q'] ?? '' }}";
    var placeholder = "Filter...";
    
</script>
@endsection