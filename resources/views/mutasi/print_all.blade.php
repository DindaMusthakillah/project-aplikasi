<!DOCTYPE html>
<html>
<head>
    <title>Data Mutasi Penduduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

    <script>
        window.onload = function() {
            window.print(); // otomatis buka dialog print
            setTimeout(function(){
                window.location.href = "{{ route('mutasi.index') }}"; // balik ke halaman menu mutasi
            }, 1000); // setelah 1 detik langsung balik
        }
    </script>
</head>
<body>
    <h2 style="text-align: center;">Data Mutasi Penduduk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penduduk</th>
                <th>Alamat Asal</th>
                <th>Alamat Tujuan</th>
                <th>Jenis Mutasi</th>
                <th>Tanggal Mutasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataMutasi as $index => $mutasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mutasi->nama_penduduk ?? '-' }}</td>
                    <td>{{ $mutasi->alamat_asal ?? '-' }}</td>
                    <td>{{ $mutasi->alamat_tujuan ?? '-' }}</td>
                    <td>{{ $mutasi->jenis_mutasi ?? '-' }}</td>
                    <td>{{ $mutasi->tanggal_mutasi ?? '-' }}</td>
                    <td>{{ $mutasi->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
Compare this snippet from resources/views/mutasi/index.blade.php:
@extends('layouts.app')