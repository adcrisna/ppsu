@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Profile</li>
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
                        <h3 class="box-title">Profile Admin</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <form action="{{ route('admin.updateProfile') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="hidden" name="id" readonly class="form-control"
                                    value="{{ $admin->id }}" readonly>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Nama :</label>
                                <input type="text" name="name" class="form-control" value="{{ $admin->name }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Username :</label>
                                <input type="text" name="username" class="form-control" value="{{ $admin->username }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Email :</label>
                                <input type="email" name="email" class="form-control" value="{{ $admin->email }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Alamat :</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="5" rows="3">{{ $admin->alamat }}</textarea>
                            </div>
                            <div class="form-group has-feedback">
                                <label>No Telepon :</label>
                                <input type="text" name="phone" class="form-control" value="{{ $admin->telepon }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>NIP :</label>
                                <input type="text" name="nip" class="form-control" value="{{ $admin->nip }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>NIK :</label>
                                <input type="text" name="nik" class="form-control" value="{{ $admin->nik }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Password Baru:</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder=" Masukan Password Baru">
                            </div>
                            <div class="row">
                                <div class="col-xs-2 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ubah</button>
                                </div>
                            </div>
                        </form>
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
