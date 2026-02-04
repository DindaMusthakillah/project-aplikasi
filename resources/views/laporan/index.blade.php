@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Laporan</h2>
        <div class="d-flex">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('laporan.print.penduduk', ['dusun' => $dusun]) }}" class="btn btn-sm btn-primary mr-2">Print Penduduk</a>
                <a href="{{ route('laporan.print.mutasi', ['status' => $status, 'tanggal' => $tanggal]) }}" class="btn btn-sm btn-warning mr-2">Print Mutasi</a>
                <a href="{{ route('laporan.print.all', ['dusun' => $dusun, 'status' => $status, 'tanggal' => $tanggal]) }}" class="btn btn-sm btn-success">Print Semua</a>
            @else
                <span class="text-muted small">Cetak laporan hanya untuk admin.</span>
            @endif
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Dusun</label>
                        <select name="dusun" class="form-control">
                            <option value="">Semua Dusun</option>
                            <option value="Dusun Cendrawasih" {{ $dusun == 'Dusun Cendrawasih' ? 'selected' : '' }}>Dusun Cendrawasih</option>
                            <option value="Dusun Merak Jingga" {{ $dusun == 'Dusun Merak Jingga' ? 'selected' : '' }}>Dusun Merak Jingga</option>
                            <option value="Dusun Garuda" {{ $dusun == 'Dusun Garuda' ? 'selected' : '' }}>Dusun Garuda</option>
                            <option value="Dusun Merpatih Putih" {{ $dusun == 'Dusun Merpatih Putih' ? 'selected' : '' }}>Dusun Merpatih Putih</option>
                            <option value="Dusun Rajawali" {{ $dusun == 'Dusun Rajawali' ? 'selected' : '' }}>Dusun Rajawali</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Status Mutasi</label>
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Pindah Keluar" {{ $status == 'Pindah Keluar' ? 'selected' : '' }}>Pindah Keluar</option>
                            <option value="Pindah Masuk" {{ $status == 'Pindah Masuk' ? 'selected' : '' }}>Pindah Masuk</option>
                            <option value="Meninggal" {{ $status == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                            <option value="Lahir" {{ $status == 'Lahir' ? 'selected' : '' }}>Lahir</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Mutasi</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mr-2">Terapkan Filter</button>
                    <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
                </div>
                <div class="card-body">
                    @if($penduduk->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No KK</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Dusun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penduduk as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->no_kk }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->dusun }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="mb-0">Belum ada data penduduk.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Data Mutasi</h6>
                </div>
                <div class="card-body">
                    @if($mutasi->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Status Mutasi</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mutasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->status_mutasi ?? '-' }}</td>
                                    <td>{{ $item->tanggal_mutasi ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="mb-0">Belum ada data mutasi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
