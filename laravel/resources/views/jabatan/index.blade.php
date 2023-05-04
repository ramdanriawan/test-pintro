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
                                    <th>Nama</th>
                                    <th>Gaji</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jabatans as $jabatan)
                                <tr data-id='{{ $jabatan->id }}'>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $jabatan->nama }}</td>
                                    <td>{{ toIdr($jabatan->gaji) }}</td>
                                    <td>{{ toIdr($jabatan->tunjangan) }}</td>
                                    <td>{{ toIdr($jabatan->bonus) }}</td>
                                    <td class="text-center">
                                        <a class="label label-primary"
                                            href="{{ url(route('jabatan.edit', $jabatan->id)) }}">Edit</a>
                                        <form action="{{ url(route('jabatan.destroy', ['jabatan' => $jabatan->id])) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $jabatan->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $jabatan->id }}'
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
    const locationHrefHapusSemua = "{{ url('jabatan/hapus_semua') }}";
    const locationHrefAktifkanSemua = "{{ url('jabatan/aktifkan_semua') }}";
    const locationHrefCreate = "{{ url('jabatan/create') }}";
    var columnOrders = [4];
    var urlSearch = "{{ url('jabatan') }}";
    var q = "{{ $_GET['q'] ?? '' }}";
    var placeholder = "Filter...";
    var tampilkan_buttons = true;
    var button_manual = true;
</script>
@endsection