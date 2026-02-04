@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Mutasi Penduduk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@if(count($mutasi) > 0)
    <div class="accordion" id="kkMutasiAccordion">
        @foreach($mutasi as $no_kk => $items)
            @php $kkId = 'mutasi_kk_' . $loop->index; @endphp
            <div class="card mb-2">
                <div class="card-header d-flex align-items-center justify-content-between" id="heading-{{ $kkId }}">
                    <div>
                        <strong>No KK:</strong> {{ $no_kk }}
                        <span class="text-muted ml-2">({{ $items->count() }} data)</span>
                    </div>
                    <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="collapse"
                        data-target="#collapse-{{ $kkId }}" aria-expanded="false" aria-controls="collapse-{{ $kkId }}">
                        Lihat Mutasi
                    </button>
                </div>
                <div id="collapse-{{ $kkId }}" class="collapse" aria-labelledby="heading-{{ $kkId }}" data-parent="#kkMutasiAccordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIK</th>
                                        <th>Alamat Asal</th>
                                        <th>Alamat Tujuan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Tanggal Mutasi</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->alamat_asal }}</td>
                                        <td>{{ $item->alamat_tujuan }}</td>
                                        <td>{{ ucfirst($item->status_mutasi) }}</td>
                                        <td>{{ $item->tanggal_mutasi }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('mutasi.edit', $item->id) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                                <form action="{{ route('mutasi.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-2">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
<div class="alert alert-info" role="alert">
    <i class="fas fa-info-circle"></i> Tidak ada data mutasi dalam tabel.
</div>
@endif
</div>
@endsection
