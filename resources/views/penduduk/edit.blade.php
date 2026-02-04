@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Penduduk</h2>

    <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label>No KK</label>
            <input type="text" name="no_kk" class="form-control"
                value="{{ old('no_kk', $penduduk->no_kk) }}" required maxlength="16" pattern="\d{16}" inputmode="numeric" title="No KK harus 16 digit angka">
        </div>

        <div class="form-group mt-2">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control"
                value="{{ old('nik', $penduduk->nik) }}" required maxlength="16" pattern="\d{16}" inputmode="numeric" title="NIK harus 16 digit angka">
        </div>

        <div class="form-group mt-2">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control"
                value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Agama</label>
            <select name="agama" class="form-control" required>
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" {{ old('agama', $penduduk->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $penduduk->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $penduduk->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $penduduk->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $penduduk->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $penduduk->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Pendidikan</label>
            <select name="pendidikan" class="form-control" required>
                <option value="">-- Pilih Pendidikan --</option>
                <option value="Tidak/Belum Sekolah" {{ old('pendidikan', $penduduk->pendidikan) == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                <option value="Belum Tamat SD/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'Belum Tamat SD/Sederajat' ? 'selected' : '' }}>Belum Tamat SD/Sederajat</option>
                <option value="Tamat SD/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'Tamat SD/Sederajat' ? 'selected' : '' }}>Tamat SD/Sederajat</option>
                <option value="SLTP/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'SLTP/Sederajat' ? 'selected' : '' }}>SLTP/Sederajat</option>
                <option value="SLTA/Sederajat" {{ old('pendidikan', $penduduk->pendidikan) == 'SLTA/Sederajat' ? 'selected' : '' }}>SLTA/Sederajat</option>
                <option value="Diploma I/II" {{ old('pendidikan', $penduduk->pendidikan) == 'Diploma I/II' ? 'selected' : '' }}>Diploma I/II</option>
                <option value="Akademi/Diploma III/Sarjana Muda" {{ old('pendidikan', $penduduk->pendidikan) == 'Akademi/Diploma III/Sarjana Muda' ? 'selected' : '' }}>Akademi/Diploma III/Sarjana Muda</option>
                <option value="Diploma IV/Strata I" {{ old('pendidikan', $penduduk->pendidikan) == 'Diploma IV/Strata I' ? 'selected' : '' }}>Diploma IV/Strata I</option>
                <option value="Strata II" {{ old('pendidikan', $penduduk->pendidikan) == 'Strata II' ? 'selected' : '' }}>Strata II</option>
                <option value="Strata III" {{ old('pendidikan', $penduduk->pendidikan) == 'Strata III' ? 'selected' : '' }}>Strata III</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Pekerjaan</label>
            <input type="text" name="jenis_pekerjaan" class="form-control"
                value="{{ old('jenis_pekerjaan', $penduduk->jenis_pekerjaan) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Golongan Darah</label>
                        <select name="golongan_darah" class="form-control">
                <option value="">-</option>
                <option value="A" {{ old('golongan_darah', $penduduk->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('golongan_darah', $penduduk->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('golongan_darah', $penduduk->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O" {{ old('golongan_darah', $penduduk->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Status Perkawinan</label>
                        <select name="status_perkawinan" class="form-control" required>
                <option value="">-- Pilih Status Perkawinan --</option>
                <option value="Belum Kawin" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Kawin Tercatat" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Kawin Tercatat' ? 'selected' : '' }}>Kawin Tercatat</option>
                <option value="Kawin Belum Tercatat" {{ old('status_perkawinan', $penduduk->status_perkawinan) == 'Kawin Belum Tercatat' ? 'selected' : '' }}>Kawin Belum Tercatat</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Tanggal Perkawinan</label>
            <input type="date" name="tanggal_perkawinan" class="form-control"
                value="{{ old('tanggal_perkawinan', $penduduk->tanggal_perkawinan) }}">
        </div>

        <div class="form-group mt-2">
            <label>Status Hubungan dalam Keluarga</label>
                        <select name="status_hubungan_dalam_keluarga" class="form-control" required>
                <option value="">-- Pilih Status Hubungan Dalam Keluarga --</option>
                <option value="Kepala Keluarga" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                <option value="Istri" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                <option value="Anak" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Orang Tua" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="Famili Lain" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                <option value="Cucu" {{ old('status_hubungan_dalam_keluarga', $penduduk->status_hubungan_dalam_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control"
                value="{{ old('kewarganegaraan', $penduduk->kewarganegaraan) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Nama Ayah</label>
            <input type="text" name="nama_ayah" class="form-control"
                value="{{ old('nama_ayah', $penduduk->nama_ayah) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Nama Ibu</label>
            <input type="text" name="nama_ibu" class="form-control"
                value="{{ old('nama_ibu', $penduduk->nama_ibu) }}" required>
        </div>

        <div class="form-group mt-2">
            <label>Dusun</label>
                        <select name="dusun" class="form-control" required>
                <option value="">-- Pilih Dusun --</option>
                <option value="Dusun Cendrawasih" {{ old('dusun', $penduduk->dusun) == 'Dusun Cendrawasih' ? 'selected' : '' }}>Dusun Cendrawasih</option>
                <option value="Dusun Merak Jingga" {{ old('dusun', $penduduk->dusun) == 'Dusun Merak Jingga' ? 'selected' : '' }}>Dusun Merak Jingga</option>
                <option value="Dusun Garuda" {{ old('dusun', $penduduk->dusun) == 'Dusun Garuda' ? 'selected' : '' }}>Dusun Garuda</option>
                <option value="Dusun Merpatih Putih" {{ old('dusun', $penduduk->dusun) == 'Dusun Merpatih Putih' ? 'selected' : '' }}>Dusun Merpatih Putih</option>
                <option value="Dusun Rajawali" {{ old('dusun', $penduduk->dusun) == 'Dusun Rajawali' ? 'selected' : '' }}>Dusun Rajawali</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>
@endsection
