@extends('layouts.app')

@section('content')
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

 <!-- Content Row -->
                    <div class="row">

                        <!-- Jumlah Penduduk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Penduduk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPenduduk }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah KK -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah KK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKK }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Laki-laki -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Laki-laki</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahLaki }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Perempuan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Perempuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPerempuan }} ({{ $persenPerempuan }}%)</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Penduduk Baru Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendudukHariIni }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Mutasi Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mutasiHariIni }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Diagram Jenis Mutasi</h6>
                </div>
                <div class="card-body">
                    <canvas id="mutasiChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan Mutasi</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-arrow-right text-warning"></i> Pindah Keluar</span>
                            <strong>{{ $mutasiPindahKeluar }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-arrow-left text-info"></i> Pindah Masuk</span>
                            <strong>{{ $mutasiPindahMasuk }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-cross text-danger"></i> Meninggal</span>
                            <strong>{{ $mutasiMeninggal }}</strong>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-baby text-success"></i> Lahir</span>
                            <strong>{{ $mutasiLahir }}</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total Mutasi</strong>
                        <strong>{{ $mutasiPindahKeluar + $mutasiPindahMasuk + $mutasiMeninggal + $mutasiLahir }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('mutasiChart').getContext('2d');
        const mutasiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pindah Keluar', 'Pindah Masuk', 'Meninggal', 'Lahir'],
                datasets: [{
                    label: 'Jumlah Mutasi',
                    data: [
                        {{ $mutasiPindahKeluar }},
                        {{ $mutasiPindahMasuk }},
                        {{ $mutasiMeninggal }},
                        {{ $mutasiLahir }}
                    ],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(33, 150, 243, 0.7)',
                        'rgba(244, 67, 54, 0.7)',
                        'rgba(76, 175, 80, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(33, 150, 243, 1)',
                        'rgba(244, 67, 54, 1)',
                        'rgba(76, 175, 80, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
@endsection
