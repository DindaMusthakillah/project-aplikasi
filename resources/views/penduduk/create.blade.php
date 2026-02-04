@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Penduduk</h2>
    <form action="{{ route('penduduk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>No KK</label>
            <input type="text" name="no_kk" class="form-control" required maxlength="16" pattern="\d{16}" inputmode="numeric" title="No KK harus 16 digit angka">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required maxlength="16" pattern="\d{16}" inputmode="numeric" title="NIK harus 16 digit angka">
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
         <div class="form-group">
            <label>Agama</label>
            <select name="agama" class="form-control" required>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>
        <div class="form-group">
            <label>Pendidikan</label>
            <select name="pendidikan" class="form-control" required>
                <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                <option value="Belum Tamat SD/Sederajat">Belum Tamat SD/Sederajat</option>
                <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                <option value="Diploma/I/II">Diploma/I/II</option>
                <option value="SLTP/Sederajat">Akademi/Diploma III/Sarjana Muda</option>
                <option value="SLTP/Sederajat">Diploma IV/Strata I</option>
                <option value="SLTP/Sederajat">Strata II</option>
                <option value="SLTP/Sederajat">Strata III</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jenis Pekerjaan</label>
            <input type="text" name="jenis_pekerjaan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Golongan Darah</label>
            <select name="golongan_darah" class="form-control">
                <option value="">-</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control" required>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Kawin Tercatat">Kawin Tercatat</option>
                <option value="kawin belum Tercatat">kawin belum Tercatat</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Perkawinan</label>
            <input type="date" name="tanggal_perkawinan" class="form-control">
        </div>
        <div class="form-group">
            <label>Status Hubungan Dalam Keluarga</label>
            <select name="status_hubungan_dalam_keluarga" class="form-control" required>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Famili Lain">Famili Lain</option>
                <option value="Cucu">Cucu</option>
            </select>
        </div>
        <div class="form-group">
            <label>Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control" required>
        </div>
       <div class="form-group">
    <label>Nama Ayah</label>
    <input type="text" name="nama_ayah" class="form-control" required>
</div>
<div class="form-group">
    <label>Nama Ibu</label>
    <input type="text" name="nama_ibu" class="form-control" required>
</div>
<div class="form-group">
            <label>Dusun</label>
            <select name="dusun" class="form-control" required>
                <option value="Dusun Cendrawasih">Dusun Cendrawasih</option>
                <option value="Dusun Merak Jingga">Dusun Merak Jingga</option>
                <option value="Dusun Garuda">Dusun Garuda</option>
                <option value="Dusun Merpatih Putih">Dusun Merpatih Putih</option>
                <option value="Dusun Rajawali">Dusun Rajawali</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
