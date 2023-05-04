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
        <h1 class="page-header">Laporan {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Urutkan {{ ucwords(preg_replace("/_/", " ", Request::segment(1))) }}</div>
            <div class="panel-body">
                <div class="col-md-12">

                    <form class="form-horizontal form-material" action="{{ url(route('pegawai.print')) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="col-md-12">Jenis Kelamin</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='jenis_kelamin'>
                                    @foreach(['', 'Laki - Laki', 'Perempuan'] as $jenis_kelamin)
                                    <option value="{{ $jenis_kelamin }}" @if(old('jenis_kelamin')==$jenis_kelamin)
                                        selected @endif>{{ ucwords($jenis_kelamin) }}</option>
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
                                    @foreach(['', 'Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha'] as $agama)
                                    <option value="{{ $agama }}" @if(old('agama')==$agama)
                                        selected @endif>{{ ucwords($agama) }}</option>
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
                            <label class="col-md-12">Status</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='status'>
                                    @foreach(['', 'Aktif', 'Tidak Aktif'] as $status)
                                    <option value="{{ $status }}" @if(old('status')==$status)
                                        selected @endif>{{ ucwords($status) }}</option>
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
                            <label class="col-md-12">Field</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='field'  required>
                                    @foreach(['id', 'nama', 'tanggal_lahir', 'tempat_lahir', 'jenis_kelamin', 'agama', 'no_telp', 'tanggal_mulai_kerja', 'status'] as $field)
                                    <option value="{{ $field }}" @if(old('field')==$field)
                                        selected @endif>{{ ucwords(preg_replace("/_/", " ", $field)) }}</option>
                                    @endforeach
                                </select>

                                @error('field')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Order</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='order'  required>
                                    @foreach(['ASC', 'DESC'] as $order)
                                    <option value="{{ $order }}" @if(old('order')==$order)
                                        selected @endif>{{ $order }}</option>
                                    @endforeach
                                </select>

                                @error('order')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Limit</label>
                            <div class="col-md-12">
                                <input type="number" placeholder="{{ $limit }}"
                                    class="form-control form-control-line" id="example-limit"
                                    value='{{ old('limit') == "" ? $limit : old('limit') }}' name='limit' max='{{ $limit }}' min=1 required>

                                @error('limit')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Print</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection