@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4></h4>
    <a href="{{ route('mutasi.printAll') }}" target="_blank" class="btn btn-success btn-sm">
        🖨️ Print File
    </a>
</div>

<div class="container">
    <h2>Data Mutasi Penduduk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<form action="{{ route('mutasi.index') }}" method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="kk" class="form-control" placeholder="Cari berdasarkan KK" value="{{ request('kk') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>
    <table class="table table-bordered">
       <thead>
    <tr>
        <th>No</th>
        <th>No KK</th>
        <th>Nama Lengkap</th>
        <th>NIK</th>
        <th>Alamat Asal</th>
        <th>Alamat Tujuan</th>
        <th>Jenis Mutasi</th>
        <th>Tanggal Mutasi</th>
        <th>keterangan</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($mutasi as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->no_kk }}</td>
        <td>{{ $item->nama_lengkap }}</td>
        <td>{{ $item->nik }}</td>
        <td>{{ $item->alamat_asal }}</td>
        <td>{{ $item->alamat_tujuan }}</td>
        <td>{{ ucfirst($item->jenis_mutasi) }}</td>
        <td>{{ $item->tanggal_mutasi }}</td>
        <td>{{ $item->keterangan }}</td>

      <td class="d-flex">
    <a href="{{ route('mutasi.edit', $item->id) }}" class="btn btn-sm btn-warning me-2">
        <i class="fa fa-edit"></i> Edit
    </a>
        </tr>
    @endforeach
</tbody>
    </table>
</div>
@endsection
