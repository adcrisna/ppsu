@extends('layouts.koordinator')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('koordinator.home') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Jadwal</li>
        </ol>
    </section>
    <br />
    <br />
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-warning">
                    {{ \Session::get('msg_success') }}
                </div>
            </h5>
        @endif
        @if (\Session::has('msg_error'))
            <h5>
                <div class="alert alert-danger">
                    {{ \Session::get('msg_error') }}
                </div>
            </h5>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header text-center">
                        <h3 class="box-title">Jadwal Tim</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-kegiatan">
                            <thead>
                                <tr>
                                    <th style="width: 50%">Tim</th>
                                    <td> {{ $tim->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Hari</th>
                                    <td>
                                        @foreach ($jadwal->hari as $item)
                                            {{ $item }},
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Area</th>
                                    <td> {{ $tim->Area->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Alamat</th>
                                    <td> {{ $tim->Area->alamat }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Koordinator</th>
                                    <td> {{ $tim->Koordinator->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Jumlah Personel</th>
                                    <td>{{ $tim->jumlah_personel }} Orang</td>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br />
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
@endsection
