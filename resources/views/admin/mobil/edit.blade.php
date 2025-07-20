@extends('admin.layouts.app')

@section('content')
<div class="form-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Edit Mobil</h1>
            <p class="page-subtitle">Edit data mobil yang sudah ada</p>
        </div>
       
    </div>

    <!-- Form Section -->
    <div class="form-wrapper">
        <form method="POST" action="{{ route('mobil.update', $mobil->id) }}" enctype="multipart/form-data" class="mobil-form">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <!-- Nama Mobil -->
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Mobil</label>
                    <input type="text" id="nama" name="nama" value="{{ $mobil->nama }}" class="form-input" required>
                </div>

                <!-- Merk -->
                <div class="form-group">
                    <label for="merk" class="form-label">Merk</label>
                    <input type="text" id="merk" name="merk" value="{{ $mobil->merk }}" class="form-input" required>
                </div>

                <!-- Tahun -->
                <div class="form-group">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" id="tahun" name="tahun" value="{{ $mobil->tahun }}" class="form-input" required min="1990" max="2099">
                </div>

                <!-- Plat Nomor -->
                <div class="form-group">
                    <label for="plat_nomor" class="form-label">Plat Nomor</label>
                    <input type="text" id="plat_nomor" name="plat_nomor" value="{{ $mobil->plat_nomor }}" class="form-input" required>
                </div>

                <!-- Harga Sewa -->
                <div class="form-group">
                    <label for="harga_sewa" class="form-label">Harga Sewa (Rp)</label>
                    <input type="number" id="harga_sewa" name="harga_sewa" value="{{ $mobil->harga_sewa }}" class="form-input" required>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="tersedia" @if($mobil->status=='tersedia') selected @endif>Tersedia</option>
                        <option value="dipinjam" @if($mobil->status=='dipinjam') selected @endif>Dipinjam</option>
                    </select>
                </div>
            </div>

            <!-- Foto Mobil -->
            <div class="form-group full-width">
                <label for="foto" class="form-label">Foto Mobil</label>
                
                <!-- Current Image Preview -->
                @if($mobil->foto)
                <div class="current-image">
                    <img src="{{ asset('storage/mobil/'.$mobil->foto) }}" alt="Foto {{ $mobil->nama }}" class="preview-image">
                    <div class="image-info">
                        <span>Foto saat ini</span>
                        <small>{{ $mobil->foto }}</small>
                    </div>
                </div>
                @endif
                
                <!-- File Upload -->
                <div class="file-upload-container">
                    <input type="file" id="foto" name="foto" accept="image/*" class="file-input">
                    <div class="file-upload-placeholder">
                        <i class="fa fa-cloud-upload-alt"></i>
                        <span>Pilih file gambar baru atau drag & drop di sini</span>
                        <small>Format: JPG, PNG, GIF (Max: 2MB) - Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fa fa-save"></i>
                    Update Mobil
                </button>
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
}

.mobil-form {
    padding: 32px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.875rem;
}

.form-input, .form-select {
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease;
    background: #fff;
}

.form-input:focus, .form-select:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

.form-select {
    cursor: pointer;
}

/* Current Image Styles */
.current-image {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    margin-bottom: 16px;
}

.preview-image {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #d1d5db;
}

.image-info {
    display: flex;
    flex-direction: column;
}

.image-info span {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.image-info small {
    color: #6b7280;
    font-size: 0.75rem;
}

/* File Upload Styles */
.file-upload-container {
    position: relative;
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    padding: 32px;
    text-align: center;
    transition: border-color 0.2s ease;
}

.file-upload-container:hover {
    border-color: #1976d2;
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-upload-placeholder {
    pointer-events: none;
}

.file-upload-placeholder i {
    font-size: 2rem;
    color: #9ca3af;
    margin-bottom: 12px;
    display: block;
}

.file-upload-placeholder span {
    display: block;
    font-size: 1rem;
    color: #374151;
    margin-bottom: 4px;
}

.file-upload-placeholder small {
    color: #6b7280;
    font-size: 0.875rem;
}

/* Submit Button */
.form-actions {
    display: flex;
    justify-content: flex-end;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
    color: #fff;
    padding: 14px 32px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
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
    
    .mobil-form {
        padding: 24px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .current-image {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .form-actions {
        justify-content: stretch;
    }
    
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .mobil-form {
        padding: 20px;
    }
    
    .file-upload-container {
        padding: 24px 16px;
    }
    
    .current-image {
        padding: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('foto');
    const fileContainer = document.querySelector('.file-upload-container');
    const placeholder = document.querySelector('.file-upload-placeholder');
    
    if (fileInput && fileContainer) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                placeholder.innerHTML = `
                    <i class="fa fa-check-circle" style="color: #059669;"></i>
                    <span>${file.name}</span>
                    <small>${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                `;
                fileContainer.style.borderColor = '#059669';
            }
        });
        
        // Drag and drop functionality
        fileContainer.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#1976d2';
            this.style.backgroundColor = '#f8fafc';
        });
        
        fileContainer.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#d1d5db';
            this.style.backgroundColor = '#fff';
        });
        
        fileContainer.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#d1d5db';
            this.style.backgroundColor = '#fff';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }
});
</script>
@endsection 