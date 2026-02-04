@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Penduduk</h2>

<form action="{{ route('mutasi.update', $mutasi->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label>No KK</label>
            <input type="text" name="no_kk" class="form-control"
                value="{{ old('no_kk', $mutasi->no_kk) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $mutasi->nama_lengkap) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control"
                value="{{ old('nik', $mutasi->nik) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $mutasi->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $mutasi->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control"
                value="{{ old('tempat_lahir', $mutasi->tempat_lahir) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                value="{{ old('tanggal_lahir', $mutasi->tanggal_lahir) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Agama</label>
<select name="agama" class="form-control" required>
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" {{ old('agama', $mutasi->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $mutasi->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $mutasi->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $mutasi->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $mutasi->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $mutasi->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label>Pendidikan</label>
            <select name="pendidikan" class="form-control" required>
                <option value="">-- Pilih Pendidikan --</option>
                <option value="Tidak/Belum Sekolah" {{ old('pendidikan', $mutasi->pendidikan) == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                <option value="Belum Tamat SD/Sederajat" {{ old('pendidikan', $mutasi->pendidikan) == 'Belum Tamat SD/Sederajat' ? 'selected' : '' }}>Belum Tamat SD/Sederajat</option>
                <option value="Tamat SD/Sederajat" {{ old('pendidikan', $mutasi->pendidikan) == 'Tamat SD/Sederajat' ? 'selected' : '' }}>Tamat SD/Sederajat</option>
                <option value="SLTP/Sederajat" {{ old('pendidikan', $mutasi->pendidikan) == 'SLTP/Sederajat' ? 'selected' : '' }}>SLTP/Sederajat</option>
                <option value="SLTA/Sederajat" {{ old('pendidikan', $mutasi->pendidikan) == 'SLTA/Sederajat' ? 'selected' : '' }}>SLTA/Sederajat</option>
                <option value="Diploma I/II" {{ old('pendidikan', $mutasi->pendidikan) == 'Diploma I/II' ? 'selected' : '' }}>Diploma I/II</option>
                <option value="Akademi/Diploma III/Sarjana Muda" {{ old('pendidikan', $mutasi->pendidikan) == 'Akademi/Diploma III/Sarjana Muda' ? 'selected' : '' }}>Akademi/Diploma III/Sarjana Muda</option>
                <option value="Diploma IV/Strata I" {{ old('pendidikan', $mutasi->pendidikan) == 'Diploma IV/Strata I' ? 'selected' : '' }}>Diploma IV/Strata I</option>
                <option value="Strata II" {{ old('pendidikan', $mutasi->pendidikan) == 'Strata II' ? 'selected' : '' }}>Strata II</option>
                <option value="Strata III" {{ old('pendidikan', $mutasi->pendidikan) == 'Strata III' ? 'selected' : '' }}>Strata III</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Pekerjaan</label>
            <input type="text" name="jenis_pekerjaan" class="form-control"
                value="{{ old('jenis_pekerjaan', $mutasi->jenis_pekerjaan) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Golongan Darah</label>
                        <select name="golongan_darah" class="form-control" required>
                <option value="">-- Pilih Golongan Darah --</option>
                <option value="A" {{ old('golongan_darah', $mutasi->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('golongan_darah', $mutasi->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('golongan_darah', $mutasi->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O" {{ old('golongan_darah', $mutasi->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Status Perkawinan</label>
                        <select name="status_perkawinan" class="form-control" required>
                <option value="">-- Pilih Status Perkawinan --</option>
                <option value="Belum Kawin" {{ old('status_perkawinan', $mutasi->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Kawin Tercatat" {{ old('status_perkawinan', $mutasi->status_perkawinan) == 'Kawin Tercatat' ? 'selected' : '' }}>Kawin Tercatat</option>
                <option value="Kawin Belum Tercatat" {{ old('status_perkawinan', $mutasi->status_perkawinan) == 'Kawin Belum Tercatat' ? 'selected' : '' }}>Kawin Belum Tercatat</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Tanggal Perkawinan</label>
            <input type="date" name="tanggal_perkawinan" class="form-control"
                value="{{ old('tanggal_perkawinan', $mutasi->tanggal_perkawinan) }}">
        </div>

        <div class="form-group mt-2">
            <label>Status Hubungan dalam Keluarga</label>
                        <select name="status_hubungan_dalam_keluarga" class="form-control" required>
                <option value="">-- Pilih Status Hubungan Dalam Keluarga --</option>
                <option value="Kepala Keluarga" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                <option value="Istri" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                <option value="Anak" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Orang Tua" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="Famili Lain" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                <option value="Cucu" {{ old('status_hubungan_dalam_keluarga', $mutasi->status_hubungan_dalam_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control"
                value="{{ old('kewarganegaraan', $mutasi->kewarganegaraan) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Nama Ayah</label>
            <input type="text" name="nama_ayah" class="form-control"
                value="{{ old('nama_ayah', $mutasi->nama_ayah) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Nama Ibu</label>
            <input type="text" name="nama_ibu" class="form-control"
                value="{{ old('nama_ibu', $mutasi->nama_ibu) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Dusun</label>
                        <select name="dusun" class="form-control" required>
                <option value="">-- Pilih Dusun --</option>
                <option value="Dusun Cendrawasih" {{ old('dusun', $mutasi->dusun) == 'Dusun Cendrawasih' ? 'selected' : '' }}>Dusun Cendrawasih</option>
                <option value="Dusun Merak Jingga" {{ old('dusun', $mutasi->dusun) == 'Dusun Merak Jingga' ? 'selected' : '' }}>Dusun Merak Jingga</option>
                <option value="Dusun Garuda" {{ old('dusun', $mutasi->dusun) == 'Dusun Garuda' ? 'selected' : '' }}>Dusun Garuda</option>
                <option value="Dusun Merpatih Putih" {{ old('dusun', $mutasi->dusun) == 'Dusun Merpatih Putih' ? 'selected' : '' }}>Dusun Merpatih Putih</option>
                <option value="Dusun Rajawali" {{ old('dusun', $mutasi->dusun) == 'Dusun Rajawali' ? 'selected' : '' }}>Dusun Rajawali</option>
            </select>
        </div>

                <div class="form-group mt-2">
            <label>Alamat Tujuan</label>
            <input type="text" name="alamat_tujuan" class="form-control"
                value="{{ old('alamat_tujuan', $mutasi->alamat_tujuan) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Jenis Mutasi</label>
            <select name="status_mutasi" class="form-control" required>
                <option value="">-- Pilih Jenis Mutasi --</option>
                <option value="Pindah Keluar" {{ old('status_mutasi', $mutasi->status_mutasi) == 'Pindah Keluar' ? 'selected' : '' }}>Pindah Keluar</option>
                <option value="Pindah Masuk" {{ old('status_mutasi', $mutasi->status_mutasi) == 'Pindah Masuk' ? 'selected' : '' }}>Pindah Masuk</option>
                <option value="Meninggal" {{ old('status_mutasi', $mutasi->status_mutasi) == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                <option value="Lahir" {{ old('status_mutasi', $mutasi->status_mutasi) == 'Lahir' ? 'selected' : '' }}>Lahir</option>
            </select>

        </div>
        <div class="form-group mt-2">
            <label>Tanggal Mutasi</label>
            <input type="date" name="tanggal_mutasi" class="form-control"
                value="{{ old('tanggal_mutasi', $mutasi->tanggal_mutasi) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control"
                value="{{ old('keterangan', $mutasi->keterangan) }}">
        </div>


        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>
@endsection
