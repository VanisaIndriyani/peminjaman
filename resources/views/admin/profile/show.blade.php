@extends('admin.layouts.app')

@section('content')
<div class="profile-container">
    <!-- Header Section -->
    <div class="profile-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="profile-title">Profil Admin</h1>
                <p class="profile-subtitle">Kelola informasi profil dan pengaturan akun Anda</p>
            </div>
            <div class="header-icon">
                <i class="fa fa-user-cog"></i>
            </div>
        </div>
    </div>

    <!-- Success Message -->
@if(session('success'))
        <div class="success-message">
            <i class="fa fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
@endif

    <!-- Profile Form Section -->
    <div class="profile-form-section">
        <div class="form-container">
            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="profile-form">
    @csrf
    @method('PUT')
                
                <!-- Profile Picture Section -->
                <div class="profile-picture-section">
                    <div class="picture-container">
        @if($admin && $admin->foto)
                            <img src="{{ asset('storage/profile/'.$admin->foto) }}" alt="Foto Profil" class="profile-picture" id="profilePreview">
        @else
                            <div class="profile-picture-placeholder" id="profilePreview">
                                <i class="fa fa-user"></i>
                            </div>
        @endif
                        <div class="picture-overlay">
                            <label for="fotoInput" class="upload-btn">
                                <i class="fa fa-camera"></i>
                                <span>Ganti Foto</span>
                            </label>
                        </div>
                    </div>
                    <input type="file" name="foto" id="fotoInput" accept="image/*" class="file-input" onchange="previewImage(this)">
                    <p class="picture-hint">Klik untuk mengunggah foto profil baru</p>
                </div>

                <!-- Form Fields -->
                <div class="form-fields">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-user"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" value="{{ $admin->name ?? '' }}" class="form-input" required placeholder="Masukkan nama lengkap">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" name="email" value="{{ $admin->email ?? '' }}" class="form-input" required placeholder="Masukkan email">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-calendar"></i>
                            Tanggal Bergabung
                        </label>
                        <input type="text" value="{{ $admin->created_at ? $admin->created_at->format('d F Y') : 'N/A' }}" class="form-input" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-shield-alt"></i>
                            Role
                        </label>
                        <input type="text" value="Administrator" class="form-input" readonly>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-update">
                        <i class="fa fa-save"></i>
                        <span>Update Profil</span>
                    </button>
                    <a href="/admin/dashboard" class="btn-cancel">
                        <i class="fa fa-arrow-left"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Profile Stats Card -->
        <div class="profile-stats">
            <div class="stats-card">
                <div class="stats-header">
                    <h3>Statistik Akun</h3>
                    <i class="fa fa-chart-bar"></i>
                </div>
                <div class="stats-content">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $admin->created_at ? $admin->created_at->diffForHumans() : 'N/A' }}</span>
                            <span class="stat-label">Bergabung</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fa fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-value">{{ $admin->updated_at ? $admin->updated_at->diffForHumans() : 'N/A' }}</span>
                            <span class="stat-label">Terakhir Update</span>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    </div>
    </div>

<script>
// Image preview functionality
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const preview = document.getElementById('profilePreview');
            
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                // Replace placeholder with image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Foto Profil';
                img.className = 'profile-picture';
                img.id = 'profilePreview';
                preview.parentNode.replaceChild(img, preview);
            }
            
            // Add success animation
            const container = document.querySelector('.picture-container');
            container.style.transform = 'scale(1.05)';
            setTimeout(() => {
                container.style.transform = 'scale(1)';
            }, 200);
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Form validation and submission
document.querySelector('.profile-form').addEventListener('submit', function(e) {
    const submitBtn = document.querySelector('.btn-update');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> <span>Menyimpan...</span>';
    submitBtn.disabled = true;
    
    // Re-enable after 3 seconds (in case of error)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 3000);
});

// Add hover effects
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});
</script>

<style>
.profile-container {
    max-width: 100%;
}

/* Header Section */
.profile-header {
    background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    color: #fff;
    box-shadow: 0 4px 20px rgba(26, 35, 126, 0.15);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.header-text {
    flex: 1;
}

.profile-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 8px 0;
    color: #fff;
}

.profile-subtitle {
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.9;
    line-height: 1.6;
}

.header-icon {
    font-size: 3rem;
    opacity: 0.8;
}

/* Success Message */
.success-message {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    padding: 16px 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    animation: slideInDown 0.5s ease;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Profile Form Section */
.profile-form-section {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 32px;
    align-items: start;
}

.form-container {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

/* Profile Picture Section */
.profile-picture-section {
    text-align: center;
    margin-bottom: 32px;
}

.picture-container {
    position: relative;
    display: inline-block;
    margin-bottom: 16px;
    transition: all 0.3s ease;
}

.profile-picture {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.profile-picture-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #fff;
    border: 4px solid #fff;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.picture-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.picture-container:hover .picture-overlay {
    opacity: 1;
}

.upload-btn {
    color: #fff;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
}

.upload-btn i {
    font-size: 1.2rem;
}

.file-input {
    display: none;
}

.picture-hint {
    color: #6b7280;
    font-size: 0.875rem;
    margin: 0;
}

/* Form Fields */
.form-fields {
    display: grid;
    gap: 24px;
    margin-bottom: 32px;
}

.form-group {
    position: relative;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-label i {
    color: #1976d2;
    font-size: 1rem;
}

.form-input {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fff;
}

.form-input:focus {
    outline: none;
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
    transform: translateY(-2px);
}

.form-input:read-only {
    background: #f9fafb;
    color: #6b7280;
    cursor: not-allowed;
}

.form-group.focused .form-label {
    color: #1976d2;
}

.error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 4px;
    display: block;
}

/* Action Buttons */
.form-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-update {
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
    color: #fff;
    padding: 16px 32px;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    flex: 1;
    min-width: 200px;
}

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 118, 210, 0.3);
}

.btn-update:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
    padding: 16px 32px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    flex: 1;
    min-width: 200px;
}

.btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

/* Profile Stats */
.profile-stats {
    position: sticky;
    top: 24px;
}

.stats-card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.stats-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e5e7eb;
}

.stats-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0;
}

.stats-header i {
    font-size: 1.5rem;
    color: #1976d2;
}

.stats-content {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1976d2 0%, #42a5f5 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
}

.stat-info {
    flex: 1;
}

.stat-value {
    display: block;
    font-size: 1rem;
    font-weight: 600;
    color: #1a237e;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-form-section {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .profile-stats {
        position: static;
    }
}

@media (max-width: 768px) {
    .profile-header {
        padding: 24px;
    }
    
    .profile-title {
        font-size: 2rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
    
    .form-container {
        padding: 24px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-update, .btn-cancel {
        min-width: auto;
    }
    
    .stats-card {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .profile-header {
        padding: 20px;
    }
    
    .profile-title {
        font-size: 1.75rem;
    }
    
    .form-container {
        padding: 20px;
    }
    
    .profile-picture, .profile-picture-placeholder {
        width: 100px;
        height: 100px;
    }
    
    .form-input {
        padding: 14px 16px;
    }
}
</style>
@endsection 