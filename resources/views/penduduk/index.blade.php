@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Penduduk</h2>
    <a href="{{ route('penduduk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form action="{{ route('penduduk.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="dusun" class="form-control" placeholder="Cari berdasarkan Dusun atau" value="{{ request('dusun') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>
@if(request('dusun'))

    <div class="alert alert-info">
        <strong>Dusun: {{ request('dusun') }}</strong><br>
        Jumlah Laki-laki: {{ $jumlahLaki }}<br>
        Jumlah Perempuan: {{ $jumlahPerempuan }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>No KK</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Golongan Darah</th>
                <th>Status Perkawinan</th>
                <th>Tanggal Perkawinan</th>
                <th>Status Hubungan Dalam Keluarga</th>
                <th>Kewarganegaraan</th>
                <th>Ayah</th>
                <th>Ibu</th>
                <th>Dusun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penduduk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_kk }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tempat_lahir }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->agama }}</td>
                    <td>{{ $item->pendidikan}}</td>
                    <td>{{ $item->jenis_pekerjaan}}</td>
                    <td>{{ $item->golongan_darah}}</td>
                    <td>{{ $item->status_perkawinan}}</td>
                    <td>{{ $item->tanggal_perkawinan}}</td>
                    <td>{{ $item->status_hubungan_dalam_keluarga}}</td>
                    <td>{{ $item->kewarganegaraan}}</td>
                    <td>{{ $item->nama_ayah}}</td>
                    <td>{{ $item->nama_ibu}}</td>
                    <td>{{ $item->dusun }}</td>

  <td class="d-flex">
    <a href="{{ route('penduduk.edit', $item->id) }}" class="btn btn-secondary btn-sm mr-2">
        <i class="fa fa-edit"></i> Edit
    </a>

    <form action="{{ route('penduduk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm mr-2">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </form>

<form action="{{ route('mutasi.index', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin memindahkan data ini ke Mutasi Penduduk?')">
    @csrf
    <button type="submit" class="btn btn-warning btn-sm mr-2"><i class="fas fa-sync"></i>Mutasi</button>
</form>       </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
