@extends('user.layouts.app')

@section('content')
<div style="max-width:1200px;margin:0 auto;">
    <h1 style="font-size:2.3rem;color:#1a237e;font-weight:800;text-align:center;margin-bottom:10px;" data-aos="fade-down" data-aos-duration="800">Hubungi Kami</h1>
    <div style="color:#4b5563;text-align:center;font-size:1.1rem;margin-bottom:38px;" data-aos="fade-up" data-aos-delay="200">Ada pertanyaan? Kami siap membantu. Hubungi tim kami untuk bantuan.</div>
    
    <div style="display:flex;flex-wrap:wrap;gap:32px;justify-content:center;align-items:flex-start;">
        <!-- Kontak Info -->
        <div style="flex:1 1 320px;min-width:320px;max-width:400px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:32px 28px;display:flex;flex-direction:column;gap:22px;transition:all 0.3s ease;transform:translateY(0);" 
             data-aos="fade-right" data-aos-delay="300"
             onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" 
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
            
            <div style="display:flex;align-items:flex-start;gap:16px;transition:all 0.3s ease;padding:12px;border-radius:8px;" 
                 onmouseover="this.style.background='rgba(25,118,210,0.05)'" 
                 onmouseout="this.style.background='transparent'">
                <i class="fa fa-phone" style="font-size:1.5rem;color:#1976d2;margin-top:2px;transition:all 0.3s ease;" 
                   onmouseover="this.style.transform='scale(1.2)'" 
                   onmouseout="this.style.transform='scale(1)'"></i>
                <div>
                    <div style="font-weight:700;">Telepon</div>
                    <div style="color:#1976d2;font-size:1.08rem;">+62 896-3693-7394 <i class="fa fa-whatsapp" style="color:#43d854;"></i></div>
                    <div style="font-size:0.97rem;color:#4b5563;">Tersedia 24/7 untuk dukungan</div>
                </div>
            </div>
            
            <div style="display:flex;align-items:flex-start;gap:16px;transition:all 0.3s ease;padding:12px;border-radius:8px;" 
                 onmouseover="this.style.background='rgba(25,118,210,0.05)'" 
                 onmouseout="this.style.background='transparent'">
                <i class="fa fa-envelope" style="font-size:1.5rem;color:#1976d2;margin-top:2px;transition:all 0.3s ease;" 
                   onmouseover="this.style.transform='scale(1.2)'" 
                   onmouseout="this.style.transform='scale(1)'"></i>
                <div>
                    <div style="font-weight:700;">Email</div>
                    <div style="color:#1976d2;font-size:1.08rem;">mdrentcar22@gmail.com</div>
                    <div style="font-size:0.97rem;color:#4b5563;">Kami akan merespons dalam 24 jam</div>
                </div>
            </div>
            
            <div style="display:flex;align-items:flex-start;gap:16px;transition:all 0.3s ease;padding:12px;border-radius:8px;" 
                 onmouseover="this.style.background='rgba(25,118,210,0.05)'" 
                 onmouseout="this.style.background='transparent'">
                <i class="fa fa-map-marker-alt" style="font-size:1.5rem;color:#1976d2;margin-top:2px;transition:all 0.3s ease;" 
                   onmouseover="this.style.transform='scale(1.2)'" 
                   onmouseout="this.style.transform='scale(1)'"></i>
                <div>
                    <div style="font-weight:700;">Kantor</div>
                    <div style="color:#1976d2;font-size:1.08rem;">Jl. Keranji GG. H. MOH NO.60 RT 04/RW 06 Ciganjur</div>
                    <div style="font-size:0.97rem;color:#4b5563;">Buka Senin - Jumat, 9am - 6pm</div>
                </div>
            </div>
            
            <div style="display:flex;align-items:flex-start;gap:16px;transition:all 0.3s ease;padding:12px;border-radius:8px;" 
                 onmouseover="this.style.background='rgba(25,118,210,0.05)'" 
                 onmouseout="this.style.background='transparent'">
                <i class="fa fa-clock" style="font-size:1.5rem;color:#1976d2;margin-top:2px;transition:all 0.3s ease;" 
                   onmouseover="this.style.transform='scale(1.2)'" 
                   onmouseout="this.style.transform='scale(1)'"></i>
                <div>
                    <div style="font-weight:700;">Jam Kerja</div>
                    <div style="color:#1976d2;font-size:1.08rem;">Sen - Jum: 9:00 AM - 6:00 PM</div>
                    <div style="color:#1976d2;font-size:1.08rem;">Sab - Min: 10:00 AM - 4:00 PM</div>
                </div>
            </div>
        </div>
        
        <!-- Form Kontak -->
        <div style="flex:2 1 400px;min-width:340px;max-width:600px;background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.10);padding:32px 28px;transition:all 0.3s ease;transform:translateY(0);" 
             data-aos="fade-left" data-aos-delay="400"
             onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" 
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.10)'">
            
            @if(session('success'))
                <div style="background:#d4edda;color:#155724;padding:12px 18px;border-radius:8px;margin-bottom:18px;text-align:center;font-weight:600;animation:fadeIn 0.5s ease;" data-aos="fade-up">
                    <i class="fa fa-check-circle" style="margin-right:8px;"></i>{{ session('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('kontak.kirim') }}" style="display:flex;flex-direction:column;gap:20px;">
                @csrf
                <div style="display:flex;gap:18px;">
                    <div style="flex:1;display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="100">
                        <label style="font-weight:600;color:#1a237e;">Nama Depan</label>
                        <input type="text" name="nama_depan" placeholder="Masukkan nama depan" 
                               style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                               onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
                    </div>
                    <div style="flex:1;display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="150">
                        <label style="font-weight:600;color:#1a237e;">Nama Belakang</label>
                        <input type="text" name="nama_belakang" placeholder="Masukkan nama belakang" 
                               style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                               onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
                    </div>
                </div>
                
                <div style="display:flex;gap:18px;">
                    <div style="flex:1;display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="200">
                        <label style="font-weight:600;color:#1a237e;">Email</label>
                        <input type="email" name="email" placeholder="Alamat email aktif" 
                               style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                               onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
                    </div>
                    <div style="flex:1;display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="250">
                        <label style="font-weight:600;color:#1a237e;">Telepon</label>
                        <input type="text" name="telepon" placeholder="Nomor telepon" 
                               style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                               onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
                    </div>
                </div>
                
                <div style="display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="300">
                    <label style="font-weight:600;color:#1a237e;">Subjek</label>
                    <select name="subjek" 
                            style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;" 
                            onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                            onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'">
                        <option>Pilih subjek</option>
                        <option>Pemesanan</option>
                        <option>Informasi Mobil</option>
                        <option>Kerjasama</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                
                <div style="display:flex;flex-direction:column;gap:6px;" data-aos="fade-up" data-aos-delay="350">
                    <label style="font-weight:600;color:#1a237e;">Pesan</label>
                    <textarea name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..." 
                              style="width:100%;padding:12px 14px;border-radius:8px;border:1.5px solid #e5e7eb;font-size:1rem;transition:all 0.3s ease;outline:none;background:#f9fafb;resize:vertical;" 
                              onfocus="this.style.borderColor='#1976d2';this.style.background='#fff';this.style.boxShadow='0 0 0 3px rgba(25,118,210,0.1)'" 
                              onblur="this.style.borderColor='#e5e7eb';this.style.background='#f9fafb';this.style.boxShadow='none'"></textarea>
                </div>
                
                <button type="submit" 
                        style="background: linear-gradient(90deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 16px 0; border-radius: 8px; font-size: 1.15rem; font-weight: 700; border: none; cursor: pointer; box-shadow:0 2px 8px rgba(26,35,126,0.08);transition:all 0.3s ease;transform:translateY(0);" 
                        data-aos="fade-up" data-aos-delay="400"
                        onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(26,35,126,0.2)'" 
                        onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(26,35,126,0.08)'">
                    <i class="fa fa-paper-plane" style="margin-right:8px;"></i>Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    <!-- Lokasi Kami Section -->
    <div style="margin:48px 0 32px 0;" data-aos="fade-up" data-aos-delay="100">
        <h2 style="font-size:1.5rem;color:#1a237e;font-weight:800;margin-bottom:18px;" data-aos="fade-up" data-aos-delay="200">Lokasi Kami</h2>
        <div style="background:#fff;border-radius:18px;box-shadow:0 2px 12px rgba(26,35,126,0.08);padding:18px;transition:all 0.3s ease;transform:translateY(0);" 
             data-aos="fade-up" data-aos-delay="300"
             onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" 
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6041.1826364550825!2d106.780116!3d-6.329948!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ef886afbdb09%3A0xd003a0ed5937a958!2sMD%20Rent%20Car%20Ciganjur!5e1!3m2!1sen!2sid!4v1752652016977!5m2!1sen!2sid" 
                    width="100%" height="340" 
                    style="border:0;border-radius:12px;box-shadow:0 2px 16px rgba(0,0,0,0.08);transition:all 0.3s ease;" 
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    onmouseover="this.style.boxShadow='0 4px 20px rgba(0,0,0,0.15)'" 
                    onmouseout="this.style.boxShadow='0 2px 16px rgba(0,0,0,0.08)'"></iframe>
            <div style="margin-top: 0.75rem; font-weight: 500; color: #2563eb; text-align:center;transition:all 0.3s ease;" 
                 onmouseover="this.style.color='#1a237e';this.style.transform='scale(1.05)'" 
                 onmouseout="this.style.color='#2563eb';this.style.transform='scale(1)'">
                <i class="fa fa-map-marker-alt" style="margin-right:8px;"></i>Lokasinya di sini
            </div>
        </div>
    </div>
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .flex-wrap {
        flex-direction: column;
    }
    
    .flex-1, .flex-2 {
        min-width: 100% !important;
        max-width: 100% !important;
    }
}
</style>
@endsection 