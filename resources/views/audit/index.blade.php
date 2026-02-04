@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Audit Log</h2>

    <form method="GET" action="{{ route('audit.index') }}" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>User</label>
                <select name="user_id" class="form-control">
                    <option value="">Semua</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Aksi</label>
                <select name="action" class="form-control">
                    <option value="">Semua</option>
                    <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>create</option>
                    <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>update</option>
                    <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>delete</option>
                    <option value="mutasi" {{ request('action') == 'mutasi' ? 'selected' : '' }}>mutasi</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Target</label>
                <select name="target_type" class="form-control">
                    <option value="">Semua</option>
                    <option value="penduduk" {{ request('target_type') == 'penduduk' ? 'selected' : '' }}>penduduk</option>
                    <option value="mutasi" {{ request('target_type') == 'mutasi' ? 'selected' : '' }}>mutasi</option>
                    <option value="user" {{ request('target_type') == 'user' ? 'selected' : '' }}>user</option>
                    <option value="settings" {{ request('target_type') == 'settings' ? 'selected' : '' }}>settings</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Filter</button>
        <a href="{{ route('audit.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    @if($logs->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Target</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ optional($log->user)->name ?? '-' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->target_type }} {{ $log->target_id ? '#' . $log->target_id : '' }}</td>
                            <td>{{ $log->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Belum ada aktivitas.</div>
    @endif
</div>
@endsection
