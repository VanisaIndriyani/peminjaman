@extends('admin.layouts.app')

@section('content')
<div class="detail-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Detail Pengembalian</h1>
            <p class="page-subtitle">Informasi lengkap pengembalian mobil</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn-secondary">
            <i class="fa fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Main Content -->
    <div class="detail-content">
        <!-- User Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-user"></i>
                <span>Informasi User</span>
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    @if($pengembalian->peminjaman->user && $pengembalian->peminjaman->user->foto)
                        <img src="{{ asset('storage/profile/'.$pengembalian->peminjaman->user->foto) }}" alt="Foto {{ $pengembalian->peminjaman->user->name }}">
                    @else
                        <i class="fa fa-user-circle"></i>
                    @endif
                </div>
                <div class="user-details">
                    <h3 class="user-name">{{ $pengembalian->peminjaman->user->name ?? '-' }}</h3>
                    <p class="user-email">{{ $pengembalian->peminjaman->user->email ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Mobil Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-car"></i>
                <span>Informasi Mobil</span>
            </div>
            <div class="mobil-details">
                <div class="detail-item">
                    <span class="label">Nama Mobil:</span>
                    <span class="value">{{ $pengembalian->peminjaman->mobil->nama ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Merk:</span>
                    <span class="value">{{ $pengembalian->peminjaman->mobil->merk ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Plat Nomor:</span>
                    <span class="value plat-number">{{ $pengembalian->peminjaman->mobil->plat_nomor ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Tahun:</span>
                    <span class="value">{{ $pengembalian->peminjaman->mobil->tahun ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Return Info Card -->
        <div class="info-card">
            <div class="card-header">
                <i class="fa fa-calendar-alt"></i>
                <span>Informasi Pengembalian</span>
            </div>
            <div class="return-details">
                <div class="detail-item">
                    <span class="label">Tanggal Pengembalian:</span>
                    <span class="value">{{ $pengembalian->tanggal_pengembalian }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Status:</span>
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail-container {
    max-width: 800px;
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

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f3f4f6;
    color: #374151;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid #d1d5db;
    transition: all 0.2s ease;
}

.btn-secondary:hover {
    background: #e5e7eb;
    color: #1f2937;
}

/* Main Content */
.detail-content {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Info Card Styles */
.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 600;
    color: #1a237e;
    font-size: 1.1rem;
}

.card-header i {
    color: #1976d2;
    font-size: 1.2rem;
}

/* User Profile */
.user-profile {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 24px;
}

.user-avatar {
    width: 80px;
    height: 80px;
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
    font-size: 2.5rem;
}

.user-details {
    flex: 1;
}

.user-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 4px 0;
}

.user-email {
    color: #6b7280;
    font-size: 1rem;
    margin: 0;
}

/* Detail Items */
.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.detail-item:last-child {
    border-bottom: none;
}

.label {
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

.value {
    color: #1a237e;
    font-weight: 500;
    font-size: 0.9rem;
}

.plat-number {
    font-family: 'Courier New', monospace;
    background: #f3f4f6;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
}

/* Status Badge */
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
}

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-processing {
    background: #fef3c7;
    color: #92400e;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .btn-secondary {
        align-self: flex-start;
    }
    
    .user-profile {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
    }
    
    .user-avatar i {
        font-size: 2rem;
    }
}
</style>
@endsection 