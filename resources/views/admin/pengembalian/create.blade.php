@extends('admin.layouts.app')

@section('content')
<div class="form-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Proses Pengembalian</h1>
            <p class="page-subtitle">Proses pengembalian mobil yang telah disewa</p>
        </div>
        <a href="{{ route('peminjaman.index') }}" class="btn-secondary">
            <i class="fa fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Form Section -->
    <div class="form-wrapper">
        <form method="POST" action="{{ route('pengembalian.store') }}" class="return-form">
            @csrf
            <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
            
            <!-- Peminjaman Info -->
            <div class="info-section">
                <div class="section-header">
                    <i class="fa fa-info-circle"></i>
                    <span>Informasi Peminjaman</span>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label class="info-label">Nama User:</label>
                        <span class="info-value">{{ $peminjaman->user->name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Mobil:</label>
                        <span class="info-value">{{ $peminjaman->mobil->nama ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Tanggal Pinjam:</label>
                        <span class="info-value">{{ $peminjaman->tanggal_pinjam }}</span>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Tanggal Kembali (Rencana):</label>
                        <span class="info-value">{{ $peminjaman->tanggal_kembali }}</span>
                    </div>
                </div>
            </div>

            <!-- Return Details -->
            <div class="form-section">
                <div class="section-header">
                    <i class="fa fa-edit"></i>
                    <span>Detail Pengembalian</span>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian Aktual</label>
                        <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" value="{{ date('Y-m-d') }}" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="denda" class="form-label">Denda (jika ada)</label>
                        <input type="number" name="denda" id="denda" value="0" min="0" class="form-input" placeholder="Masukkan jumlah denda">
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save"></i>
                    Simpan Pengembalian
                </button>
                <a href="{{ route('peminjaman.index') }}" class="btn-cancel">
                    <i class="fa fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-container {
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
}

.return-form {
    padding: 32px;
}

/* Section Styles */
.info-section, .form-section {
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

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.info-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.info-value {
    color: #1a237e;
    font-weight: 500;
    font-size: 1rem;
    padding: 8px 12px;
    background: #f8fafc;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.form-input {
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease;
    background: #fff;
}

.form-input:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.form-input::placeholder {
    color: #9ca3af;
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
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: #fff;
}

.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
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
    
    .return-form {
        padding: 24px;
    }
    
    .info-grid, .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
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
    
    .return-form {
        padding: 20px;
    }
    
    .section-header {
        padding: 12px 16px;
        font-size: 1rem;
    }
}
</style>
@endsection 