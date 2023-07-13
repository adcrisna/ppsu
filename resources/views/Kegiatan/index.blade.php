@extends('layouts.admin')
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
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exportModal"><i
                                    class="fa fa-download"></i>
                                Laporan</button>
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
                                            @if (@$value->status == 'Menunggu')
                                                <button class="btn btn-xs btn-success btn-edit-kegiatan"><i
                                                        class="fa fa-check">
                                                    </i></button>
                                            @endif
                                            <a href="{{ route('admin.detail', $value->id) }}"
                                                class="btn btn-xs btn-info"><i class="fa fa-eye">
                                                </i> Detail</a>
                                            <a href="{{ route('admin.deleteKegiatan', $value->id) }}"
                                                class="btn btn-xs btn-danger"
                                                onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                    class="fa fa-trash">
                                                </i> Hapus</a>
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
    <div class="modal fade" id="modal-form-edit-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Update Status</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateKegiatan') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="id" readonly class="form-control" placeholder="ID" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Status :</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Setujui">Setujui</option>
                                <option value="Tolak">Tolak</option>
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Catatan :</label>
                            <textarea name="catatan" class="form-control" id="catatan" cols="5" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
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
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggalAwal" class="form-control" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggalAkhir" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </form>
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
            $('#modal-form-edit-kegiatan').modal('show');
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
