@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Mutasi Penduduk</h2>
    <p>Data penduduk yang akan dimutasi:</p>

    <form action="{{ route('penduduk.mutasi', $penduduk->id) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>No KK</label>
                    <input type="text" class="form-control" value="{{ $penduduk->no_kk }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $penduduk->nama_lengkap }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" class="form-control" value="{{ $penduduk->nik }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" class="form-control" value="{{ $penduduk->jenis_kelamin }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" value="{{ $penduduk->tempat_lahir }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" value="{{ $penduduk->tanggal_lahir }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Agama</label>
                    <input type="text" class="form-control" value="{{ $penduduk->agama }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dusun</label>
                    <input type="text" class="form-control" value="{{ $penduduk->dusun }}" readonly>
                </div>
            </div>
        </div>

        <hr>
        <h4>Informasi Mutasi</h4>

        <div class="form-group">
            <label>Alamat Tujuan <span class="text-danger">*</span></label>
            <input type="text" name="alamat_tujuan" class="form-control" placeholder="Masukkan alamat tujuan" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Mutasi <span class="text-danger">*</span></label>
                    <select name="jenis_mutasi" class="form-control" required>
                        <option value="">-- Pilih Jenis Mutasi --</option>
                        <option value="Pindah Keluar" selected>Pindah Keluar</option>
                        <option value="Pindah Masuk">Pindah Masuk</option>
                        <option value="Meninggal">Meninggal</option>
                        <option value="Lahir">Lahir</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Mutasi</label>
                    <input type="date" name="tanggal_mutasi" class="form-control" value="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> Mutasikan Data
            </button>
            <a href="{{ route('penduduk.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection
