@extends('admin.layouts.app')

@section('content')
<div class="pengembalian-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Data Pengembalian</h1>
            <p class="page-subtitle">Kelola semua data pengembalian mobil</p>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <i class="fa fa-undo"></i>
                <span>{{ $pengembalians->count() }} Total</span>
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
                        <th class="col-date">Tanggal Pengembalian</th>
                        <th class="col-status">Status</th>
                        <th class="col-aksi">Aksi</th>
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
                        <td class="col-aksi">
                            <div class="action-buttons">
                                <a href="{{ route('pengembalian.show', $pengembalian->id) }}" class="btn-view" title="Lihat Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if(strtolower($pengembalian->status) !== 'selesai')
                                <form method="POST" action="{{ route('admin.pengembalian.selesaikan', $pengembalian->id) }}" class="action-form">
                        @csrf
                                    <button type="submit" class="btn-complete" title="Selesaikan Pengembalian" onclick="return confirm('Yakin ingin menyelesaikan pengembalian ini?')">
                                        <i class="fa fa-check-circle"></i>
                                    </button>
                    </form>
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
.pengembalian-container {
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

.col-date {
    width: 150px;
    text-align: center;
}

.col-status {
    width: 160px;
    text-align: center;
}

.col-aksi {
    width: 120px;
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

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-processing {
    background: #fef3c7;
    color: #92400e;
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

.btn-view, .btn-complete {
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
    
    .btn-view, .btn-complete {
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
    
    .btn-view, .btn-complete {
        width: 26px;
        height: 26px;
        font-size: 0.7rem;
    }
}
</style>
@endsection 