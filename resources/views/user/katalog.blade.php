@extends('user.layouts.app')

@section('content')
<!-- Bootstrap 5 CDN jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



<div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    <h1 style="font-size: 2.5rem; color: #1a237e; font-weight: 800; margin: 40px 0 24px 0; text-align: center;" data-aos="fade-down" data-aos-delay="200">
        <i class="fa fa-car" style="margin-right: 16px; color: #1976d2;"></i>Katalog Mobil
    </h1>
    <div style="color: #4b5563; text-align: center; font-size: 1.1rem; margin-bottom: 50px; line-height: 1.6;" data-aos="fade-up" data-aos-delay="300">
        Pilih kendaraan premium favorit Anda untuk perjalanan yang tak terlupakan
    </div>
    
    @if(session('error'))
        <div style="background: linear-gradient(135deg, #fdecea 0%, #ffcdd2 100%); color: #b71c1c; padding: 20px 24px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #f44336; animation: fadeIn 0.5s ease;" 
             data-aos="fade-up" data-aos-delay="350">
            <div style="display: flex; align-items: center; gap: 12px;">
                <i class="fa fa-exclamation-triangle" style="font-size: 1.3rem;"></i>
                <span style="font-size: 1.05rem;">{{ session('error') }}</span>
            </div>
        </div>
    @endif
    
    @if(session('success'))
        <div style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); color: #1b5e20; padding: 20px 24px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #4caf50; animation: fadeIn 0.5s ease;" 
             data-aos="fade-up" data-aos-delay="350">
            <div style="display: flex; align-items: center; gap: 12px;">
                <i class="fa fa-check-circle" style="font-size: 1.3rem;"></i>
                <span style="font-size: 1.05rem;">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; margin-bottom: 40px;">
        @forelse($mobils as $index => $mobil)
        <div style="background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(26,35,126,0.08); padding: 0; display: flex; flex-direction: column; transition: all 0.4s ease; transform: translateY(0); overflow: hidden; position: relative;" 
             data-aos="fade-up" 
             data-aos-delay="{{ ($index + 1) * 100 }}"
             onmouseover="this.style.transform='translateY(-8px) scale(1.01)';this.style.boxShadow='0 16px 40px rgba(26,35,126,0.12)'" 
             onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 4px 20px rgba(26,35,126,0.08)'">
            
            <!-- Image Section -->
            <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 28px 24px; display: flex; justify-content: center; align-items: center; min-height: 180px; position: relative;">
            @if($mobil->foto)
                    <img src="{{ asset('storage/mobil/'.$mobil->foto) }}" alt="{{ $mobil->nama }}" 
                         style="width: 100%; height: 140px; object-fit: cover; border-radius: 12px; transition: all 0.4s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" 
                         onmouseover="this.style.transform='scale(1.03)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.12)'" 
                         onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'">
                @else
                    <div style="width: 100%; height: 140px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <i class="fa fa-car" style="font-size: 3.5rem; color: #1976d2; opacity: 0.7;"></i>
                    </div>
                @endif
                
                <!-- Status Badge -->
                <div style="position: absolute; top: 20px; right: 20px; background: {{ strtolower($mobil->status) === 'tersedia' ? 'linear-gradient(135deg, #4caf50 0%, #45a049 100%)' : 'linear-gradient(135deg, #f44336 0%, #d32f2f 100%)' }}; color: #fff; padding: 8px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                    <i class="fa {{ strtolower($mobil->status) === 'tersedia' ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-right: 4px;"></i>
                    {{ ucfirst($mobil->status) }}
                </div>
            </div>
            
            <!-- Content Section -->
            <div style="padding: 28px; flex: 1; display: flex; flex-direction: column;">
                <!-- Car Name -->
                <h2 style="font-size: 1.4rem; color: #1a237e; margin: 0 0 12px 0; font-weight: 700; line-height: 1.3; transition: all 0.3s ease;" 
                    onmouseover="this.style.color='#1976d2'" 
                    onmouseout="this.style.color='#1a237e'">
                    {{ $mobil->nama }}
                </h2>
                
                <!-- Price -->
                <div style="color: #1976d2; font-size: 1.3rem; font-weight: 700; margin-bottom: 16px; transition: all 0.3s ease;" 
                     onmouseover="this.style.transform='scale(1.02)'" 
                     onmouseout="this.style.transform='scale(1)'">
                    Rp {{ number_format($mobil->harga_sewa,0,',','.') }} <span style="font-size: 0.9rem; color: #666; font-weight: 500;">/ hari</span>
                </div>
                
                <!-- Car Details -->
                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; flex: 1;">
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 1rem; color: #555; padding: 8px 0;">
                        <i class="fa fa-tag" style="color: #1976d2; width: 18px; font-size: 1.1rem;"></i>
                        <span><strong>Merk:</strong> {{ $mobil->merk }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 1rem; color: #555; padding: 8px 0;">
                        <i class="fa fa-cog" style="color: #1976d2; width: 18px; font-size: 1.1rem;"></i>
                        <span><strong>Tipe:</strong> {{ $mobil->tahun }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 1rem; color: #555; padding: 8px 0;">
                        <i class="fa fa-info-circle" style="color: #1976d2; width: 18px; font-size: 1.1rem;"></i>
                        <span><strong>Status:</strong> <span style="color: {{ strtolower($mobil->status) === 'tersedia' ? '#4caf50' : '#f44336' }}; font-weight: 600;">{{ ucfirst($mobil->status) }}</span></span>
                    </div>
                </div>
                
                <!-- Action Button -->
                @if(strtolower($mobil->status) === 'tersedia')
                    @auth
                        <a href="{{ url('/peminjaman/create?mobil=' . $mobil->id) }}" 
                           style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 16px 24px; border-radius: 12px; font-size: 1.05rem; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.3s ease; transform: translateY(0); display: block; box-shadow: 0 4px 15px rgba(26,35,126,0.2);" 
                           onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(26,35,126,0.25)'" 
                           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(26,35,126,0.2)'">
                            <i class="fa fa-car" style="margin-right: 8px;"></i>Sewa Sekarang
                        </a>
                    @else
                        <a href="{{ url('/login') }}" 
                           style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 16px 24px; border-radius: 12px; font-size: 1.05rem; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.3s ease; transform: translateY(0); display: block; box-shadow: 0 4px 15px rgba(26,35,126,0.2);" 
                           onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(26,35,126,0.25)'" 
                           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(26,35,126,0.2)'">
                            <i class="fa fa-sign-in-alt" style="margin-right: 8px;"></i>Login untuk Sewa
                        </a>
                    @endauth
            @else
                    <div style="background: linear-gradient(135deg, #9e9e9e 0%, #757575 100%); color: #fff; padding: 16px 24px; border-radius: 12px; font-size: 1.05rem; font-weight: 600; text-align: center; cursor: not-allowed; opacity: 0.8; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" 
                         onmouseover="this.style.opacity='1';this.style.transform='translateY(-2px)'" 
                         onmouseout="this.style.opacity='0.8';this.style.transform='translateY(0)'">
                        <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Tidak Tersedia
                    </div>
            @endif
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; color: #888; padding: 80px 40px; background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(26,35,126,0.08); margin: 20px 0;" data-aos="fade-up">
            <i class="fa fa-car" style="font-size: 5rem; color: #ddd; margin-bottom: 30px; display: block;"></i>
            <h3 style="color: #666; margin-bottom: 16px; font-size: 1.4rem;">Belum ada data mobil</h3>
            <p style="color: #999; font-size: 1.1rem; line-height: 1.6;">Mobil akan segera ditambahkan ke katalog</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Gambar Besar -->
<div id="imageModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <span id="closeModal" style="position:absolute;top:32px;right:48px;font-size:2.5rem;color:#fff;cursor:pointer;font-weight:bold;z-index:10001;">&times;</span>
    <img id="modalImg" src="" alt="Gambar Mobil" style="max-width:90vw;max-height:80vh;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.25);background:#fff;">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cari semua gambar mobil di katalog dan carousel
    const images = document.querySelectorAll('.card-mobil img, .mobil-img, .img-mobil, .carousel-img');
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');
    const closeModal = document.getElementById('closeModal');

    images.forEach(img => {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function() {
            modal.style.display = 'flex';
            modalImg.src = this.src;
            modalImg.alt = this.alt || 'Gambar Mobil';
        });
    });

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
        modalImg.src = '';
    });
    // Tutup modal jika klik di luar gambar
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            modalImg.src = '';
        }
    });
});
</script>

<!-- Bootstrap JS jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
/* Enhanced carousel controls */
.carousel-control-prev,
.carousel-control-next {
    background: rgba(26,35,126,0.8);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: rgba(26,35,126,1);
    transform: translateY(-50%) scale(1.1);
}

.carousel-control-prev {
    left: 20px;
}

.carousel-control-next {
    right: 20px;
}

/* Enhanced carousel indicators */
.carousel-indicators {
    bottom: 20px;
}

.carousel-indicators button {
    background-color: rgba(255,255,255,0.5);
    border: 2px solid rgba(255,255,255,0.8);
    border-radius: 50%;
    width: 12px;
    height: 12px;
    margin: 0 4px;
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: #fff;
    transform: scale(1.2);
}

/* Card hover effects */
.car-card {
    position: relative;
    overflow: hidden;
}

.car-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.car-card:hover::before {
    left: 100%;
}

/* Responsive grid adjustments */
@media (max-width: 768px) {
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
    
    /* Mobile grid adjustments */
    .grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
    
    /* Katalog grid adjustments */
    div[style*="grid-template-columns"] {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        gap: 24px !important;
    }
    
    /* Header adjustments for tablet */
    h1[style*="margin: 40px 0 24px 0"] {
        margin: 30px 0 20px 0 !important;
        font-size: 2.2rem !important;
    }
    
    div[style*="margin-bottom: 50px"] {
        margin-bottom: 40px !important;
    }
    
    /* Card adjustments for tablet */
    div[style*="padding: 28px"] {
        padding: 24px !important;
    }
    
    div[style*="padding: 28px 24px"] {
        padding: 24px 20px !important;
    }
}

@media (max-width: 480px) {
    .car-card {
        margin: 0 10px;
    }
    
    .car-card .content {
        padding: 16px !important;
    }
    
    /* Katalog grid adjustments for mobile */
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
    
    /* Card adjustments for mobile */
    div[style*="padding: 28px"] {
        padding: 20px !important;
    }
    
    div[style*="padding: 28px 24px"] {
        padding: 20px 16px !important;
    }
    
    /* Image section adjustments */
    div[style*="min-height: 180px"] {
        min-height: 160px !important;
    }
    
    /* Text size adjustments */
    h2[style*="font-size: 1.4rem"] {
        font-size: 1.2rem !important;
    }
    
    div[style*="font-size: 1.3rem"] {
        font-size: 1.1rem !important;
    }
    
    div[style*="font-size: 1rem"] {
        font-size: 0.9rem !important;
    }
    
    /* Button adjustments */
    a[style*="padding: 16px 24px"], div[style*="padding: 16px 24px"] {
        padding: 14px 20px !important;
        font-size: 1rem !important;
    }
}

/* Smooth animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.car-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Enhanced focus states */
.car-card:focus-within {
    outline: 2px solid #1976d2;
    outline-offset: 2px;
}

/* Loading state */
.car-card.loading {
    opacity: 0.7;
    pointer-events: none;
}

.car-card.loading::after {
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
@endsection 