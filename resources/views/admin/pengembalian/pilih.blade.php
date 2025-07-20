@extends('admin.layouts.app')

@section('content')
<div class="select-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Pilih Peminjaman untuk Pengembalian</h1>
            <p class="page-subtitle">Pilih peminjaman yang masih aktif untuk diproses pengembaliannya</p>
        </div>
        <a href="{{ route('admin.pengembalian.index') }}" class="btn-secondary">
            <i class="fa fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Form Section -->
    <div class="form-wrapper">
        <form method="GET" action="{{ route('admin.pengembalian.create') }}" class="select-form">
            <div class="form-section">
                <div class="section-header">
                    <i class="fa fa-list"></i>
                    <span>Daftar Peminjaman Aktif</span>
                </div>
                
                <div class="form-group">
                    <label for="peminjaman_id" class="form-label">
                        <i class="fa fa-car"></i>
                        Pilih Peminjaman (yang masih dipinjam)
                    </label>
                    <select name="peminjaman_id" id="peminjaman_id" required class="form-select">
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($peminjamans as $peminjaman)
                            <option value="{{ $peminjaman->id }}" class="option-item">
                                <div class="option-content">
                                    <span class="user-name">{{ $peminjaman->user->name ?? '-' }}</span>
                                    <span class="separator">-</span>
                                    <span class="mobil-name">{{ $peminjaman->mobil->nama ?? '-' }}</span>
                                    <span class="date-range">({{ $peminjaman->tanggal_pinjam }} s/d {{ $peminjaman->tanggal_kembali }})</span>
                                </div>
                            </option>
                        @endforeach
                    </select>
                    <small class="form-help">Pilih peminjaman yang ingin diproses pengembaliannya</small>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-arrow-right"></i>
                    Lanjutkan
                </button>
                <a href="{{ route('admin.pengembalian.index') }}" class="btn-cancel">
                    <i class="fa fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Info Section -->
    <div class="info-wrapper">
        <div class="info-card">
            <div class="info-header">
                <i class="fa fa-info-circle"></i>
                <span>Informasi</span>
            </div>
            <div class="info-content">
                <p>Halaman ini menampilkan daftar peminjaman yang masih aktif dan dapat diproses untuk pengembalian.</p>
                <ul class="info-list">
                    <li>Pilih peminjaman yang ingin diproses pengembaliannya</li>
                    <li>Pastikan mobil sudah dikembalikan oleh penyewa</li>
                    <li>Proses pengembalian akan mengubah status peminjaman</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.select-container {
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

/* Form Styles */
.form-wrapper {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
    margin-bottom: 24px;
}

.select-form {
    padding: 32px;
}

/* Section Styles */
.form-section {
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    background: #f8fafc;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #1a237e;
    font-size: 1.1rem;
    border: 1px solid #e5e7eb;
}

.section-header i {
    color: #1976d2;
    font-size: 1.2rem;
}

/* Form Group */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.form-label i {
    color: #1976d2;
}

.form-select {
    padding: 14px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease;
    background: #fff;
    cursor: pointer;
}

.form-select:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.form-select option {
    padding: 8px;
    font-size: 0.9rem;
}

.form-help {
    color: #6b7280;
    font-size: 0.75rem;
    margin-top: 4px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn-submit, .btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 24px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-submit {
    background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
    color: #fff;
}

.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
}

.btn-cancel {
    background: #fff;
    color: #374151;
    border: 2px solid #d1d5db;
}

.btn-cancel:hover {
    background: #f3f4f6;
    color: #1f2937;
    border-color: #9ca3af;
}

/* Info Section */
.info-wrapper {
    margin-top: 24px;
}

.info-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.info-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    background: #f0f9ff;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 600;
    color: #0369a1;
    font-size: 1rem;
}

.info-header i {
    color: #0ea5e9;
    font-size: 1.1rem;
}

.info-content {
    padding: 20px;
}

.info-content p {
    color: #374151;
    margin: 0 0 16px 0;
    line-height: 1.6;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 8px;
    color: #6b7280;
    font-size: 0.9rem;
}

.info-list li:before {
    content: "•";
    position: absolute;
    left: 0;
    color: #0ea5e9;
    font-weight: bold;
}

.info-list li:last-child {
    margin-bottom: 0;
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
    
    .select-form {
        padding: 24px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-submit, .btn-cancel {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .select-form {
        padding: 20px;
    }
    
    .section-header, .info-header {
        padding: 12px 16px;
        font-size: 1rem;
    }
    
    .info-content {
        padding: 16px;
    }
}
</style>
@endsection 