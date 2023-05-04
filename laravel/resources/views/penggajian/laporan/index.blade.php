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

                    <form class="form-horizontal form-material" action="{{ url(route('penggajian.print')) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="col-md-12">Periode</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='periode'>
                                    @foreach($periodes as $periode)
                                    <option value="{{ $periode }}" @if(old('periode')==$periode)
                                        selected @endif>{{ ucwords($periode) }}</option>
                                    @endforeach
                                </select>

                                @error('periode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Tahun</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name='tahun'>
                                    @foreach($tahuns as $tahun)
                                    <option value="{{ $tahun }}" @if(old('tahun')==$tahun)
                                        selected @endif>{{ ucwords($tahun) }}</option>
                                    @endforeach
                                </select>

                                @error('tahun')
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
                                    @foreach(['id', 'gaji', 'tunjangan', 'bonus', 'periode', 'tahun', 'tanggal', 'catatan'] as $field)
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