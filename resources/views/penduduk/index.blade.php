@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Penduduk</h2>
    <a href="{{ route('penduduk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@if(request('kk'))
    <div class="alert alert-info">
        <strong>No KK: {{ request('kk') }}</strong>
    </div>
@endif

@if(count($penduduk) > 0)
<div class="accordion" id="kkAccordion">
    @foreach($penduduk as $no_kk => $anggota)
        @php $kkId = 'kk_' . $loop->index; @endphp
        <div class="card mb-2">
            <div class="card-header d-flex align-items-center justify-content-between" id="heading-{{ $kkId }}">
                <div>
                    <strong>No KK:</strong> {{ $no_kk }}
                    <span class="text-muted ml-2">({{ $anggota->count() }} anggota)</span>
                </div>
                <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="collapse"
                    data-target="#collapse-{{ $kkId }}" aria-expanded="false" aria-controls="collapse-{{ $kkId }}">
                    Lihat Anggota
                </button>
            </div>
            <div id="collapse-{{ $kkId }}" class="collapse" aria-labelledby="heading-{{ $kkId }}" data-parent="#kkAccordion">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                    <th>Hubungan Keluarga</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                    <th>Dusun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($anggota as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ $item->agama }}</td>
                                        <td>{{ $item->pendidikan }}</td>
                                        <td>{{ $item->jenis_pekerjaan }}</td>
                                        <td>{{ $item->golongan_darah }}</td>
                                        <td>{{ $item->status_perkawinan }}</td>
                                        <td>{{ $item->tanggal_perkawinan }}</td>
                                        <td>{{ $item->status_hubungan_dalam_keluarga }}</td>
                                        <td>{{ $item->kewarganegaraan }}</td>
                                        <td>{{ $item->nama_ayah }}</td>
                                        <td>{{ $item->nama_ibu }}</td>
                                        <td>{{ $item->dusun }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('penduduk.edit', $item->id) }}" class="btn btn-secondary btn-sm mr-2">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                                <form action="{{ route('penduduk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-2">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('penduduk.showMutasiForm', $item->id) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-sync"></i> Mutasi
                                            </a>
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
    <i class="fas fa-info-circle"></i> Tidak ada data penduduk dalam tabel.
</div>
@endif
@endsection

