@extends('admin.layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1 class="welcome-title">Dashboard Admin</h1>
                <p class="welcome-subtitle">Selamat datang di panel admin! Pantau statistik dan aktivitas sistem rental mobil.</p>
            </div>
            <div class="welcome-time">
                <div class="time-display">
                    <i class="fa fa-clock"></i>
                    <span id="currentTime"></span>
                </div>
                <div class="date-display">
                    <i class="fa fa-calendar"></i>
                    <span id="currentDate"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-car"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $jumlahMobil ?? '0' }}</h3>
                <p class="stat-label">Total Mobil</p>
                <div class="stat-trend">
                    <i class="fa fa-arrow-up"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $jumlahPengguna ?? '0' }}</h3>
                <p class="stat-label">Total Pengguna</p>
                <div class="stat-trend">
                    <i class="fa fa-arrow-up"></i>
                    <span>+8% dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-calendar-check"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $jumlahPeminjaman ?? '0' }}</h3>
                <p class="stat-label">Total Peminjaman</p>
                <div class="stat-trend">
                    <i class="fa fa-arrow-up"></i>
                    <span>+15% dari bulan lalu</span>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $jumlahPesan ?? '0' }}</h3>
                <p class="stat-label">Pesan Masuk</p>
                <div class="stat-trend">
                    <i class="fa fa-arrow-down"></i>
                    <span>-5% dari bulan lalu</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="chart-container">
            <div class="chart-header">
                <h2 class="chart-title">Statistik Peminjaman Mobil</h2>
                <div class="chart-actions">
                    <button class="btn-chart active" data-period="month">Bulanan</button>
                    <button class="btn-chart" data-period="week">Mingguan</button>
                </div>
            </div>
            <div class="chart-wrapper">
                <canvas id="chartPeminjaman"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="activity-section">
        <div class="activity-header">
            <h2 class="activity-title">Aktivitas Terbaru</h2>
        
        </div>
        <div class="activity-grid">
            @foreach($recentPeminjaman as $peminjaman)
                <div class="activity-card">
                    <div class="activity-icon"><i class="fa fa-car"></i></div>
                    <div class="activity-content">
                        <h4>Peminjaman Baru</h4>
                        <p>Mobil {{ $peminjaman->mobil->nama ?? '-' }} dipinjam oleh {{ $peminjaman->user->name ?? '-' }}</p>
                        <span class="activity-time">{{ $peminjaman->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
            @foreach($recentPengembalian as $pengembalian)
                <div class="activity-card">
                    <div class="activity-icon"><i class="fa fa-undo"></i></div>
                    <div class="activity-content">
                        <h4>Pengembalian</h4>
                        <p>Mobil {{ $pengembalian->peminjaman->mobil->nama ?? '-' }} dikembalikan oleh {{ $pengembalian->peminjaman->user->name ?? '-' }}</p>
                        <span class="activity-time">{{ $pengembalian->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
            @foreach($recentPengguna as $user)
                <div class="activity-card">
                    <div class="activity-icon"><i class="fa fa-user-plus"></i></div>
                    <div class="activity-content">
                        <h4>Pengguna Baru</h4>
                        <p>{{ $user->name }} mendaftar sebagai pengguna baru</p>
                        <span class="activity-time">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
            @foreach($recentPesan as $pesan)
                <div class="activity-card">
                    <div class="activity-icon"><i class="fa fa-envelope"></i></div>
                    <div class="activity-content">
                        <h4>Pesan Baru</h4>
                        <p>Pesan dari {{ $pesan->nama }} tentang {{ $pesan->subjek }}</p>
                        <span class="activity-time">{{ $pesan->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="quick-actions-section">
        <h2 class="section-title">Aksi Cepat</h2>
        <div class="actions-grid">
            <a href="{{ route('mobil.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fa fa-car"></i>
                </div>
                <h3>Kelola Mobil</h3>
                <p>Tambah, edit, atau hapus data mobil</p>
            </a>
            <a href="{{ route('peminjaman.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fa fa-calendar-check"></i>
                </div>
                <h3>Peminjaman</h3>
                <p>Kelola data peminjaman mobil</p>
            </a>
            <a href="{{ route('pengembalian.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fa fa-undo"></i>
                </div>
                <h3>Pengembalian</h3>
                <p>Proses pengembalian mobil</p>
            </a>
            <a href="{{ route('pengguna.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fa fa-users"></i>
                </div>
                <h3>Pengguna</h3>
                <p>Kelola data pengguna</p>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Update time and date
function updateDateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit'
    });
    const dateString = now.toLocaleDateString('id-ID', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
    
    document.getElementById('currentTime').textContent = timeString;
    document.getElementById('currentDate').textContent = dateString;
}

// Update time every second
setInterval(updateDateTime, 1000);
updateDateTime();

// Chart configuration
const ctx = document.getElementById('chartPeminjaman').getContext('2d');

// Data from database
const monthlyData = @json($dataStatistik);
const weeklyData = @json($weeklyData);

let currentPeriod = 'month';
let chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: currentPeriod === 'month' ? 
            ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'] :
            ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5', 'Minggu 6', 'Minggu 7', 'Minggu 8', 'Minggu 9', 'Minggu 10', 'Minggu 11', 'Minggu 12'],
        datasets: [{
            label: 'Peminjaman',
            data: currentPeriod === 'month' ? monthlyData : weeklyData,
            borderColor: '#1976d2',
            backgroundColor: 'rgba(25, 118, 210, 0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 6,
            pointBackgroundColor: '#1976d2',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointHoverRadius: 8,
            pointHoverBackgroundColor: '#1976d2',
            pointHoverBorderColor: '#fff',
            pointHoverBorderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { 
                display: false 
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#1976d2',
                borderWidth: 1,
                cornerRadius: 8,
                displayColors: false,
                callbacks: {
                    title: function(context) {
                        return currentPeriod === 'month' ? 
                            'Bulan ' + context[0].label : 
                            context[0].label;
                    },
                    label: function(context) {
                        return 'Peminjaman: ' + context.parsed.y + ' unit';
                    }
                }
            }
        },
        scales: {
            y: { 
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)',
                    drawBorder: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 12
                    },
                    callback: function(value) {
                        return value + ' unit';
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280',
                    font: {
                        size: 12
                    }
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        animation: {
            duration: 750,
            easing: 'easeInOutQuart'
        }
    }
});

// Chart period buttons functionality
document.querySelectorAll('.btn-chart').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.btn-chart').forEach(b => b.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        
        const period = this.dataset.period;
        
        // Show loading state
        showChartLoading();
        
        // Fetch data from API
        fetch(`/admin/dashboard/statistics?period=${period}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateChartData(period, data.data, data.labels);
                    currentPeriod = period;
                } else {
                    console.error('Failed to fetch data');
                    hideChartLoading();
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                hideChartLoading();
            });
        
        // Add visual feedback
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
});

// Function to update chart data
function updateChartData(period, data, labels) {
    // Update chart data with animation
    chart.data.labels = labels;
    chart.data.datasets[0].data = data;
    
    // Update chart title based on period
    const chartTitle = document.querySelector('.chart-title');
    if (chartTitle) {
        chartTitle.textContent = period === 'month' ? 
            'Statistik Peminjaman Mobil (Bulanan)' : 
            'Statistik Peminjaman Mobil (Mingguan)';
    }
    
    // Update with smooth animation
    chart.update('active');
    
    // Hide loading and show chart
    hideChartLoading();
    
    // Show success indicator briefly
    const chartWrapper = document.querySelector('.chart-wrapper');
    chartWrapper.style.opacity = '0.7';
    setTimeout(() => {
        chartWrapper.style.opacity = '1';
    }, 300);
}

// Function to refresh dashboard stats
function refreshDashboardStats() {
    fetch('/admin/dashboard/stats')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update statistics cards
                updateStatCards(data.stats);
                // Update recent activities
                updateRecentActivities(data.recentPeminjaman, data.recentPengguna);
            }
        })
        .catch(error => {
            console.error('Error refreshing stats:', error);
        });
}

// Function to update statistics cards
function updateStatCards(stats) {
    // Update total numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    if (statNumbers.length >= 4) {
        statNumbers[0].textContent = stats.totalMobil;
        statNumbers[1].textContent = stats.totalPengguna;
        statNumbers[2].textContent = stats.totalPeminjaman;
        statNumbers[3].textContent = stats.totalPesan;
    }
    
    // Update growth indicators
    const trendElements = document.querySelectorAll('.stat-trend span');
    if (trendElements.length >= 4) {
        // You can update these with real growth data from stats.peminjamanGrowth
        trendElements[0].textContent = '+12% dari bulan lalu';
        trendElements[1].textContent = '+8% dari bulan lalu';
        trendElements[2].textContent = stats.peminjamanGrowth > 0 ? 
            `+${stats.peminjamanGrowth}% dari bulan lalu` : 
            `${stats.peminjamanGrowth}% dari bulan lalu`;
        trendElements[3].textContent = '-5% dari bulan lalu';
    }
}

// Function to update recent activities
function updateRecentActivities(peminjaman, pengguna) {
    // This function can be used to update the activity feed with real data
    // For now, we'll keep the static data but you can implement dynamic updates here
    console.log('Recent peminjaman:', peminjaman);
    console.log('Recent pengguna:', pengguna);
}

// Add hover effects to action cards
document.querySelectorAll('.action-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-4px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// Add click effects to stat cards
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('click', function() {
        // Add pulse effect
        this.style.transform = 'scale(1.02)';
        setTimeout(() => {
            this.style.transform = '';
        }, 200);
    });
});

// Add loading animation for chart
function showChartLoading() {
    const chartWrapper = document.querySelector('.chart-wrapper');
    chartWrapper.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #6b7280;"><i class="fa fa-spinner fa-spin" style="font-size: 2rem; margin-right: 12px;"></i>Memuat data...</div>';
}

function hideChartLoading() {
    const chartWrapper = document.querySelector('.chart-wrapper');
    chartWrapper.innerHTML = '<canvas id="chartPeminjaman"></canvas>';
    // Reinitialize chart
    const ctx = document.getElementById('chartPeminjaman').getContext('2d');
    chart = new Chart(ctx, chart.config);
}

// Add smooth transitions for all interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Add transition styles
    const style = document.createElement('style');
    style.textContent = `
        .btn-chart, .stat-card, .action-card, .activity-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .chart-wrapper {
            transition: opacity 0.3s ease;
        }
        
        .btn-chart:active {
            transform: scale(0.95);
        }
    `;
    document.head.appendChild(style);
    
    // Initialize with monthly data as default
    const monthlyBtn = document.querySelector('[data-period="month"]');
    if (monthlyBtn) {
        monthlyBtn.classList.add('active');
    }
    
    // Refresh stats every 30 seconds
    setInterval(refreshDashboardStats, 30000);
    
    // Initial refresh
    refreshDashboardStats();
});
</script>

<style>
.dashboard-container {
    max-width: 100%;
}

/* Welcome Section */
.welcome-section {
    background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    color: #fff;
    box-shadow: 0 4px 20px rgba(26, 35, 126, 0.15);
}

.welcome-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.welcome-text {
    flex: 1;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 8px 0;
    color: #fff;
}

.welcome-subtitle {
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.9;
    line-height: 1.6;
}

.welcome-time {
    display: flex;
    flex-direction: column;
    gap: 8px;
    text-align: right;
}

.time-display, .date-display {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    opacity: 0.9;
}

.time-display i, .date-display i {
    font-size: 1rem;
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #fff;
}

.stat-card:nth-child(1) .stat-icon {
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
}

.stat-card:nth-child(2) .stat-icon {
    background: linear-gradient(135deg, #2e7d32 0%, #66bb6a 100%);
}

.stat-card:nth-child(3) .stat-icon {
    background: linear-gradient(135deg, #f57c00 0%, #ff9800 100%);
}

.stat-card:nth-child(4) .stat-icon {
    background: linear-gradient(135deg, #7b1fa2 0%, #ab47bc 100%);
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 4px 0;
}

.stat-label {
    color: #6b7280;
    font-size: 1rem;
    margin: 0 0 8px 0;
    font-weight: 500;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.875rem;
    font-weight: 500;
}

.stat-trend i {
    font-size: 0.75rem;
}

.stat-card:nth-child(1) .stat-trend,
.stat-card:nth-child(2) .stat-trend,
.stat-card:nth-child(3) .stat-trend {
    color: #059669;
}

.stat-card:nth-child(4) .stat-trend {
    color: #dc2626;
}

/* Charts Section */
.charts-section {
    margin-bottom: 32px;
}

.chart-container {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.chart-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0;
}

.chart-actions {
    display: flex;
    gap: 8px;
}

.btn-chart {
    padding: 8px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    background: #fff;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-chart:hover, .btn-chart.active {
    background: #1976d2;
    color: #fff;
    border-color: #1976d2;
}

.chart-wrapper {
    height: 400px;
    position: relative;
}

/* Activity Section */
.activity-section {
    margin-bottom: 32px;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.activity-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0;
}

.btn-view-all {
    color: #1976d2;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    transition: color 0.2s ease;
}

.btn-view-all:hover {
    color: #1565c0;
}

.activity-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.activity-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: all 0.2s ease;
}

.activity-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.activity-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #fff;
    flex-shrink: 0;
}

.activity-card:nth-child(1) .activity-icon {
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
}

.activity-card:nth-child(2) .activity-icon {
    background: linear-gradient(135deg, #2e7d32 0%, #66bb6a 100%);
}

.activity-card:nth-child(3) .activity-icon {
    background: linear-gradient(135deg, #f57c00 0%, #ff9800 100%);
}

.activity-card:nth-child(4) .activity-icon {
    background: linear-gradient(135deg, #7b1fa2 0%, #ab47bc 100%);
}

.activity-content {
    flex: 1;
}

.activity-content h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a237e;
    margin: 0 0 4px 0;
}

.activity-content p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0 0 8px 0;
    line-height: 1.5;
}

.activity-time {
    color: #9ca3af;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Quick Actions Section */
.quick-actions-section {
    margin-bottom: 32px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 24px 0;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.action-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px 24px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    text-decoration: none;
    color: inherit;
    text-align: center;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

.action-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    color: inherit;
}

.action-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #fff;
}

.action-card:nth-child(1) .action-icon {
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
}

.action-card:nth-child(2) .action-icon {
    background: linear-gradient(135deg, #2e7d32 0%, #66bb6a 100%);
}

.action-card:nth-child(3) .action-icon {
    background: linear-gradient(135deg, #f57c00 0%, #ff9800 100%);
}

.action-card:nth-child(4) .action-icon {
    background: linear-gradient(135deg, #7b1fa2 0%, #ab47bc 100%);
}

.action-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a237e;
    margin: 0;
}

.action-card p {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-content {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-time {
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .stat-card {
        padding: 24px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .chart-header {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
    
    .activity-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
}

@media (max-width: 480px) {
    .welcome-section {
        padding: 24px;
    }
    
    .welcome-title {
        font-size: 1.75rem;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .chart-container {
        padding: 20px;
    }
    
    .chart-wrapper {
        height: 300px;
    }
    
    .activity-card {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .action-card {
        padding: 24px 16px;
    }
}
</style>
@endsection 