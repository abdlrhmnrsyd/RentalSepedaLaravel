@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <!-- Info Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs">Total Users</p>
                    <h3 class="text-lg font-bold">{{ $totalUsers }}</h3>
                </div>
                <div class="bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-users text-blue-500 text-sm"></i>
                </div>
            </div>
        </div>

        <!-- Total Sepeda Card -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs">Total Sepeda</p>
                    <h3 class="text-lg font-bold">{{ $totalSepeda }}</h3>
                </div>
                <div class="bg-green-100 p-2 rounded-full">
                    <i class="fas fa-bicycle text-green-500 text-sm"></i>
                </div>
            </div>
        </div>

        <!-- Sepeda Dipinjam Card -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs">Sepeda Dipinjam</p>
                    <h3 class="text-lg font-bold">{{ $sepedaDipinjam }}</h3>
                </div>
                <div class="bg-yellow-100 p-2 rounded-full">
                    <i class="fas fa-handshake text-yellow-500 text-sm"></i>
                </div>
            </div>
        </div>

        <!-- Sepeda Tersedia Card -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs">Sepeda Tersedia</p>
                    <h3 class="text-lg font-bold">{{ $totalSepeda - $sepedaDipinjam }}</h3>
                </div>
                <div class="bg-red-100 p-2 rounded-full">
                    <i class="fas fa-bicycle text-red-500 text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <!-- Bar Chart -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold mb-2">Statistik Sepeda per Merk</h2>
            <div style="height: 200px;">
                <canvas id="sepedaChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold mb-2">Status Sepeda</h2>
            <div style="height: 200px;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-sm font-semibold mb-2">Transaksi Aktif</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Merk</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Peminjam</th>
                        <th class="px-4 py-2 text-left">Tanggal Pinjam</th>
                        <th class="px-4 py-2 text-left">Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeTransactions as $transaction)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $transaction->id }}</td>
                        <td class="px-4 py-2">{{ $transaction->sepeda->merk }}</td>
                        <td class="px-4 py-2">{{ $transaction->status }}</td>
                        <td class="px-4 py-2">{{ $transaction->peminjam->nama }}</td>
                        <td class="px-4 py-2">{{ $transaction->tgl_pinjam }}</td>
                        <td class="px-4 py-2">{{ $transaction->tgl_pulang }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const sepedaData = @json($sepedaStats);
const totalSepeda = {{ $totalSepeda }};
const sepedaDipinjam = {{ $sepedaDipinjam }};

// Bar Chart
new Chart(document.getElementById('sepedaChart'), {
    type: 'bar',
    data: {
        labels: sepedaData.map(item => item.merk),
        datasets: [
            {
                label: 'Total',
                data: sepedaData.map(item => item.total),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Dipinjam',
                data: sepedaData.map(item => item.dipinjam),
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            },
            {
                label: 'Tersedia',
                data: sepedaData.map(item => item.tersedia),
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    boxWidth: 12,
                    font: {
                        size: 11
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 10
                    }
                }
            },
            x: {
                ticks: {
                    font: {
                        size: 10
                    }
                }
            }
        }
    }
});

// Pie Chart
new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Dipinjam', 'Tersedia'],
        datasets: [{
            data: [sepedaDipinjam, totalSepeda - sepedaDipinjam],
            backgroundColor: [
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    boxWidth: 12,
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
});
</script>
@endsection
