@extends('user.layouts.app')

@section('content')
<div style="max-width:1200px;margin:0 auto;padding:32px 20px;">
    <div style="display:flex;align-items:center;margin-bottom:32px;background:linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);padding:20px 24px;border-radius:16px;border-left:4px solid #1976d2;box-shadow:0 2px 8px rgba(26,35,126,0.08);">
        <div style="background:#1976d2;color:#fff;padding:12px;border-radius:12px;margin-right:16px;box-shadow:0 4px 12px rgba(25,118,210,0.3);">
            <i class="fa fa-car" style="font-size:1.5rem;"></i>
        </div>
        <div>
            <h1 style="font-size:2rem;font-weight:800;color:#1a237e;margin:0;line-height:1.2;">Katalog Mobil</h1>
            <p style="color:#6b7280;margin:4px 0 0 0;font-size:1rem;">Pilih mobil premium untuk perjalanan Anda</p>
        </div>
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
                    <a href="{{ url('/peminjaman/create?mobil=' . $mobil->id) }}" class="btn-book-mobil" data-mobil-id="{{ $mobil->id }}" data-mobil-nama="{{ $mobil->nama }}" style="background:#1976d2;color:#fff;padding:14px 20px;border-radius:10px;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:8px;font-weight:600;font-size:1rem;transition:all 0.3s ease;width:100%;box-sizing:border-box;border:none;cursor:pointer;min-height:48px;" onmouseover="this.style.background='#1565c0';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1976d2';this.style.transform='translateY(0)'">
                        <i class="fa fa-calendar-plus" style="font-size:1.1rem;"></i>
                        <span>Booking Sekarang</span>
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
            <!-- Login Required Message -->
            <div id="loginRequired" style="display:none;text-align:center;padding:20px;">
                <i class="fa fa-user-lock" style="font-size:3rem;color:#1976d2;margin-bottom:16px;"></i>
                <h4 style="color:#1a237e;font-size:1.2rem;margin-bottom:12px;">Login Diperlukan</h4>
                <p style="color:#666;margin-bottom:20px;line-height:1.6;">Untuk melakukan booking mobil, Anda harus login terlebih dahulu.</p>
                <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                    <a href="{{ url('/login') }}" style="background:#1976d2;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;">
                        <i class="fa fa-sign-in-alt"></i>
                        <span>Login Sekarang</span>
                    </a>
                    <a href="{{ url('/register') }}" style="background:#22c55e;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;display:inline-flex;align-items:center;gap:8px;">
                        <i class="fa fa-user-plus"></i>
                        <span>Daftar</span>
                    </a>
                </div>
            </div>
            
            <!-- Availability Check Form -->
            <div id="availabilityForm" style="display:none;">
                <p style="color:#666;margin-bottom:20px;">Pilih tanggal untuk mengecek ketersediaan mobil:</p>
                
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:8px;font-weight:600;color:#333;">Tanggal Mulai:</label>
                    <input type="date" id="tanggalPinjam" style="width:100%;padding:12px;border:2px solid #e5e7eb;border-radius:8px;font-size:1rem;box-sizing:border-box;" min="{{ date('Y-m-d') }}">
                </div>
                
                <div style="margin-bottom:24px;">
                    <label style="display:block;margin-bottom:8px;font-weight:600;color:#333;">Tanggal Kembali:</label>
                    <input type="date" id="tanggalKembali" style="width:100%;padding:12px;border:2px solid #e5e7eb;border-radius:8px;font-size:1rem;box-sizing:border-box;" min="{{ date('Y-m-d') }}">
                </div>
                
                <div id="availabilityResult" style="display:none;margin-bottom:20px;padding:16px;border-radius:8px;"></div>
                
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button onclick="checkAvailability()" style="background:#1976d2;color:#fff;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;flex:1;min-width:120px;display:flex;align-items:center;justify-content:center;gap:8px;">
                        <i class="fa fa-search"></i>
                        <span>Cek Ketersediaan</span>
                    </button>
                    <button onclick="proceedToBooking()" id="btnProceed" style="background:#22c55e;color:#fff;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer;flex:1;min-width:120px;display:none;align-items:center;justify-content:center;gap:8px;">
                        <i class="fa fa-arrow-right"></i>
                        <span>Lanjut Booking</span>
                    </button>
                </div>
                
                <!-- Debug buttons for hosting testing -->
                <div style="margin-top:16px;padding-top:16px;border-top:1px solid #e5e7eb;">
                    <p style="color:#666;font-size:0.9rem;margin-bottom:8px;">Debug (untuk testing hosting):</p>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <button onclick="testSimpleRoute()" style="background:#6b7280;color:#fff;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;font-size:0.8rem;">
                            Test Route
                        </button>
                        <button onclick="testMobilRoute()" style="background:#6b7280;color:#fff;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;font-size:0.8rem;">
                            Test Mobil
                        </button>
                        <button onclick="testGetAvailability()" style="background:#6b7280;color:#fff;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;font-size:0.8rem;">
                            Test GET
                        </button>
                        <button onclick="testDirectPHP()" style="background:#dc2626;color:#fff;padding:8px 16px;border:none;border-radius:4px;cursor:pointer;font-size:0.8rem;">
                            Test PHP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedMobilId = null;
let selectedMobilNama = null;
const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

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
    
    // Tampilkan form yang sesuai berdasarkan status login
    if (isLoggedIn) {
        document.getElementById('loginRequired').style.display = 'none';
        document.getElementById('availabilityForm').style.display = 'block';
    } else {
        document.getElementById('loginRequired').style.display = 'block';
        document.getElementById('availabilityForm').style.display = 'none';
    }
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
    
    // Get CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    
    const requestData = {
        mobil_id: selectedMobilId,
        tanggal_pinjam: tanggalPinjam,
        tanggal_kembali: tanggalKembali
    };
    
    console.log('Checking availability with data:', requestData);
    
    // Try main route first
    function tryMainRoute() {
        return fetch('/check-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        });
    }
    
    // Try fallback route
    function tryFallbackRoute() {
        return fetch('/api/check-availability', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        });
    }
    
    // Try form data route (lebih kompatibel dengan hosting)
    function tryFormDataRoute() {
        const formData = new FormData();
        formData.append('mobil_id', requestData.mobil_id);
        formData.append('tanggal_pinjam', requestData.tanggal_pinjam);
        formData.append('tanggal_kembali', requestData.tanggal_kembali);
        
        return fetch('/check-availability-form', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        });
    }
    
    // Try GET route as final fallback
    function tryGetRoute() {
        const params = new URLSearchParams({
            mobil_id: requestData.mobil_id,
            tanggal_pinjam: requestData.tanggal_pinjam,
            tanggal_kembali: requestData.tanggal_kembali
        });
        return fetch(`/test-availability?${params}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });
    }
    
    // Try direct PHP file (bypass Laravel routing)
    function tryDirectPHP() {
        const params = new URLSearchParams({
            mobil_id: requestData.mobil_id,
            tanggal_pinjam: requestData.tanggal_pinjam,
            tanggal_kembali: requestData.tanggal_kembali
        });
        return fetch(`/availability-check.php?${params}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });
    }
    
    // Try routes in sequence with better error handling
    tryMainRoute()
        .then(response => {
            console.log('Main route response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .catch(error => {
            console.log('Main route failed:', error.message);
            return tryFallbackRoute()
                .then(response => {
                    console.log('Fallback route response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .catch(error2 => {
                    console.log('Fallback route failed:', error2.message);
                    return tryFormDataRoute()
                        .then(response => {
                            console.log('Form data route response status:', response.status);
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .catch(error3 => {
                            console.log('Form data route failed:', error3.message);
                            return tryGetRoute()
                                .then(response => {
                                    console.log('GET route response status:', response.status);
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! status: ${response.status}`);
                                    }
                                    return response.json();
                                })
                                .catch(error4 => {
                                    console.log('GET route failed:', error4.message);
                                    return tryDirectPHP()
                                        .then(response => {
                                            console.log('Direct PHP response status:', response.status);
                                            if (!response.ok) {
                                                throw new Error(`HTTP error! status: ${response.status}`);
                                            }
                                            return response.json();
                                        });
                                });
                        });
                });
        })
        .then(data => {
            if (data.available) {
                resultDiv.innerHTML = `
                    <div style="background:#d1fae5;border:1px solid #10b981;color:#065f46;padding:16px;border-radius:8px;">
                        <i class="fa fa-check-circle"></i> <strong>Mobil Tersedia!</strong><br>
                        ${selectedMobilNama} tersedia untuk tanggal ${tanggalPinjam} s/d ${tanggalKembali}
                    </div>
                `;
                document.getElementById('btnProceed').style.display = 'flex';
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
            console.error('All routes failed:', error);
            resultDiv.innerHTML = `
                <div style="background:#fef3c7;border:1px solid #f59e0b;color:#92400e;padding:16px;border-radius:8px;">
                    <i class="fa fa-exclamation-triangle"></i> <strong>Terjadi Kesalahan</strong><br>
                    Sistem sedang mengalami gangguan. Silakan coba lagi dalam beberapa saat atau hubungi admin.
                    <br><br>
                    <small>Error: ${error.message}</small>
                    <br><br>
                    <button onclick="checkAvailability()" style="background:#f59e0b;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer;font-size:0.9rem;">
                        <i class="fa fa-refresh"></i> Coba Lagi
                    </button>
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

// Debug functions for hosting testing
function testSimpleRoute() {
    // Try Laravel route first
    fetch('/test-simple')
        .then(response => response.json())
        .then(data => {
            console.log('Test Laravel route:', data);
            alert('Test Laravel Route: ' + JSON.stringify(data, null, 2));
        })
        .catch(error => {
            console.log('Laravel route failed, trying direct PHP...');
            // Try direct PHP file
            fetch('/test-simple.php')
                .then(response => response.json())
                .then(data => {
                    console.log('Test direct PHP:', data);
                    alert('Test Direct PHP: ' + JSON.stringify(data, null, 2));
                })
                .catch(error2 => {
                    console.error('Both routes failed:', error2);
                    alert('Both Routes Failed: ' + error2.message);
                });
        });
}

function testMobilRoute() {
    fetch('/test-mobil')
        .then(response => response.json())
        .then(data => {
            console.log('Test mobil route:', data);
            alert('Test Mobil: ' + JSON.stringify(data, null, 2));
        })
        .catch(error => {
            console.error('Test mobil route error:', error);
            alert('Test Mobil Error: ' + error.message);
        });
}

function testGetAvailability() {
    const params = new URLSearchParams({
        mobil_id: selectedMobilId || '1',
        tanggal_pinjam: '2025-01-01',
        tanggal_kembali: '2025-01-02'
    });
    
    fetch(`/test-availability?${params}`)
        .then(response => response.json())
        .then(data => {
            console.log('Test GET availability:', data);
            alert('Test GET: ' + JSON.stringify(data, null, 2));
        })
        .catch(error => {
            console.error('Test GET availability error:', error);
            alert('Test GET Error: ' + error.message);
        });
}

function testDirectPHP() {
    const params = new URLSearchParams({
        mobil_id: selectedMobilId || '1',
        tanggal_pinjam: '2025-01-01',
        tanggal_kembali: '2025-01-02'
    });
    
    fetch(`/availability-check.php?${params}`)
        .then(response => response.json())
        .then(data => {
            console.log('Test direct PHP availability:', data);
            alert('Test Direct PHP: ' + JSON.stringify(data, null, 2));
        })
        .catch(error => {
            console.error('Test direct PHP error:', error);
            alert('Test Direct PHP Error: ' + error.message);
        });
}
</script>

<style>
/* Katalog grid adjustments */
@media (max-width: 768px) {
    .katalog-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }
    
    /* Mobile-specific button styling */
    .btn-book-mobil {
        padding: 16px 20px !important;
        font-size: 1rem !important;
        min-height: 52px !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(25,118,210,0.2) !important;
    }
    
    .btn-book-mobil:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 20px rgba(25,118,210,0.3) !important;
    }
    
    .btn-book-mobil:active {
        transform: translateY(-1px) !important;
    }
    
    /* Mobile header styling */
    .katalog-header {
        padding: 16px 20px !important;
        margin-bottom: 24px !important;
    }
    
    .katalog-header h1 {
        font-size: 1.6rem !important;
    }
    
    .katalog-header p {
        font-size: 0.9rem !important;
    }
}

/* Katalog grid adjustments for mobile */
@media (max-width: 480px) {
    .katalog-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    /* Extra mobile styling */
    .btn-book-mobil {
        padding: 18px 24px !important;
        font-size: 1.1rem !important;
        min-height: 56px !important;
        font-weight: 700 !important;
    }
    
    /* Modal adjustments for mobile */
    #availabilityModal > div {
        width: 95% !important;
        max-width: none !important;
        margin: 20px;
        padding: 24px !important;
    }
    
    /* Button group in modal */
    #availabilityForm > div:last-child {
        flex-direction: column !important;
        gap: 12px !important;
    }
    
    #availabilityForm > div:last-child > button {
        width: 100% !important;
        min-width: auto !important;
        padding: 16px 24px !important;
        font-size: 1rem !important;
    }
    
    /* Extra mobile header styling */
    .katalog-header {
        padding: 12px 16px !important;
        margin-bottom: 20px !important;
    }
    
    .katalog-header h1 {
        font-size: 1.4rem !important;
    }
    
    .katalog-header p {
        font-size: 0.85rem !important;
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

/* Button hover effects */
.btn-book-mobil {
    position: relative;
    overflow: hidden;
}

.btn-book-mobil::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-book-mobil:hover::before {
    left: 100%;
}
</style>
@endsection 