@extends('layouts.app')

@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Dashboard</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ ucwords(preg_replace('/_/',' ', Request::segment(1))) }}</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id='dataTable'>
                            <thead>
                                <tr>
                                    <th width=5></th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nama Kelas</th>
                                    <th>Ruang</th>
                                    @if(in_array(auth()->user()->level, ['admin']))
                                    <th class="text-center">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelass as $kelas)
                                <tr data-id="{{ $kelas->id }}">
                                    <td>{{ $loop->iteration }}
                                    <td>{{ $kelas->wali_kelas()->nama ?? "" }}</td>
                                    <td>{{ $kelas->ketua_kelas()->nama ?? "" }}</td>
                                    <td>{{ $kelas->nama }}</td>
                                    <td>{{ $kelas->ruang }}</td>
                                    @if(in_array(auth()->user()->level, ['admin']))
                                    <td class='text-center'>
                                        <a class="label label-primary" href="{{ url(route('kelas.edit', ['kela' => $kelas->id])) }}">Edit</a>
                                        <form action="{{ url(route('kelas.destroy', ['kela' => $kelas->id])) }}"
                                            method='post' style='display: inline;'
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <label class="label label-danger" href="" for='btnSubmit-{{ $kelas->id }}'
                                                style='cursor: pointer;'>Hapus</label>
                                            <button type="submit" id='btnSubmit-{{ $kelas->id }}'
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

@endsection