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
                                    <th>Gaji</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Periode</th>
                                    <th>Tahun</th>
                                    <th>Tanggal</th>
                                    <th>Catatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penggajians as $penggajian)
                                <tr data-id='{{ $penggajian->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $penggajian->pegawai->nama }}</td>
                                    <td>{{ toIdr($penggajian->gaji) }}</td>
                                    <td>{{ toIdr($penggajian->tunjangan) }}</td>
                                    <td>{{ toIdr($penggajian->bonus) }}</td>
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

<script>
    const locationHrefHapusSemua = "{{ url('penggajian/hapus_semua') }}";
    const locationHrefAktifkanSemua = "{{ url('penggajian/aktifkan_semua') }}";
    const locationHrefCreate = "{{ url('penggajian/create') }}";
    var columnOrders = [8];
    var urlSearch = "{{ url('penggajian') }}";
    var q = "{{ $_GET['q'] ?? '' }}";
    var placeholder = "Filter...";
    var tampilkan_buttons = true;
    var button_manual = true;
</script>
@endsection