@extends('user.layouts.app')

@section('content')
<div style="max-width:520px;margin:0 auto;background:#fff;padding:36px 28px;border-radius:16px;box-shadow:0 2px 16px rgba(26,35,126,0.08);transition:all 0.3s ease;transform:translateY(0);" 
     data-aos="fade-up" data-aos-duration="800"
     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" 
     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(26,35,126,0.08)'">
    
    <h1 style="font-size:2rem;color:#1a237e;font-weight:800;margin-bottom:18px;text-align:center;" data-aos="fade-down" data-aos-delay="200">
        <i class="fa fa-car" style="margin-right:12px;color:#1976d2;"></i>Form Peminjaman Mobil
    </h1>
    
    @if($mobil)
        <div style="background:linear-gradient(135deg, #f0f4ff 0%, #e3f2fd 100%);padding:16px 20px;border-radius:12px;margin-bottom:20px;border-left:4px solid #1976d2;transition:all 0.3s ease;" 
             data-aos="fade-up" data-aos-delay="300"
             onmouseover="this.style.transform='translateX(5px)'" 
             onmouseout="this.style.transform='translateX(0)'">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                <i class="fa fa-car" style="color:#1976d2;font-size:1.2rem;"></i>
                <b style="color:#1a237e;">Mobil:</b> <span style="color:#1976d2;font-weight:600;">{{ $mobil->nama }}</span> <span style="color:#666;">({{ $mobil->merk }})</span>
            </div>
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="fa fa-money-bill" style="color:#1976d2;font-size:1.2rem;"></i>
                <b style="color:#1a237e;">Harga Sewa:</b> <span style="color:#1976d2;font-weight:600;">Rp {{ number_format($mobil->harga_sewa,0,',','.') }} / hari</span>
            </div>
        </div>
    @endif
    
    @php
        $isFirst = \App\Models\Peminjaman::where('user_id', auth()->id())->count() == 0;
    @endphp
    
    @if($isFirst)
        <div style="background:linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);color:#01579b;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600;border-left:4px solid #2196f3;transition:all 0.3s ease;" 
             data-aos="fade-up" data-aos-delay="400"
             onmouseover="this.style.transform='scale(1.02)'" 
             onmouseout="this.style.transform='scale(1)'">
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="fa fa-gift" style="font-size:1.2rem;"></i>
                <span>Selamat! Peminjaman pertama Anda akan mendapatkan <b>diskon 10%</b> dari total harga sewa.</span>
            </div>
        </div>
    @endif
    
    <div style="background:linear-gradient(135deg, #fffde7 0%, #fff8e1 100%);color:#f57c00;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600;border-left:4px solid #ff9800;transition:all 0.3s ease;" 
         data-aos="fade-up" data-aos-delay="500"
         onmouseover="this.style.transform='scale(1.02)'" 
         onmouseout="this.style.transform='scale(1)'">
        <div style="display:flex;align-items:center;gap:8px;">
            <i class="fa fa-info-circle" style="font-size:1.2rem;"></i>
            <span>Setelah mengajukan, Anda akan mendapatkan instruksi pembayaran dan link konfirmasi ke WhatsApp admin.</span>
        </div>
    </div>
    
    @if(session('success'))
        <div style="background:linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);color:#1b5e20;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600;border-left:4px solid #4caf50;animation:fadeIn 0.5s ease;" 
             data-aos="fade-up">
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="fa fa-check-circle" style="font-size:1.2rem;"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div style="background:linear-gradient(135deg, #fdecea 0%, #ffcdd2 100%);color:#b71c1c;padding:16px 20px;border-radius:12px;margin-bottom:20px;border-left:4px solid #f44336;animation:fadeIn 0.5s ease;" 
             data-aos="fade-up">
            <div style="display:flex;align-items:flex-start;gap:8px;">
                <i class="fa fa-exclamation-triangle" style="font-size:1.2rem;margin-top:2px;"></i>
                <div>
                    <div style="font-weight:600;margin-bottom:8px;">Mohon perbaiki kesalahan berikut:</div>
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    
    <form method="POST" action="/peminjaman" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:24px;">
        @csrf
        <input type="hidden" name="mobil_id" value="{{ $mobil->id ?? '' }}">
        
        <div style="display:flex;gap:18px;" data-aos="fade-up" data-aos-delay="600">
            <div style="flex:1;display:flex;flex-direction:column;gap:8px;">
                <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:6px;">
                    <i class="fa fa-calendar" style="color:#1976d2;"></i>Tanggal Pinjam
                </label>
                <input type="date" name="tanggal_pinjam" required 
                       style="width:100%;padding:14px 16px;border-radius:10px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                       onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                       onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
            </div>
            <div style="flex:1;display:flex;flex-direction:column;gap:8px;">
                <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:6px;">
                    <i class="fa fa-calendar-check" style="color:#1976d2;"></i>Tanggal Kembali
                </label>
                <input type="date" name="tanggal_kembali" required 
                       style="width:100%;padding:14px 16px;border-radius:10px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                       onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                       onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
            </div>
        </div>
        
        <!-- File Upload Section -->
        <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 16px; padding: 24px; border: 2px dashed #cbd5e1; transition: all 0.3s ease;" 
             data-aos="fade-up" data-aos-delay="700"
             onmouseover="this.style.borderColor='#1976d2';this.style.background='linear-gradient(135deg, #f0f4ff 0%, #e3f2fd 100%)'" 
             onmouseout="this.style.borderColor='#cbd5e1';this.style.background='linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%)'">
            
            <div style="text-align: center; margin-bottom: 20px;">
                <i class="fa fa-cloud-upload-alt" style="font-size: 2rem; color: #1976d2; margin-bottom: 8px; display: block;"></i>
                <h3 style="color: #1a237e; font-size: 1.1rem; font-weight: 600; margin-bottom: 4px;">Upload Dokumen</h3>
                <p style="color: #64748b; font-size: 0.9rem;">Upload semua dokumen yang diperlukan dalam format JPG, PNG, atau PDF</p>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <!-- Foto Diri -->
                <div class="file-upload-container" data-aos="fade-up" data-aos-delay="750">
                    <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                        <i class="fa fa-user" style="color:#1976d2;font-size:1.1rem;"></i>Foto Diri
                        <span style="color:#ef4444;font-size:0.8rem;">*</span>
                    </label>
                    <div class="custom-file-upload" 
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(25,118,210,0.15)'" 
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(25,118,210,0.1)'">
                        <input type="file" name="foto_diri" accept="image/*" required class="file-input" 
                               onchange="updateFileName(this, 'foto-diri-label')">
                        <label for="foto-diri-label" class="file-label">
                            <i class="fa fa-camera" style="margin-right:8px;color:#1976d2;"></i>
                            <span class="file-text">Pilih Foto Diri</span>
                        </label>
                    </div>
                </div>
                
                <!-- KTP -->
                <div class="file-upload-container" data-aos="fade-up" data-aos-delay="800">
                    <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                        <i class="fa fa-id-card" style="color:#1976d2;font-size:1.1rem;"></i>KTP
                        <span style="color:#ef4444;font-size:0.8rem;">*</span>
                    </label>
                    <div class="custom-file-upload" 
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(25,118,210,0.15)'" 
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(25,118,210,0.1)'">
                        <input type="file" name="ktp" accept="image/*" required class="file-input" 
                               onchange="updateFileName(this, 'ktp-label')">
                        <label for="ktp-label" class="file-label">
                            <i class="fa fa-id-card" style="margin-right:8px;color:#1976d2;"></i>
                            <span class="file-text">Pilih KTP</span>
                        </label>
                    </div>
                </div>
                
                <!-- Kartu Keluarga -->
                <div class="file-upload-container" data-aos="fade-up" data-aos-delay="850">
                    <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                        <i class="fa fa-home" style="color:#1976d2;font-size:1.1rem;"></i>Kartu Keluarga (KK)
                        <span style="color:#ef4444;font-size:0.8rem;">*</span>
                    </label>
                    <div class="custom-file-upload" 
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(25,118,210,0.15)'" 
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(25,118,210,0.1)'">
                        <input type="file" name="kk" accept="image/*" required class="file-input" 
                               onchange="updateFileName(this, 'kk-label')">
                        <label for="kk-label" class="file-label">
                            <i class="fa fa-home" style="margin-right:8px;color:#1976d2;"></i>
                            <span class="file-text">Pilih Kartu Keluarga</span>
                        </label>
                    </div>
                </div>
                
                <!-- SIM A -->
                <div class="file-upload-container" data-aos="fade-up" data-aos-delay="900">
                    <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                        <i class="fa fa-car" style="color:#1976d2;font-size:1.1rem;"></i>SIM A
                        <span style="color:#ef4444;font-size:0.8rem;">*</span>
                    </label>
                    <div class="custom-file-upload" 
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(25,118,210,0.15)'" 
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(25,118,210,0.1)'">
                        <input type="file" name="sim_a" accept="image/*" required class="file-input" 
                               onchange="updateFileName(this, 'sim-a-label')">
                        <label for="sim-a-label" class="file-label">
                            <i class="fa fa-car" style="margin-right:8px;color:#1976d2;"></i>
                            <span class="file-text">Pilih SIM A</span>
                        </label>
                    </div>
                </div>
                
                <!-- KTP Penjamin -->
                <div class="file-upload-container" data-aos="fade-up" data-aos-delay="950">
                    <label style="font-weight:600;color:#1a237e;display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                        <i class="fa fa-user-friends" style="color:#1976d2;font-size:1.1rem;"></i>KTP Penjamin
                        <span style="color:#ef4444;font-size:0.8rem;">*</span>
                    </label>
                    <div class="custom-file-upload" 
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(25,118,210,0.15)'" 
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(25,118,210,0.1)'">
                        <input type="file" name="ktp_penjamin" accept="image/*" required class="file-input" 
                               onchange="updateFileName(this, 'ktp-penjamin-label')">
                        <label for="ktp-penjamin-label" class="file-label">
                            <i class="fa fa-user-friends" style="margin-right:8px;color:#1976d2;"></i>
                            <span class="file-text">Pilih KTP Penjamin</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" 
                style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 18px 0; border-radius: 12px; font-size: 1.15rem; font-weight: 700; border: none; cursor: pointer; box-shadow:0 4px 15px rgba(26,35,126,0.15);transition:all 0.3s ease;transform:translateY(0);margin-top:10px;" 
                data-aos="fade-up" data-aos-delay="1200"
                onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.25)'" 
                onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(26,35,126,0.15)'">
            <i class="fa fa-paper-plane" style="margin-right:8px;"></i>Ajukan Peminjaman
        </button>
    </form>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced form styling */
input:focus, select:focus, textarea:focus {
    border-color: #1976d2 !important;
    background: #fff !important;
    box-shadow: 0 0 0 3px rgba(25,118,210,0.1) !important;
}

/* Custom file upload styling */
.file-upload-container {
    position: relative;
}

.custom-file-upload {
    position: relative;
    background: #fff;
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    overflow: hidden;
}

.custom-file-upload:hover {
    border-color: #1976d2;
    background: #f8fafc;
}

.custom-file-upload.dragover {
    border-color: #1976d2;
    background: #f0f4ff;
    transform: scale(1.02);
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: 600;
    color: #1a237e;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-text {
    font-size: 0.95rem;
}

.custom-file-upload:hover .file-label {
    color: #1976d2;
}

.custom-file-upload:hover .file-label i {
    transform: scale(1.1);
}

/* File selected state */
.custom-file-upload.has-file {
    border-color: #10b981;
    background: #f0fdf4;
}

.custom-file-upload.has-file .file-label {
    color: #10b981;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .flex {
        flex-direction: column !important;
    }
    
    .flex > div {
        flex: 1 1 100% !important;
    }
    
    .custom-file-upload {
        padding: 12px;
    }
    
    .file-label {
        font-size: 0.9rem;
    }
}

/* Loading animation */
.custom-file-upload.uploading {
    position: relative;
    pointer-events: none;
}

.custom-file-upload.uploading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #1976d2;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>

<script>
function updateFileName(input, labelId) {
    const file = input.files[0];
    const container = input.closest('.custom-file-upload');
    const label = container.querySelector('.file-text');
    
    if (file) {
        // Add file selected class
        container.classList.add('has-file');
        
        // Update text with file name
        const fileName = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
        label.textContent = fileName;
        
        // Add success icon
        const icon = container.querySelector('i');
        icon.className = 'fa fa-check-circle';
        icon.style.color = '#10b981';
        
        // Show file size
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        label.textContent += ` (${fileSize} MB)`;
    } else {
        // Remove file selected class
        container.classList.remove('has-file');
        
        // Reset to original text
        const originalTexts = {
            'foto-diri-label': 'Pilih Foto Diri',
            'ktp-label': 'Pilih KTP',
            'kk-label': 'Pilih Kartu Keluarga',
            'sim-a-label': 'Pilih SIM A',
            'ktp-penjamin-label': 'Pilih KTP Penjamin'
        };
        label.textContent = originalTexts[labelId] || 'Pilih File';
        
        // Reset icon
        const icon = container.querySelector('i');
        const originalIcons = {
            'foto-diri-label': 'fa fa-camera',
            'ktp-label': 'fa fa-id-card',
            'kk-label': 'fa fa-home',
            'sim-a-label': 'fa fa-car',
            'ktp-penjamin-label': 'fa fa-user-friends'
        };
        icon.className = originalIcons[labelId] || 'fa fa-file';
        icon.style.color = '#1976d2';
    }
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const fileUploads = document.querySelectorAll('.custom-file-upload');
    
    fileUploads.forEach(upload => {
        upload.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        upload.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });
        
        upload.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const input = this.querySelector('.file-input');
            const files = e.dataTransfer.files;
            
            if (files.length > 0) {
                input.files = files;
                updateFileName(input, input.name + '-label');
            }
        });
    });
});
</script>
@endsection 