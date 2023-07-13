@extends('layouts.koordinator')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
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
            <li class="active">Data Kegiatan</li>
        </ol>
        <br />
    </section>
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-info">
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
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Kegiatan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                data-target="#modal-form-tambah-kegiatan"><i class="fa fa-plus"> Tambah Data
                                </i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-kegiatan">
                            <thead>
                                <tr>
                                    <th style="display: none">No</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>TIM</th>
                                    <th>Sumber Informasi</th>
                                    <th>Kondisi Lapangan</th>
                                    <th>Penanganan</th>
                                    <th>Proses Pengerjaan</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$kegiatan as $key => $value)
                                    <tr>
                                        <td style="display: none">{{ @$value->id }}</td>
                                        <td>{{ @$value->tanggal_mulai }}</td>
                                        <td>{{ @$value->tanggal_selesai }}</td>
                                        <td>{{ @$value->Tim->name }}</td>
                                        <td>{{ @$value->sumber_informasi }}</td>
                                        <td>{{ @$value->kondisi_lapangan }}</td>
                                        <td>{{ @$value->penanganan }}</td>
                                        <td>{{ @$value->proses_pengerjaan }}</td>
                                        <td>{{ @$value->keterangan }}</td>
                                        <td>{{ @$value->status }}</td>
                                        <td>
                                            <a href="{{ route('koordinator.detail', $value->id) }}"
                                                class="btn btn-xs btn-info"><i class="fa fa-eye">
                                                </i> Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-form-tambah-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Data Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('koordinator.addKegiatan') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="tim" readonly class="form-control" value="{{ $tim->id }}"
                                readonly>
                            <input type="text" name="timName" readonly class="form-control" value="{{ $tim->name }}"
                                readonly>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tanggalMulai" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal Selesai</label>
                            <input type="date" name="tanggalSelesai" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Sumber Informasi</label>
                            <select name="sumberInformasi" id="sumberInformasi" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Pimpinan">Pimpinan</option>
                                <option value="Survei Lapangan">Survei Lapangan</option>
                                <option value="Laporan Masyarakat">Laporan Masyarakat</option>
                                <option value="Laporan CRM">Laporan CRM</option>
                                <option value="Koordinasi SKPD Terkait">Koordinasi SKPD Terkait</option>
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Kondisi Lapangan</label>
                            <input type="text" name="kondisiLapangan" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Penanganan</label>
                            <input type="text" name="penanganan" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Proses Pengerjaan</label>
                            <input type="text" name="prosesPengerjaan" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="5" rows="3"></textarea>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Sebelum Dikerjakan</label>
                            <input type="file" name="foto1" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Sedang Dikerjakan</label>
                            <input type="file" name="foto2" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Selesai Dikerjakan</label>
                            <input type="file" name="foto3" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var table = $('#data-kegiatan').DataTable();

        $('#data-kegiatan').on('click', '.btn-edit-kegiatan', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('select[name=hari]').val(row[1]);
            $('select[name=tim]').val(row[2]);
            $('#modal-form-edit-kegiatan').modal('show');
        });
        $('#modal-form-tambah-kegiatan').on('show.bs.modal', function() {
            $('select[name=hari]').val('');
            $('select[name=tim]').val('');
        });

        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
