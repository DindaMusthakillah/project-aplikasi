@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pengaturan Sistem</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('settings.update') }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label>Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $settings['kabupaten'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $settings['kecamatan'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Desa</label>
                    <input type="text" name="desa" class="form-control" value="{{ old('desa', $settings['desa'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $settings['alamat'] ?? '') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
