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
        <h1 class="page-header">Tambah {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Tambah {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</div>
            <div class="panel-body">
                <div class="col-md-12">

                    <form class="form-horizontal form-material" action="{{ url(route('pegawai.store')) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="col-md-12">Nip</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Nip"
                                    class="form-control form-control-line @error('nip') is-invalid @enderror"
                                    value='{{ old('nip') }}' name='nip'>

                                @error('nip')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Nama"
                                    class="form-control form-control-line @error('nama') is-invalid @enderror"
                                    value='{{ old('nama') }}' name='nama'>

                                @error('nama')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tanggal Lahir</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="25-02-1980"
                                    class="form-control form-control-line flatpickr" value='{{ old('tanggal_lahir') }}'
                                    name='tanggal_lahir'>

                                @error('tanggal_lahir')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tempat Lahir</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Tempat Lahir"
                                    class="form-control form-control-line @error('tempat_lahir') is-invalid @enderror"
                                    value='{{ old('tempat_lahir') }}' name='tempat_lahir'>

                                @error('tempat_lahir')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='jenis_kelamin'>
                                    @foreach(['Laki - Laki', 'Perempuan'] as $jenis_kelamin)
                                    <option value="{{ $jenis_kelamin }}" @if(old('jenis_kelamin')==$jenis_kelamin)
                                        selected @endif>{{ $jenis_kelamin }}</option>
                                    @endforeach
                                </select>

                                @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Agama</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='agama'>
                                    @foreach(['Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha'] as $agama)
                                    <option value="{{ $agama }}" @if(old('agama')==$agama)
                                        selected @endif>{{ $agama }}</option>
                                    @endforeach
                                </select>

                                @error('agama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Alamat</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Alamat"
                                    class="form-control form-control-line @error('alamat') is-invalid @enderror"
                                    value='{{ old('alamat') }}' name='alamat'>

                                @error('alamat')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">No Telp</label>
                            <div class="col-md-12">
                                <input type="number" placeholder="1000000"
                                    class="form-control form-control-line" id="example-no_telp"
                                    value='{{ old('no_telp') }}' name='no_telp'>

                                @error('no_telp')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tanggal Mulai Kerja</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="25-02-1980"
                                    class="form-control form-control-line flatpickr" value='{{ old('tgl_mulai_kerja') }}'
                                    name='tgl_mulai_kerja'>

                                @error('tgl_mulai_kerja')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Status</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='status'>
                                    @foreach(['Aktif', 'Tidak Aktif'] as $status)
                                    <option value="{{ $status }}" @if(old('status')==$status)
                                        selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>

                                @error('status')
                                <span class="invalid-feedback" role="alert">
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