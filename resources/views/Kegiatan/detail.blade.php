@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <style>
        img.zoom {
            width: 130px;
            height: 100px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }

        .transisi {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -o-transform: scale(1.8);
            transform: scale(1.8);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Detail</li>
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
                    <div class="box-header">
                        <h3 class="box-title">Detail Kegiatan</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('admin.kegiatan') }}" class="btn btn-sm btn-warning">
                                Kembali</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-kegiatan">
                            <thead>
                                <tr>
                                    <th style="width: 50%">Tanggal Mulai</th>
                                    <td> {{ $detail->tanggal_mulai }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Tanggal Selesai</th>
                                    <td> {{ $detail->tanggal_selesai }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Tim</th>
                                    <td> {{ $detail->Tim->name }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Sumber Informasi</th>
                                    <td> {{ $detail->sumber_informasi }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Kondisi Lapangan</th>
                                    <td> {{ $detail->kondisi_lapangan }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Penanganan</th>
                                    <td>{{ $detail->penanganan }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Proses Pengerjaan</th>
                                    <td>{{ $detail->proses_pengerjaan }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Keterangan</th>
                                    <td>{{ $detail->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Status</th>
                                    <td>{{ $detail->status }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Foto Sebelum Dikerjakan</th>
                                    <td><img class="zoom" src="{{ asset('foto/' . @$detail->foto1) }}"></td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Foto Sedang Dikerjakan</th>
                                    <td><img class="zoom" src="{{ asset('foto/' . @$detail->foto2) }}"></td>
                                </tr>
                                <tr>
                                    <th style="width: 50%">Foto Selesai Dikerjakan</th>
                                    <td><img class="zoom" src="{{ asset('foto/' . @$detail->foto3) }}"></td>
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
    <script>
        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
