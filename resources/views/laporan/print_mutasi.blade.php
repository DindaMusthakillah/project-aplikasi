<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Mutasi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin: 6px 0 4px; }
        h4 { text-align: center; margin: 0 0 6px; font-weight: normal; }
        .kop { border-bottom: 2px solid #000; padding-bottom: 8px; margin-bottom: 12px; }
        .kop-table { width: 100%; border-collapse: collapse; }
        .kop-table td { border: none; }
        .kop-logo { width: 90px; }
        .logo-wrap {
            width: 70px;
            height: 70px;
            overflow: hidden;
            border-radius: 6px;
        }
        .logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .kop-text { text-align: center; }
        .meta { margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #f0f0f0; }
        .ttd { width: 100%; margin-top: 24px; }
        .ttd td { border: none; }
        .ttd .right { text-align: right; }
    </style>
</head>
<body>
    <div class="kop">
        <table class="kop-table">
            <tr>
                <td class="kop-logo" style="vertical-align: middle;">
                    <div class="logo-wrap">
                        <img src="{{ public_path('img/pancacita.jpeg') }}" alt="Logo Pancacita">
                    </div>
                </td>
                <td class="kop-text" style="vertical-align: middle;">
                    <div>{{ $kop['kabupaten'] }}</div>
                    <div>{{ $kop['kecamatan'] }}</div>
                    <div>{{ $kop['desa'] }}</div>
                    <div>{{ $kop['alamat'] }}</div>
                </td>
                <td class="kop-logo"></td>
            </tr>
        </table>
    </div>
    <h2>Laporan Data Mutasi</h2>
    <h4>Periode: {{ date('d-m-Y') }}</h4>
    <div class="meta">Filter Status: {{ $status ? $status : 'Semua' }} | Tanggal: {{ $tanggal ? $tanggal : 'Semua' }}</div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Status Mutasi</th>
                <th>Tanggal Mutasi</th>
                <th>Alamat Asal</th>
                <th>Alamat Tujuan</th>
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
                <td>{{ $item->alamat_asal ?? '-' }}</td>
                <td>{{ $item->alamat_tujuan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="ttd">
        <tr>
            <td></td>
            <td class="right">
                <div>................, {{ date('d-m-Y') }}</div>
                <div>Kepala Desa</div>
                <br><br><br>
                <div><strong>(........................)</strong></div>
            </td>
        </tr>
    </table>
</body>
</html>
