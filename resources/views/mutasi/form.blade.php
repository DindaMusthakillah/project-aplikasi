@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Mutasi Penduduk</h3>
    <form action="{{ route('penduduk.mutasiStore', $penduduk->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" value="{{ $penduduk->nama }}" readonly>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" class="form-control" value="{{ $penduduk->nik }}" readonly>
        </div>
        <div class="mb-3">
            <label>Status Mutasi</label>
            <select name="status_mutasi" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="Pindah">Pindah</option>
                <option value="Meninggal">Meninggal</option>
                <option value="Datang">Datang</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Masukkan keterangan (opsional)">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Mutasi</button>
    </form>
</div>
@endsection
