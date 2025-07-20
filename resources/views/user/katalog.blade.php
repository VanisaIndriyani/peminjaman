@extends('user.layouts.app')

@section('content')
<!-- Bootstrap 5 CDN jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Carousel Slide Gambar -->
<div id="catalogCarousel" class="carousel slide mb-4" data-bs-ride="carousel" style="max-width: 900px; margin: 0 auto;" data-aos="fade-in" data-aos-duration="1000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/catalog.jpeg') }}" class="d-block w-100" alt="Catalog" style="border-radius: 16px; height: 340px; object-fit: cover;">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('img/mobile.jpeg') }}" class="d-block w-100" alt="Mobile" style="border-radius: 16px; height: 340px; object-fit: cover;">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#catalogCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#catalogCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    <h1 style="font-size: 2.5rem; color: #1a237e; font-weight: 800; margin-bottom: 16px; text-align: center;" data-aos="fade-down" data-aos-delay="200">
        <i class="fa fa-car" style="margin-right: 12px; color: #1976d2;"></i>Katalog Mobil
    </h1>
    <div style="color: #4b5563; text-align: center; font-size: 1.1rem; margin-bottom: 40px;" data-aos="fade-up" data-aos-delay="300">
        Pilih kendaraan premium favorit Anda untuk perjalanan yang tak terlupakan
    </div>
    
    @if(session('error'))
        <div style="background: linear-gradient(135deg, #fdecea 0%, #ffcdd2 100%); color: #b71c1c; padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #f44336; animation: fadeIn 0.5s ease;" 
             data-aos="fade-up" data-aos-delay="350">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-exclamation-triangle" style="font-size: 1.2rem;"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
    
    @if(session('success'))
        <div style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); color: #1b5e20; padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #4caf50; animation: fadeIn 0.5s ease;" 
             data-aos="fade-up" data-aos-delay="350">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-check-circle" style="font-size: 1.2rem;"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 28px; margin-bottom: 40px;">
        @forelse($mobils as $index => $mobil)
        <div style="background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(26,35,126,0.08); padding: 0; display: flex; flex-direction: column; transition: all 0.4s ease; transform: translateY(0); overflow: hidden; position: relative;" 
             data-aos="fade-up" 
             data-aos-delay="{{ ($index + 1) * 100 }}"
             onmouseover="this.style.transform='translateY(-12px) scale(1.02)';this.style.boxShadow='0 20px 60px rgba(26,35,126,0.15)'" 
             onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 4px 20px rgba(26,35,126,0.08)'">
            
            <!-- Image Section -->
            <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 24px; display: flex; justify-content: center; align-items: center; min-height: 160px; position: relative;">
            @if($mobil->foto)
                    <img src="{{ asset('storage/mobil/'.$mobil->foto) }}" alt="{{ $mobil->nama }}" 
                         style="width: 100%; height: 120px; object-fit: cover; border-radius: 12px; transition: all 0.4s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" 
                         onmouseover="this.style.transform='scale(1.05)';this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" 
                         onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'">
                @else
                    <div style="width: 100%; height: 120px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <i class="fa fa-car" style="font-size: 3rem; color: #1976d2; opacity: 0.7;"></i>
                    </div>
                @endif
                
                <!-- Status Badge -->
                <div style="position: absolute; top: 16px; right: 16px; background: {{ strtolower($mobil->status) === 'tersedia' ? 'linear-gradient(135deg, #4caf50 0%, #45a049 100%)' : 'linear-gradient(135deg, #f44336 0%, #d32f2f 100%)' }}; color: #fff; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                    <i class="fa {{ strtolower($mobil->status) === 'tersedia' ? 'fa-check-circle' : 'fa-times-circle' }}" style="margin-right: 4px;"></i>
                    {{ ucfirst($mobil->status) }}
                </div>
            </div>
            
            <!-- Content Section -->
            <div style="padding: 24px; flex: 1; display: flex; flex-direction: column;">
                <!-- Car Name -->
                <h2 style="font-size: 1.3rem; color: #1a237e; margin: 0 0 8px 0; font-weight: 700; line-height: 1.3; transition: all 0.3s ease;" 
                    onmouseover="this.style.color='#1976d2'" 
                    onmouseout="this.style.color='#1a237e'">
                    {{ $mobil->nama }}
                </h2>
                
                <!-- Price -->
                <div style="color: #1976d2; font-size: 1.25rem; font-weight: 700; margin-bottom: 12px; transition: all 0.3s ease;" 
                     onmouseover="this.style.transform='scale(1.05)'" 
                     onmouseout="this.style.transform='scale(1)'">
                    Rp {{ number_format($mobil->harga_sewa,0,',','.') }} <span style="font-size: 0.9rem; color: #666; font-weight: 500;">/ hari</span>
                </div>
                
                <!-- Car Details -->
                <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; flex: 1;">
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: #555;">
                        <i class="fa fa-tag" style="color: #1976d2; width: 16px;"></i>
                        <span><strong>Merk:</strong> {{ $mobil->merk }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: #555;">
                        <i class="fa fa-calendar" style="color: #1976d2; width: 16px;"></i>
                        <span><strong>Tahun:</strong> {{ $mobil->tahun }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 0.95rem; color: #555;">
                        <i class="fa fa-info-circle" style="color: #1976d2; width: 16px;"></i>
                        <span><strong>Status:</strong> <span style="color: {{ strtolower($mobil->status) === 'tersedia' ? '#4caf50' : '#f44336' }}; font-weight: 600;">{{ ucfirst($mobil->status) }}</span></span>
                    </div>
                </div>
                
                <!-- Action Button -->
                @if(strtolower($mobil->status) === 'tersedia')
                    @auth
                        <a href="{{ url('/peminjaman/create?mobil=' . $mobil->id) }}" 
                           style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 14px 24px; border-radius: 12px; font-size: 1rem; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.3s ease; transform: translateY(0); display: block; box-shadow: 0 4px 15px rgba(26,35,126,0.2);" 
                           onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.3)'" 
                           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(26,35,126,0.2)'">
                            <i class="fa fa-car" style="margin-right: 8px;"></i>Sewa Sekarang
                        </a>
                    @else
                        <a href="{{ url('/login') }}" 
                           style="background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 14px 24px; border-radius: 12px; font-size: 1rem; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.3s ease; transform: translateY(0); display: block; box-shadow: 0 4px 15px rgba(26,35,126,0.2);" 
                           onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.3)'" 
                           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(26,35,126,0.2)'">
                            <i class="fa fa-sign-in-alt" style="margin-right: 8px;"></i>Login untuk Sewa
                        </a>
                    @endauth
            @else
                    <div style="background: linear-gradient(135deg, #9e9e9e 0%, #757575 100%); color: #fff; padding: 14px 24px; border-radius: 12px; font-size: 1rem; font-weight: 600; text-align: center; cursor: not-allowed; opacity: 0.8; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" 
                         onmouseover="this.style.opacity='1';this.style.transform='translateY(-2px)'" 
                         onmouseout="this.style.opacity='0.8';this.style.transform='translateY(0)'">
                        <i class="fa fa-times-circle" style="margin-right: 8px;"></i>Tidak Tersedia
                    </div>
            @endif
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; color: #888; padding: 60px 20px; background: #fff; border-radius: 20px; box-shadow: 0 4px 20px rgba(26,35,126,0.08);" data-aos="fade-up">
            <i class="fa fa-car" style="font-size: 4rem; color: #ddd; margin-bottom: 20px; display: block;"></i>
            <h3 style="color: #666; margin-bottom: 8px;">Belum ada data mobil</h3>
            <p style="color: #999; font-size: 1rem;">Mobil akan segera ditambahkan ke katalog</p>
        </div>
        @endforelse
    </div>
</div>

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
}

@media (max-width: 480px) {
    .car-card {
        margin: 0 10px;
    }
    
    .car-card .content {
        padding: 16px !important;
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