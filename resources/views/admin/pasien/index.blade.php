@extends('admin.partials.index')

@push($title)
    active
@endpush

@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item active">Data Pasien</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end">
                    <button name="btnADD" id="btnADD" type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#basicModal">
                        Tambah Data
                    </button>
                </div>
                <div class="col-lg-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Tgl Lahir</th>
                                <th>No. Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('admin.pasien.form')
@endsection
