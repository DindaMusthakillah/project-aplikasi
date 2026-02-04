@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-4 mb-0">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                </select>
            </div>
            <div class="form-group col-md-8 mb-0 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if($user->approved)
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <form method="POST" action="{{ route('users.updateRole', $user->id) }}" class="form-inline mb-2">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-control form-control-sm mr-2">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="pegawai" {{ $user->role === 'pegawai' ? 'selected' : '' }}>pegawai</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                            <div class="d-flex align-items-center mb-2">
                                <form method="POST" action="{{ route('users.updateApproval', $user->id) }}" class="mr-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="approved" value="{{ $user->approved ? 0 : 1 }}">
                                    @if($user->approved)
                                        <button type="submit" class="btn btn-sm btn-warning">Nonaktifkan</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                    @endif
                                </form>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Belum ada user terdaftar.
        </div>
    @endif
</div>
@endsection
