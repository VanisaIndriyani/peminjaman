@extends('user.layouts.app')

@section('content')
<!-- Hero Section -->
<div style="position:relative;overflow:hidden;min-height:380px;padding:64px 0 56px 0;background: url('{{ asset('img/beranda.jpg') }}') center right/cover no-repeat;" data-aos="fade-in" data-aos-duration="1000">
    <div style="position:absolute;inset:0;width:100%;height:100%;background:linear-gradient(90deg,rgba(23,70,162,0.45) 0%,rgba(23,70,162,0.55) 100%);z-index:1;"></div>
    <div style="max-width:1200px;margin:0 auto;position:relative;z-index:2;display:flex;flex-direction:column;align-items:flex-start;justify-content:center;min-height:320px;">
        <h1 style="font-size:3rem;font-weight:800;line-height:1.1;margin-bottom:18px;max-width:700px;color:#fff;text-shadow:0 4px 16px rgba(0,0,0,0.45),0 1px 0 #222;" data-aos="fade-right" data-aos-delay="200">Nikmati Kemewahan<br>dan Kenyamanan<br>dengan Mobil Premium Kami</h1>
        <div style="font-size:1.2rem;margin-bottom:32px;max-width:520px;color:#fff;text-shadow:0 2px 8px rgba(0,0,0,0.35);" data-aos="fade-right" data-aos-delay="400">Pilih dari koleksi kendaraan premium kami untuk perjalanan yang tak terlupakan</div>
        <div style="display:flex;gap:24px;flex-wrap:wrap;" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ url('/katalog') }}" style="background:#22b6ff;color:#fff;padding:16px 32px;border-radius:10px;font-size:1.1rem;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:10px;box-shadow:0 2px 8px rgba(26,35,126,0.08);transition:all 0.3s ease;transform:translateY(0);" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.2)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(26,35,126,0.08)'">
                <i class="fa fa-car"></i> Lihat Armada Kami
            </a>
            <a href="{{ url('/kontak') }}" style="background:#fff;color:#1976d2;padding:16px 32px;border-radius:10px;font-size:1.1rem;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:10px;border:2px solid #fff;transition:all 0.3s ease;transform:translateY(0);" onmouseover="this.style.transform='translateY(-3px)';this.style.background='rgba(255,255,255,0.9)'" onmouseout="this.style.transform='translateY(0)';this.style.background='#fff'">Hubungi Kami</a>
        </div>
    </div>
</div>

<!-- Konten bawah -->
<div style="max-width:1200px;margin:0 auto;">
    <!-- Kontak Section -->
    <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;margin:40px 0 48px 0;">
        <div style="flex:1 1 260px;min-width:260px;max-width:350px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:32px 24px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="100" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
            <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:12px;">Telepon Kami</h3>
            <div style="font-size:1.1rem;color:#222;margin-bottom:4px;">62 896-3693-7394 </div>
            <div style="color:#4b5563;font-size:0.98rem;">Dukungan 24/7 Tersedia</div>
        </div>
        <div style="flex:1 1 260px;min-width:260px;max-width:350px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:32px 24px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="200" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
            <i class="fa fa-envelope" style="font-size:2.2rem;color:#1976d2;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></i>
            <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:6px;">Email Kami</h3>
            <div style="font-size:1.1rem;color:#222;margin-bottom:2px;">mdrentcar22@gmail.com</div>
            <div style="color:#4b5563;font-size:0.98rem;">Respon Cepat Terjamin</div>
        </div>
        <div style="flex:1 1 260px;min-width:260px;max-width:350px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:32px 24px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="300" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
            <i class="fa fa-map-marker-alt" style="font-size:2.2rem;color:#1976d2;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></i>
            <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:6px;">Kunjungi Kami</h3>
            <div style="font-size:1.1rem;color:#222;margin-bottom:2px;">Jl. Keranji GG. H. MOH NO.60 RT 04/RW 06 Ciganjur</div>
            <div style="color:#4b5563;font-size:0.98rem;">Buka 7 Hari Seminggu</div>
        </div>
    </div>

    <!-- Keunggulan Section -->
    <div style="margin:48px 0 32px 0;" data-aos="fade-up" data-aos-delay="100">
        <h2 style="font-size:2.2rem;color:#222;font-weight:800;text-align:center;margin-bottom:10px;" data-aos="fade-up" data-aos-delay="200">Mengapa Memilih MD Rent Car</h2>
        <div style="color:#6b7280;text-align:center;font-size:1.1rem;margin-bottom:32px;" data-aos="fade-up" data-aos-delay="300">Nikmati perpaduan sempurna antara kemewahan, keandalan, dan layanan yang luar biasa</div>
        <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;">
            <div style="flex:1 1 220px;min-width:220px;max-width:300px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:28px 20px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="400" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
                <i class="fa fa-shield-alt" style="font-size:2rem;color:#2196f3;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
                <div style="font-weight:700;font-size:1.1rem;margin-bottom:6px;">Aman & Terpercaya</div>
                <div style="color:#4b5563;font-size:0.98rem;text-align:center;">Semua kendaraan kami menjalani perawatan rutin dan pemeriksaan keselamatan</div>
            </div>
            <div style="flex:1 1 220px;min-width:220px;max-width:300px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:28px 20px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="500" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
                <i class="fa fa-clock" style="font-size:2rem;color:#2196f3;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
                <div style="font-weight:700;font-size:1.1rem;margin-bottom:6px;">Dukungan 24/7</div>
                <div style="color:#4b5563;font-size:0.98rem;text-align:center;">Tim layanan pelanggan kami selalu siap membantu Anda</div>
            </div>
            <div style="flex:1 1 220px;min-width:220px;max-width:300px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:28px 20px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="600" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
                <i class="fa fa-money-bill" style="font-size:2rem;color:#2196f3;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
                <div style="font-weight:700;font-size:1.1rem;margin-bottom:6px;">Harga Terbaik</div>
                <div style="color:#4b5563;font-size:0.98rem;text-align:center;">Harga kompetitif tanpa biaya tersembunyi</div>
            </div>
            <div style="flex:1 1 220px;min-width:220px;max-width:300px;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:28px 20px;display:flex;flex-direction:column;align-items:center;transition:all 0.3s ease;transform:translateY(0);" data-aos="zoom-in" data-aos-delay="700" onmouseover="this.style.transform='translateY(-5px) scale(1.02)';this.style.boxShadow='0 8px 30px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
                <i class="fa fa-award" style="font-size:2rem;color:#2196f3;margin-bottom:10px;transition:all 0.3s ease;" onmouseover="this.style.transform='rotate(5deg) scale(1.1)'" onmouseout="this.style.transform='rotate(0deg) scale(1)'"></i>
                <div style="font-weight:700;font-size:1.1rem;margin-bottom:6px;">Layanan Premium</div>
                <div style="color:#4b5563;font-size:0.98rem;text-align:center;">Kualitas layanan yang luar biasa terjamin</div>
            </div>
        </div>
    </div>

    <!-- Statistik Section -->
    <div style="background:#1976d2;color:#fff;border-radius:0 0 24px 24px;padding:40px 0 32px 0;margin:48px 0 32px 0;display:flex;flex-wrap:wrap;justify-content:center;gap:32px;" data-aos="fade-up" data-aos-delay="100">
        <div style="flex:1 1 180px;min-width:180px;text-align:center;" data-aos="fade-up" data-aos-delay="200">
            <div style="font-size:2.2rem;font-weight:800;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">300+</div>
            <div style="font-size:1.1rem;">Pelanggan Puas</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;text-align:center;" data-aos="fade-up" data-aos-delay="300">
            <div style="font-size:2.2rem;font-weight:800;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">6+</div>
            <div style="font-size:1.1rem;">Kendaraan Premium</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;text-align:center;" data-aos="fade-up" data-aos-delay="400">
            <div style="font-size:2.2rem;font-weight:800;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">2+</div>
            <div style="font-size:1.1rem;">Lokasi</div>
        </div>
        <div style="flex:1 1 180px;min-width:180px;text-align:center;" data-aos="fade-up" data-aos-delay="500">
            <div style="font-size:2.2rem;font-weight:800;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">24/7</div>
            <div style="font-size:1.1rem;">Dukungan Pelanggan</div>
        </div>
    </div>

    <!-- CTA Section -->
    <div style="text-align:center;margin:48px 0 56px 0;" data-aos="fade-up" data-aos-delay="100">
        <h2 style="font-size:2rem;font-weight:800;color:#222;margin-bottom:12px;" data-aos="fade-up" data-aos-delay="200">Siap Memulai Perjalanan Anda?</h2>
        <div style="color:#6b7280;font-size:1.1rem;margin-bottom:28px;" data-aos="fade-up" data-aos-delay="300">Nikmati kemewahan dan kenyamanan kendaraan premium kami. Pesan mobil sempurna Anda hari ini dan nikmati perjalanannya.</div>
        <div data-aos="fade-up" data-aos-delay="400">
            <a href="{{ url('/katalog') }}" style="background: #1976d2; color: #fff; padding: 14px 32px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; text-decoration: none; margin-right: 16px; box-shadow: 0 2px 8px rgba(26,35,126,0.08); transition: all 0.3s ease; transform: translateY(0); display: inline-block;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.2)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(26,35,126,0.08)'">Jelajahi Mobil Kami</a>
            <a href="{{ url('/kontak') }}" style="background: #fff; color: #1976d2; border: 2px solid #1976d2; padding: 14px 32px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; text-decoration: none; transition: all 0.3s ease; transform: translateY(0); display: inline-block;" onmouseover="this.style.transform='translateY(-3px)';this.style.background='#1976d2';this.style.color='#fff'" onmouseout="this.style.transform='translateY(0)';this.style.background='#fff';this.style.color='#1976d2'">Hubungi Kami</a>
        </div>
    </div>
</div>
@endsection 