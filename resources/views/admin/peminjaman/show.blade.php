@extends('admin.layouts.app')

@section('content')
<div class="detail-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Detail Peminjaman</h1>
            <p class="page-subtitle">Informasi lengkap peminjaman mobil</p>
        </div>
      
    </div>

    <!-- Main Content -->
    <div class="detail-content">
        <!-- Left Column: User & Mobil Info -->
        <div class="left-column">
            <!-- User Info Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fa fa-user"></i>
                    <span>Informasi User</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">
                        @if($peminjaman->user && $peminjaman->user->foto)
                            <img src="{{ asset('storage/profile/'.$peminjaman->user->foto) }}" alt="Foto {{ $peminjaman->user->name }}">
                        @else
                            <i class="fa fa-user-circle"></i>
                        @endif
                    </div>
                    <div class="user-details">
                        <h3 class="user-name">{{ $peminjaman->user->name ?? '-' }}</h3>
                        <p class="user-email">{{ $peminjaman->user->email ?? '-' }}</p>
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
                        <span class="value">{{ $peminjaman->mobil->nama ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Merk:</span>
                        <span class="value">{{ $peminjaman->mobil->merk ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Plat Nomor:</span>
                        <span class="value plat-number">{{ $peminjaman->mobil->plat_nomor ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Tahun:</span>
                        <span class="value">{{ $peminjaman->mobil->tahun ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Rental Info Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fa fa-calendar-alt"></i>
                    <span>Informasi Sewa</span>
                </div>
                <div class="rental-details">
                    <div class="detail-item">
                        <span class="label">Tanggal Pinjam:</span>
                        <span class="value">{{ $peminjaman->tanggal_pinjam }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Tanggal Kembali:</span>
                        <span class="value">{{ $peminjaman->tanggal_kembali }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Status:</span>
                        @php
                            $status = strtolower($peminjaman->status);
                            if ($status === 'menunggu_pembayaran') {
                                $statusClass = 'status-waiting';
                                $icon = 'fa-clock';
                            } elseif ($status === 'disetujui') {
                                $statusClass = 'status-approved';
                                $icon = 'fa-thumbs-up';
                            } elseif ($status === 'ditolak') {
                                $statusClass = 'status-rejected';
                                $icon = 'fa-times-circle';
                            } elseif ($status === 'dipinjam') {
                                $statusClass = 'status-rented';
                                $icon = 'fa-car-side';
                            } elseif ($status === 'kembali') {
                                $statusClass = 'status-returned';
                                $icon = 'fa-check-circle';
                            } else {
                                $statusClass = 'status-other';
                                $icon = 'fa-info-circle';
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            <i class="fa {{ $icon }}"></i>
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Documents & Actions -->
        <div class="right-column">
            <!-- Documents Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fa fa-file-alt"></i>
                    <span>Dokumen Pengajuan</span>
                </div>
                <div class="documents-grid">
                    <div class="document-item">
                        <div class="document-label">Foto Diri</div>
                        @if($peminjaman->foto_diri)
                            <div class="document-preview">
                                <img src="{{ asset('storage/'.$peminjaman->foto_diri) }}" alt="Foto Diri">
                                <a href="{{ asset('storage/'.$peminjaman->foto_diri) }}" target="_blank" class="btn-view-doc">
                                    <i class="fa fa-external-link-alt"></i>
                                    Lihat
                                </a>
                            </div>
                        @else
                            <div class="no-document">
                                <i class="fa fa-image"></i>
                                <span>Tidak ada dokumen</span>
                            </div>
                        @endif
                    </div>

                    <div class="document-item">
                        <div class="document-label">KTP</div>
                        @if($peminjaman->ktp)
                            <div class="document-preview">
                                <img src="{{ asset('storage/'.$peminjaman->ktp) }}" alt="KTP">
                                <a href="{{ asset('storage/'.$peminjaman->ktp) }}" target="_blank" class="btn-view-doc">
                                    <i class="fa fa-external-link-alt"></i>
                                    Lihat
                                </a>
                            </div>
                        @else
                            <div class="no-document">
                                <i class="fa fa-image"></i>
                                <span>Tidak ada dokumen</span>
                            </div>
                        @endif
                    </div>

                    <div class="document-item">
                        <div class="document-label">Kartu Keluarga</div>
                        @if($peminjaman->kk)
                            <div class="document-preview">
                                <img src="{{ asset('storage/'.$peminjaman->kk) }}" alt="KK">
                                <a href="{{ asset('storage/'.$peminjaman->kk) }}" target="_blank" class="btn-view-doc">
                                    <i class="fa fa-external-link-alt"></i>
                                    Lihat
                                </a>
                            </div>
                        @else
                            <div class="no-document">
                                <i class="fa fa-image"></i>
                                <span>Tidak ada dokumen</span>
                            </div>
                        @endif
                    </div>

                    <div class="document-item">
                        <div class="document-label">SIM A</div>
                        @if($peminjaman->sim_a)
                            <div class="document-preview">
                                <img src="{{ asset('storage/'.$peminjaman->sim_a) }}" alt="SIM A">
                                <a href="{{ asset('storage/'.$peminjaman->sim_a) }}" target="_blank" class="btn-view-doc">
                                    <i class="fa fa-external-link-alt"></i>
                                    Lihat
                                </a>
                            </div>
                        @else
                            <div class="no-document">
                                <i class="fa fa-image"></i>
                                <span>Tidak ada dokumen</span>
                            </div>
                        @endif
                    </div>

                    <div class="document-item">
                        <div class="document-label">KTP Penjamin</div>
                        @if($peminjaman->ktp_penjamin)
                            <div class="document-preview">
                                <img src="{{ asset('storage/'.$peminjaman->ktp_penjamin) }}" alt="KTP Penjamin">
                                <a href="{{ asset('storage/'.$peminjaman->ktp_penjamin) }}" target="_blank" class="btn-view-doc">
                                    <i class="fa fa-external-link-alt"></i>
                                    Lihat
                                </a>
                            </div>
                        @else
                            <div class="no-document">
                                <i class="fa fa-image"></i>
                                <span>Tidak ada dokumen</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="info-card">
                <div class="card-header">
                    <i class="fa fa-cogs"></i>
                    <span>Aksi</span>
                </div>
                <div class="actions-content">
                    @if(in_array(strtolower($peminjaman->status), ['menunggu_pembayaran','menunggu']))
                        <form method="POST" action="{{ route('admin.peminjaman.aksi', $peminjaman->id) }}" class="action-form">
                            @csrf
                            <div class="action-buttons">
                                <button name="aksi" value="disetujui" type="submit" class="btn-approve">
                                    <i class="fa fa-check-circle"></i>
                                    Setujui
                                </button>
                                <button name="aksi" value="ditolak" type="submit" class="btn-reject">
                                    <i class="fa fa-times-circle"></i>
                                    Tolak
                                </button>
                            </div>
                        </form>
                    @endif

                    @if(strtolower($peminjaman->status) === 'dipinjam')
                        <form method="POST" action="{{ route('admin.peminjaman.pengembalianManual', $peminjaman->id) }}" class="action-form">
                            @csrf
                            <button type="submit" class="btn-return">
                                <i class="fa fa-box-open"></i>
                                Pengembalian Manual
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail-container {
    max-width: 1200px;
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
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 32px;
}

/* Info Card Styles */
.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 24px;
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

.status-waiting {
    background: #e0e7ff;
    color: #3730a3;
}

.status-approved {
    background: #fef3c7;
    color: #92400e;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.status-rented {
    background: #dbeafe;
    color: #1e40af;
}

.status-returned {
    background: #d1fae5;
    color: #065f46;
}

.status-other {
    background: #f3f4f6;
    color: #374151;
}

/* Documents Grid */
.documents-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 24px;
}

.document-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.document-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

.document-preview {
    position: relative;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

.document-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.btn-view-doc {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 12px;
    background: #1976d2;
    color: #fff;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: background 0.2s ease;
}

.btn-view-doc:hover {
    background: #1565c0;
}

.no-document {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: 20px;
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    color: #6b7280;
}

.no-document i {
    font-size: 1.5rem;
}

.no-document span {
    font-size: 0.8rem;
}

/* Actions */
.actions-content {
    padding: 24px;
}

.action-form {
    margin-bottom: 16px;
}

.action-buttons {
    display: flex;
    gap: 12px;
}

.btn-approve, .btn-reject, .btn-return {
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

.btn-approve {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: #fff;
}

.btn-approve:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
}

.btn-reject {
    background: #fff;
    color: #dc2626;
    border: 2px solid #dc2626;
}

.btn-reject:hover {
    background: #dc2626;
    color: #fff;
}

.btn-return {
    background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
    color: #fff;
    width: 100%;
    justify-content: center;
}

.btn-return:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .detail-content {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}

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
    
    .documents-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        padding: 20px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-approve, .btn-reject {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .documents-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
}
</style>
@endsection 