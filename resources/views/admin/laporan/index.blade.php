@extends('admin.layouts.app')

@section('content')
<div class="laporan-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Laporan Peminjaman & Pengembalian</h1>
            <p class="page-subtitle">Analisis dan laporan lengkap aktivitas rental mobil</p>
        </div>
       
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-car"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $peminjamans->count() }}</h3>
                <p class="stat-label">Total Peminjaman</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-undo"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $pengembalians->count() }}</h3>
                <p class="stat-label">Total Pengembalian</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">Rp {{ number_format($pengembalians->sum('denda'), 0, ',', '.') }}</h3>
                <p class="stat-label">Total Denda</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $peminjamans->unique('user_id')->count() }}</h3>
                <p class="stat-label">Pengguna Aktif</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="" class="filter-form">
            <div class="filter-group">
                <label for="filter" class="filter-label">Periode</label>
                <select name="filter" id="filter" onchange="this.form.submit()" class="filter-select">
        <option value="hari" {{ request('filter','hari')=='hari'?'selected':'' }}>Hari Ini</option>
        <option value="minggu" {{ request('filter')=='minggu'?'selected':'' }}>Minggu Ini</option>
        <option value="bulan" {{ request('filter')=='bulan'?'selected':'' }}>Bulan Ini</option>
    </select>
            </div>
            <div class="filter-group">
                <label for="keyword" class="filter-label">Pencarian</label>
                <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" placeholder="Cari nama user atau mobil..." class="filter-input">
            </div>
            <div class="filter-group">
                <label for="status" class="filter-label">Status</label>
                <select name="status" id="status" class="filter-select">
        <option value="">-- Semua Status --</option>
        <option value="dipinjam" @if(request('status')=='dipinjam') selected @endif>Dipinjam</option>
        <option value="disetujui" @if(request('status')=='disetujui') selected @endif>Disetujui</option>
        <option value="kembali" @if(request('status')=='kembali') selected @endif>Kembali</option>
        <option value="ditolak" @if(request('status')=='ditolak') selected @endif>Ditolak</option>
    </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn-filter">
                    <i class="fa fa-search"></i>
                    Cari / Filter
                </button>
    @if(request('keyword') || request('status'))
                <a href="{{ route('laporan.index') }}" class="btn-reset">
                    <i class="fa fa-refresh"></i>
                    Reset
                </a>
    @endif
            </div>
</form>
    </div>

    <!-- Peminjaman Report Section -->
    <div class="report-section">
        <div class="section-header">
            <div class="section-title">
                <i class="fa fa-car"></i>
                <h2>Laporan Peminjaman</h2>
                <span class="report-count">{{ $peminjamans->count() }} data</span>
            </div>
        </div>
        <div class="table-container">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-user">Nama User</th>
                            <th class="col-mobil">Mobil</th>
                            <th class="col-date">Tanggal Pinjam</th>
                            <th class="col-date">Tanggal Kembali</th>
                            <th class="col-status">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamans as $peminjaman)
                        <tr class="table-row">
                            <td class="col-no">{{ $loop->iteration }}</td>
                            <td class="col-user">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        @if($peminjaman->user && $peminjaman->user->foto)
                                            <img src="{{ asset('storage/profile/'.$peminjaman->user->foto) }}" alt="Foto {{ $peminjaman->user->name }}">
                                        @else
                                            <i class="fa fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="user-details">
                                        <span class="user-name">{{ $peminjaman->user->name ?? '-' }}</span>
                                        <small class="user-email">{{ $peminjaman->user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="col-mobil">
                                <div class="mobil-info">
                                    <span class="mobil-name">{{ $peminjaman->mobil->nama ?? '-' }}</span>
                                    <small class="mobil-plat">{{ $peminjaman->mobil->plat_nomor ?? '-' }}</small>
                                </div>
                            </td>
                            <td class="col-date">
                                <div class="date-info">
                                    <span class="date-value">{{ $peminjaman->tanggal_pinjam }}</span>
                                </div>
                            </td>
                            <td class="col-date">
                                <div class="date-info">
                                    <span class="date-value">{{ $peminjaman->tanggal_kembali }}</span>
                                </div>
                            </td>
                            <td class="col-status">
                                @php
                                    $status = strtolower($peminjaman->status);
                                    if ($status === 'dipinjam') {
                                        $statusClass = 'status-rented';
                                        $icon = 'fa-car-side';
                                    } elseif ($status === 'kembali') {
                                        $statusClass = 'status-returned';
                                        $icon = 'fa-check-circle';
                                    } elseif ($status === 'disetujui') {
                                        $statusClass = 'status-approved';
                                        $icon = 'fa-thumbs-up';
                                    } elseif ($status === 'ditolak') {
                                        $statusClass = 'status-rejected';
                                        $icon = 'fa-times-circle';
                                    } else {
                                        $statusClass = 'status-other';
                                        $icon = 'fa-info-circle';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    <i class="fa {{ $icon }}"></i>
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>

    <!-- Pengembalian Report Section -->
    <div class="report-section">
        <div class="section-header">
            <div class="section-title">
                <i class="fa fa-undo"></i>
                <h2>Laporan Pengembalian</h2>
                <span class="report-count">{{ $pengembalians->count() }} data</span>
            </div>
        </div>
        <div class="table-container">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-user">Nama User</th>
                            <th class="col-mobil">Mobil</th>
                            <th class="col-date">Tanggal Pengembalian</th>
                            <th class="col-denda">Denda</th>
                            <th class="col-status">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengembalians as $pengembalian)
                        <tr class="table-row">
                            <td class="col-no">{{ $loop->iteration }}</td>
                            <td class="col-user">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        @if($pengembalian->peminjaman->user && $pengembalian->peminjaman->user->foto)
                                            <img src="{{ asset('storage/profile/'.$pengembalian->peminjaman->user->foto) }}" alt="Foto {{ $pengembalian->peminjaman->user->name }}">
                                        @else
                                            <i class="fa fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="user-details">
                                        <span class="user-name">{{ $pengembalian->peminjaman->user->name ?? '-' }}</span>
                                        <small class="user-email">{{ $pengembalian->peminjaman->user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="col-mobil">
                                <div class="mobil-info">
                                    <span class="mobil-name">{{ $pengembalian->peminjaman->mobil->nama ?? '-' }}</span>
                                    <small class="mobil-plat">{{ $pengembalian->peminjaman->mobil->plat_nomor ?? '-' }}</small>
                                </div>
                            </td>
                            <td class="col-date">
                                <div class="date-info">
                                    <span class="date-value">{{ $pengembalian->tanggal_pengembalian }}</span>
                                </div>
                            </td>
                            <td class="col-denda">
                                <div class="denda-info">
                                    <span class="denda-value {{ $pengembalian->denda > 0 ? 'has-denda' : 'no-denda' }}">
                                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                </div>
                            </td>
                            <td class="col-status">
                                @php
                                    $status = strtolower($pengembalian->status);
                                    if ($status === 'selesai') {
                                        $statusClass = 'status-completed';
                                        $icon = 'fa-check-circle';
                                    } else {
                                        $statusClass = 'status-processing';
                                        $icon = 'fa-hourglass-half';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    <i class="fa {{ $icon }}"></i>
                                    {{ ucfirst($pengembalian->status) }}
                                </span>
                            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>
</div>

<style>
.laporan-container {
    max-width: 100%;
}

/* Header Styles */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    padding: 24px 0;
    border-bottom: 1px solid #e5e7eb;
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 8px 0;
}

.page-subtitle {
    font-size: 1rem;
    color: #6b7280;
    margin: 0;
}

.header-actions {
    display: flex;
    gap: 12px;
}

.btn-export {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-export:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
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
    font-size: 2rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 4px 0;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.filter-input, .filter-select {
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease;
    background: #fff;
}

.filter-input:focus, .filter-select:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.filter-actions {
    display: flex;
    gap: 12px;
    align-items: end;
}

.btn-filter, .btn-reset {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-filter {
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
    color: #fff;
}

.btn-filter:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(25, 118, 210, 0.2);
}

.btn-reset {
    background: #fff;
    color: #dc2626;
    border: 2px solid #dc2626;
}

.btn-reset:hover {
    background: #dc2626;
    color: #fff;
}

/* Report Section */
.report-section {
    margin-bottom: 32px;
}

.section-header {
    margin-bottom: 20px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-title i {
    color: #1976d2;
    font-size: 1.5rem;
}

.section-title h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0;
}

.report-count {
    background: #e3f2fd;
    color: #1976d2;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: auto;
}

/* Table Styles */
.table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
    table-layout: fixed;
}

.data-table thead {
    background: #f8fafc;
    border-bottom: 2px solid #e5e7eb;
}

.data-table th {
    padding: 16px 12px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    vertical-align: middle;
    border-right: 1px solid #e5e7eb;
}

.data-table th:last-child {
    border-right: none;
}

.data-table tbody tr {
    border-bottom: 1px solid #f3f4f6;
    transition: background-color 0.2s ease;
}

.data-table tbody tr:hover {
    background-color: #f9fafb;
}

.data-table td {
    padding: 16px 12px;
    vertical-align: middle;
    word-wrap: break-word;
    border-right: 1px solid #f3f4f6;
}

.data-table td:last-child {
    border-right: none;
}

/* Column Styles */
.col-no {
    width: 60px;
    text-align: center;
    font-weight: 600;
    color: #1976d2;
}

.col-user {
    width: 220px;
}

.col-mobil {
    width: 200px;
}

.col-date {
    width: 140px;
    text-align: center;
}

.col-denda {
    width: 140px;
    text-align: center;
}

.col-status {
    width: 160px;
    text-align: center;
}

/* User Info Styles */
.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-avatar i {
    color: #9ca3af;
    font-size: 1.2rem;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #1a237e;
    font-size: 0.875rem;
}

.user-email {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Mobil Info Styles */
.mobil-info {
    display: flex;
    flex-direction: column;
}

.mobil-name {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.mobil-plat {
    color: #6b7280;
    font-size: 0.75rem;
    font-family: 'Courier New', monospace;
}

/* Date Info Styles */
.date-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.date-value {
    font-weight: 500;
    color: #374151;
    font-size: 0.875rem;
}

/* Denda Info Styles */
.denda-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.denda-value {
    font-weight: 600;
    font-size: 0.875rem;
}

.denda-value.has-denda {
    color: #dc2626;
}

.denda-value.no-denda {
    color: #059669;
}

/* Status Badge Styles */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.status-rented {
    background: #dbeafe;
    color: #1976d2;
}

.status-returned {
    background: #d1fae5;
    color: #065f46;
}

.status-approved {
    background: #fef3c7;
    color: #92400e;
}

.status-rejected {
    background: #fee2e2;
    color: #dc2626;
}

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-processing {
    background: #fef3c7;
    color: #92400e;
}

.status-other {
    background: #f3f4f6;
    color: #6b7280;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .header-actions {
        justify-content: flex-start;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }
    
    .filter-form {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .filter-actions {
        flex-direction: column;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .section-title {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .report-count {
        margin-left: 0;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .data-table {
        min-width: 700px;
    }
    
    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
    }
}
</style>

<script>
function exportToPDF() {
    // Implementasi export ke PDF
    alert('Fitur export PDF akan diimplementasikan');
}
</script>
@endsection 