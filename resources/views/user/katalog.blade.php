@extends('user.layouts.app')

@section('content')
<div style="max-width:1200px;margin:0 auto;padding:32px 20px;">
    <div style="display:flex;align-items:center;margin-bottom:32px;">
        <i class="fa fa-car" style="margin-right: 16px; color: #1976d2;"></i>Katalog Mobil
    </div>

    @if($mobils->count() > 0)
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;">
            @foreach($mobils as $mobil)
            <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);overflow:hidden;transition:all 0.3s ease;transform:translateY(0);" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 12px 40px rgba(26,35,126,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(26,35,126,0.08)'">
                <div style="position:relative;height:200px;overflow:hidden;">
                    @if($mobil->foto)
                        <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->nama }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);display:flex;align-items:center;justify-content:center;color:#fff;font-size:3rem;">
                            <i class="fa fa-car"></i>
                        </div>
                    @endif
                    <div style="position:absolute;top:12px;right:12px;background:#22b6ff;color:#fff;padding:6px 12px;border-radius:20px;font-size:0.9rem;font-weight:600;">
                        Tersedia
                    </div>
                </div>
                <div style="padding:24px;">
                    <h3 style="font-size:1.3rem;font-weight:700;margin-bottom:8px;color:#222;">{{ $mobil->nama }}</h3>
                    <div style="color:#6b7280;margin-bottom:12px;">
                        <div style="margin-bottom:4px;"><i class="fa fa-tag" style="margin-right:8px;color:#1976d2;"></i>{{ $mobil->merk }}</div>
                        <div style="margin-bottom:4px;"><i class="fa fa-calendar" style="margin-right:8px;color:#1976d2;"></i>{{ $mobil->tahun }}</div>
                        <div style="margin-bottom:4px;"><i class="fa fa-id-card" style="margin-right:8px;color:#1976d2;"></i>{{ $mobil->plat_nomor }}</div>
                    </div>
                    <div style="font-size:1.4rem;font-weight:800;color:#1976d2;margin-bottom:16px;">
                        Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}/hari
                    </div>
                    <a href="{{ url('/peminjaman/create?mobil=' . $mobil->id) }}" class="btn-book-mobil" data-mobil-id="{{ $mobil->id }}" data-mobil-nama="{{ $mobil->nama }}" style="background:#1976d2;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;display:inline-block;font-weight:600;transition:all 0.3s ease;width:100%;text-align:center;" onmouseover="this.style.background='#1565c0'" onmouseout="this.style.background='#1976d2'">
                        <i class="fa fa-calendar-plus" style="margin-right:8px;"></i>Booking Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:64px 20px;">
            <i class="fa fa-car" style="font-size:4rem;color:#ccc;margin-bottom:16px;"></i>
            <h3 style="font-size:1.5rem;color:#666;margin-bottom:8px;">Belum Ada Mobil</h3>
            <p style="color: #999; font-size: 1.1rem; line-height: 1.6;">Mobil akan segera ditambahkan ke katalog</p>
        </div>
    @endif
</div>

<!-- Modal Cek Ketersediaan -->
<div id="availabilityModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:32px;max-width:500px;width:90%;max-height:90vh;overflow-y:auto;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
            <h3 style="font-size:1.4rem;font-weight:700;color:#222;margin:0;">Cek Ketersediaan Mobil</h3>
            <button onclick="closeAvailabilityModal()" style="background:none;border:none;font-size:1.5rem;color:#666;cursor:pointer;">&times;</button>
        </div>
        
        <div id="modalContent">
            <p style="color:#666;margin-bottom:20px;">Pilih tanggal untuk mengecek ketersediaan mobil:</p>
            
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;color:#333;">Tanggal Mulai:</label>
                <input type="date" id="tanggalPinjam" style="width:100%;padding:12px;border:2px solid #e5e7eb;border-radius:8px;font-size:1rem;" min="{{ date('Y-m-d') }}">
            </div>
            
            <div style="margin-bottom:24px;">
                <label style="display:block;margin-bottom:8px;font-weight:600;color:#333;">Tanggal Kembali:</label>
                <input type="date" id="tanggalKembali" style="width:100%;padding:12px;border:2px solid #e5e7eb;border-radius:8px;font-size:1rem;" min="{{ date('Y-m-d') }}">
            </div>
            
            <div id="availabilityResult" style="display:none;margin-bottom:20px;padding:16px;border-radius:8px;"></div>
            
            <div style="display:flex;gap:12px;">
                <button onclick="checkAvailability()" style="background:#1976d2;color:#fff;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;flex:1;">Cek Ketersediaan</button>
                <button onclick="proceedToBooking()" id="btnProceed" style="background:#22c55e;color:#fff;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;flex:1;display:none;">Lanjut Booking</button>
            </div>
        </div>
    </div>
</div>

<script>
let selectedMobilId = null;
let selectedMobilNama = null;

// Event listener untuk tombol booking
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-book-mobil').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            selectedMobilId = this.getAttribute('data-mobil-id');
            selectedMobilNama = this.getAttribute('data-mobil-nama');
            openAvailabilityModal();
        });
    });
});

function openAvailabilityModal() {
    document.getElementById('availabilityModal').style.display = 'flex';
    document.getElementById('availabilityResult').style.display = 'none';
    document.getElementById('btnProceed').style.display = 'none';
    document.getElementById('tanggalPinjam').value = '';
    document.getElementById('tanggalKembali').value = '';
}

function closeAvailabilityModal() {
    document.getElementById('availabilityModal').style.display = 'none';
}

function checkAvailability() {
    const tanggalPinjam = document.getElementById('tanggalPinjam').value;
    const tanggalKembali = document.getElementById('tanggalKembali').value;
    
    if (!tanggalPinjam || !tanggalKembali) {
        alert('Silakan pilih tanggal mulai dan tanggal kembali');
        return;
    }
    
    if (tanggalPinjam > tanggalKembali) {
        alert('Tanggal kembali harus setelah tanggal mulai');
        return;
    }
    
    // Show loading
    const resultDiv = document.getElementById('availabilityResult');
    resultDiv.style.display = 'block';
    resultDiv.innerHTML = '<div style="text-align:center;color:#666;"><i class="fa fa-spinner fa-spin"></i> Mengecek ketersediaan...</div>';
    
    // Send AJAX request
    fetch('/check-availability', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            mobil_id: selectedMobilId,
            tanggal_pinjam: tanggalPinjam,
            tanggal_kembali: tanggalKembali
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.available) {
            resultDiv.innerHTML = `
                <div style="background:#d1fae5;border:1px solid #10b981;color:#065f46;padding:16px;border-radius:8px;">
                    <i class="fa fa-check-circle"></i> <strong>Mobil Tersedia!</strong><br>
                    ${selectedMobilNama} tersedia untuk tanggal ${tanggalPinjam} s/d ${tanggalKembali}
                </div>
            `;
            document.getElementById('btnProceed').style.display = 'block';
        } else {
            resultDiv.innerHTML = `
                <div style="background:#fee2e2;border:1px solid #ef4444;color:#991b1b;padding:16px;border-radius:8px;">
                    <i class="fa fa-times-circle"></i> <strong>Mobil Tidak Tersedia</strong><br>
                    ${selectedMobilNama} sudah dibooking untuk tanggal tersebut. Silakan pilih tanggal lain.
                </div>
            `;
            document.getElementById('btnProceed').style.display = 'none';
        }
    })
    .catch(error => {
        resultDiv.innerHTML = `
            <div style="background:#fee2e2;border:1px solid #ef4444;color:#991b1b;padding:16px;border-radius:8px;">
                <i class="fa fa-exclamation-triangle"></i> <strong>Error</strong><br>
                Terjadi kesalahan saat mengecek ketersediaan. Silakan coba lagi.
            </div>
        `;
        document.getElementById('btnProceed').style.display = 'none';
    });
}

function proceedToBooking() {
    const tanggalPinjam = document.getElementById('tanggalPinjam').value;
    const tanggalKembali = document.getElementById('tanggalKembali').value;
    
    // Redirect ke halaman booking dengan parameter
    window.location.href = `/peminjaman/create?mobil=${selectedMobilId}&tanggal_pinjam=${tanggalPinjam}&tanggal_kembali=${tanggalKembali}`;
}

// Close modal when clicking outside
document.getElementById('availabilityModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAvailabilityModal();
    }
});
</script>

<style>
/* Katalog grid adjustments */
@media (max-width: 768px) {
    .katalog-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }
}

/* Katalog grid adjustments for mobile */
@media (max-width: 480px) {
    .katalog-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

/* Modal animations */
#availabilityModal {
    animation: fadeIn 0.3s ease;
}

#availabilityModal > div {
    animation: slideIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>
@endsection 