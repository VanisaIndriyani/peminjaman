@extends('admin.layouts.app')

@section('content')
<div class="peminjaman-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Data Peminjaman</h1>
            <p class="page-subtitle">Kelola semua data peminjaman mobil</p>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <i class="fa fa-calendar-check"></i>
                <span>{{ $peminjamans->count() }} Total</span>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-user">Nama User</th>
                        <th class="col-mobil">Mobil</th>
                        <th class="col-dates">Tanggal Pinjam</th>
                        <th class="col-dates">Tanggal Kembali</th>
                        <th class="col-status">Status</th>
                        <th class="col-aksi">Aksi</th>
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
                        <td class="col-dates">
                            <div class="date-info">
                                <span class="date-value">{{ $peminjaman->tanggal_pinjam }}</span>
                            </div>
                        </td>
                        <td class="col-dates">
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
                                } elseif ($status === 'menunggu_pembayaran') {
                                    $statusClass = 'status-waiting';
                                    $icon = 'fa-clock';
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
                        <td class="col-aksi">
                            <div class="action-buttons">
                                <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="btn-view" title="Lihat Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if(strtolower($peminjaman->status) === 'disetujui')
                                <form method="POST" action="{{ route('peminjaman.selesaikan', $peminjaman->id) }}" class="action-form">
                                    @csrf
                                    <button type="submit" class="btn-complete" title="Selesaikan Peminjaman" onclick="return confirm('Yakin ingin menyelesaikan peminjaman ini?')">
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                                </form>
                                @endif
                                @if(strtolower($peminjaman->status) === 'disetujui')
                               
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.peminjaman-container {
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

.header-stats {
    display: flex;
    gap: 16px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.stat-item i {
    color: #1976d2;
    font-size: 1.2rem;
}

.stat-item span {
    font-weight: 600;
    color: #374151;
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

.col-dates {
    width: 130px;
    text-align: center;
}

.col-status {
    width: 180px;
    text-align: center;
}

.col-aksi {
    width: 140px;
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
    color: #1e40af;
}

.status-returned {
    background: #d1fae5;
    color: #065f46;
}

.status-approved {
    background: #fef3c7;
    color: #92400e;
}

.status-waiting {
    background: #e0e7ff;
    color: #3730a3;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.status-other {
    background: #f3f4f6;
    color: #374151;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    min-height: 32px;
}

.btn-view, .btn-complete, .btn-return {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    flex-shrink: 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.btn-view {
    background: #dbeafe;
    color: #1976d2;
}

.btn-view:hover {
    background: #1976d2;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(25, 118, 210, 0.2);
}

.btn-complete {
    background: #d1fae5;
    color: #059669;
}

.btn-complete:hover {
    background: #059669;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(5, 150, 105, 0.2);
}

.btn-return {
    background: #fef3c7;
    color: #d97706;
}

.btn-return:hover {
    background: #d97706;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(217, 119, 6, 0.2);
}

.action-form {
    display: inline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .header-stats {
        justify-content: flex-start;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .action-buttons {
        flex-direction: row;
        gap: 4px;
        justify-content: center;
    }
    
    .btn-view, .btn-complete, .btn-return {
        width: 28px;
        height: 28px;
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .page-title {
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
    
    .action-buttons {
        gap: 3px;
    }
    
    .btn-view, .btn-complete, .btn-return {
        width: 26px;
        height: 26px;
        font-size: 0.7rem;
    }
}
</style>
@endsection 