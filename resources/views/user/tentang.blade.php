@extends('user.layouts.app')

@section('content')
<div style="max-width:1200px;margin:0 auto;padding:32px 0 48px 0;">
    <h1 style="font-size:2.7rem;color:#1a237e;font-weight:800;text-align:center;margin-bottom:8px;" data-aos="fade-down" data-aos-duration="800">Tentang MD Rent Car</h1>
    <div style="color:#4b5563;text-align:center;font-size:1.18rem;margin-bottom:38px;" data-aos="fade-up" data-aos-delay="200">Mitra terpercaya Anda dalam layanan sewa mobil premium sejak 2010</div>
    
    <!-- Misi & Visi -->
    <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;margin-bottom:36px;">
        <div style="flex:1 1 320px;min-width:320px;max-width:480px;background:#fff;border-radius:18px;box-shadow:0 2px 16px rgba(26,35,126,0.08);padding:32px 28px;display:flex;flex-direction:column;gap:18px;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-right" data-aos-delay="300" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(26,35,126,0.08)'">
            <div style="font-size:1.25rem;font-weight:700;color:#1a237e;margin-bottom:8px;">Misi Kami</div>
            <div style="color:#374151;font-size:1.08rem;">Memberikan pengalaman sewa mobil yang luar biasa melalui kendaraan premium, layanan terbaik, dan komitmen yang teguh untuk kepuasan pelanggan.</div>
            <div style="margin-top:10px;color:#1976d2;font-weight:600;display:flex;align-items:center;gap:8px;transition:all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'"><i class="fa fa-car"></i> Mengemudikan keunggulan dalam layanan</div>
        </div>
        <div style="flex:1 1 320px;min-width:320px;max-width:480px;background:#fff;border-radius:18px;box-shadow:0 2px 16px rgba(26,35,126,0.08);padding:32px 28px;display:flex;flex-direction:column;gap:18px;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-left" data-aos-delay="400" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 16px rgba(26,35,126,0.08)'">
            <div style="font-size:1.25rem;font-weight:700;color:#1a237e;margin-bottom:8px;">Visi Kami</div>
            <div style="color:#374151;font-size:1.08rem;">Menjadi penyedia layanan sewa mobil terkemuka, dikenal dengan armada berkualitas, solusi inovatif, dan pendekatan yang berpusat pada pelanggan.</div>
            <div style="margin-top:10px;color:#1976d2;font-weight:600;display:flex;align-items:center;gap:8px;transition:all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'" onmouseout="this.style.transform='translateX(0)'"><i class="fa fa-globe"></i> Menetapkan standar industri baru</div>
        </div>
    </div>
    
    <!-- Statistik -->
    <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;margin-bottom:44px;">
        <div style="flex:1 1 180px;min-width:180px;max-width:220px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 18px;display:flex;flex-direction:column;align-items:center;gap:8px;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="100" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-clock" style="color:#1976d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.5rem;font-weight:700;color:#1a237e;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">5+</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Tahun Pengalaman</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;max-width:220px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 18px;display:flex;flex-direction:column;align-items:center;gap:8px;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="200" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-users" style="color:#1976d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.5rem;font-weight:700;color:#1a237e;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">300+</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Pelanggan Puas</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;max-width:220px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 18px;display:flex;flex-direction:column;align-items:center;gap:8px;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="300" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-car" style="color:#1976d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.5rem;font-weight:700;color:#1a237e;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">6+</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Kendaraan Premium</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;max-width:220px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 18px;display:flex;flex-direction:column;align-items:center;gap:8px;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="400" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-handshake" style="color:#1976d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.5rem;font-weight:700;color:#1a237e;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">24/7</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Dukungan Pelanggan</div>
        </div>
    </div>
    
    <!-- Nilai-Nilai Inti -->
    <div style="font-size:2rem;color:#1a237e;font-weight:800;text-align:center;margin-bottom:32px;" data-aos="fade-up" data-aos-delay="100">Nilai-Nilai Inti Kami</div>
    <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;">
        <div style="flex:1 1 280px;min-width:240px;max-width:340px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 22px;display:flex;flex-direction:column;align-items:center;gap:10px;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="200" onmouseover="this.style.transform='translateY(-8px) scale(1.02)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-award" style="color:#1996d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(10deg) scale(1.2)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.18rem;font-weight:700;color:#1a237e;">Kualitas</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Kami mempertahankan standar tertinggi untuk kendaraan dan layanan kami</div>
        </div>
        <div style="flex:1 1 280px;min-width:240px;max-width:340px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 22px;display:flex;flex-direction:column;align-items:center;gap:10px;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="300" onmouseover="this.style.transform='translateY(-8px) scale(1.02)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-handshake" style="color:#1996d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(10deg) scale(1.2)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.18rem;font-weight:700;color:#1a237e;">Keandalan</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Andalkan kami untuk layanan yang dapat diandalkan setiap kali</div>
        </div>
        <div style="flex:1 1 280px;min-width:240px;max-width:340px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.07);padding:28px 22px;display:flex;flex-direction:column;align-items:center;gap:10px;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="400" onmouseover="this.style.transform='translateY(-8px) scale(1.02)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.07)'">
            <i class="fa fa-users" style="color:#1996d2;font-size:2rem;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(10deg) scale(1.2)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
            <div style="font-size:1.18rem;font-weight:700;color:#1a237e;">Fokus Pelanggan</div>
            <div style="color:#374151;font-size:1.05rem;text-align:center;">Kepuasan Anda adalah prioritas utama kami</div>
        </div>
    </div>
</div>
@endsection 