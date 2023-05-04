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
        <h1 class="page-header">Edit {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Edit {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</div>
            <div class="panel-body">
                <div class="col-md-12">

                    <form class="form-horizontal form-material" action="{{ url(route('cuti.update', $cuti->id)) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label class="col-md-12">pegawai</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='pegawai_id'>
                                    @foreach($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" @if(old('pegawai_id')==$pegawai->id || $cuti->pegawai_id == $pegawai->id) selected
                                        @endif>{{ $pegawai->nama }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('pegawai_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Nomor Permohonan</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Nomor Permohonan"
                                    class="form-control form-control-line @error('nomor_permohonan') is-invalid @enderror"
                                    value='{{ old('nomor_permohonan') == "" ? $cuti->nomor_permohonan : old('nomor_permohonan') }}' name='nomor_permohonan'>

                                @error('nomor_permohonan')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tanggal Mulai</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="25-02-1980"
                                    class="form-control form-control-line flatpickr" value='{{ old('tanggal_mulai') == "" ? $cuti->tanggal_mulai : old('tanggal_mulai') }}'
                                    name='tanggal_mulai'>

                                @error('tanggal_mulai')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tanggal Selesai</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="25-02-1980"
                                    class="form-control form-control-line flatpickr" value='{{ old('tanggal_selesai') == "" ? $cuti->tanggal_selesai : old('tanggal_selesai') }}'
                                    name='tanggal_selesai'>

                                @error('tanggal_selesai')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Keterangan"
                                    class="form-control form-control-line @error('keterangan') is-invalid @enderror"
                                    value='{{ old('keterangan') == "" ? $cuti->keterangan : old('keterangan') }}' name='keterangan'>

                                @error('keterangan')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection