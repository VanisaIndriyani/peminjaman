# Sistem Booking MD Rent Car - Penjelasan Lengkap

## Masalah Sebelumnya
Sebelumnya, sistem langsung mengubah status mobil menjadi "dipinjam" saat ada booking, meskipun booking tersebut masih jauh-jauh hari (misal: booking untuk bulan Desember di bulan Juli). Ini menyebabkan:
- User bingung melihat mobil "tidak tersedia" padahal booking masih lama
- Mobil tidak bisa dibooking oleh user lain untuk tanggal yang berbeda
- Status mobil tidak akurat

## Solusi yang Diterapkan

### 1. Status Mobil Tidak Langsung Berubah
**Sebelum:**
```php
// Saat booking langsung ubah status mobil
$mobil->status = 'dipinjam';
$mobil->save();
```

**Sekarang:**
```php
// Booking tanpa mengubah status mobil
Peminjaman::create($data);
// Status mobil tetap 'tersedia' di katalog
```

### 2. Validasi Ketersediaan Berdasarkan Tanggal
Sistem sekarang mengecek ketersediaan berdasarkan tanggal booking:

```php
// Cek apakah mobil tersedia untuk rentang tanggal tertentu
if (!$mobil->isAvailableForDateRange($tanggalPinjam, $tanggalKembali)) {
    return redirect()->back()->with('error', 'Mobil tidak tersedia untuk tanggal yang dipilih.');
}
```

### 3. Method Ketersediaan di Model Mobil
```php
public function isAvailableForDateRange($tanggalPinjam, $tanggalKembali)
{
    // Cek apakah ada peminjaman yang overlap dengan rentang tanggal
    $overlappingPeminjaman = Peminjaman::where('mobil_id', $this->id)
        ->where(function($query) use ($tanggalPinjam, $tanggalKembali) {
            $query->where(function($q) use ($tanggalPinjam, $tanggalKembali) {
                // Peminjaman yang dimulai sebelum tanggal kembali dan berakhir setelah tanggal pinjam
                $q->where('tanggal_pinjam', '<=', $tanggalKembali)
                  ->where('tanggal_kembali', '>=', $tanggalPinjam);
            });
        })
        ->whereIn('status', ['menunggu_pembayaran', 'disetujui', 'dipinjam'])
        ->exists();

    return !$overlappingPeminjaman;
}
```

## Contoh Skenario

### Skenario 1: Booking Jauh-Jauh Hari
1. **Tanggal Hari Ini**: 15 Juli 2024
2. **User A** booking mobil untuk 15-20 Desember 2024
3. **Status Mobil**: Tetap "tersedia" di katalog
4. **User B** bisa booking mobil yang sama untuk tanggal lain (misal: 1-5 Agustus 2024)

### Skenario 2: Booking Tanggal yang Sama
1. **User A** sudah booking mobil untuk 15-20 Desember 2024
2. **User B** mencoba booking mobil yang sama untuk 18-25 Desember 2024
3. **Sistem**: Menolak booking karena ada overlap tanggal
4. **Pesan**: "Mobil tidak tersedia untuk tanggal yang dipilih"

### Skenario 3: Status Mobil Berubah
1. **Admin** menyetujui peminjaman User A
2. **Status Mobil**: Berubah menjadi "dipinjam" di katalog
3. **User lain**: Tidak bisa booking mobil tersebut sampai peminjaman selesai

## Keuntungan Sistem Baru

### 1. Fleksibilitas Booking
- User bisa booking jauh-jauh hari tanpa mempengaruhi ketersediaan mobil untuk tanggal lain
- Sistem mendukung multiple booking untuk mobil yang sama dengan tanggal berbeda

### 2. Status Akurat
- Status mobil di katalog selalu akurat berdasarkan peminjaman yang aktif
- Tidak ada kebingungan user melihat mobil "tidak tersedia" padahal booking masih lama

### 3. Pengalaman User Lebih Baik
- User bisa melihat semua mobil tersedia di katalog
- Validasi ketersediaan hanya saat memilih tanggal
- Pesan error yang jelas jika mobil tidak tersedia

## Maintenance dan Monitoring

### Command Update Status
Untuk memastikan status mobil selalu akurat:
```bash
php artisan mobil:update-status
```

### Status Peminjaman yang Diperhitungkan
Sistem hanya menghitung peminjaman dengan status:
- `menunggu_pembayaran` - Booking baru, belum disetujui admin
- `disetujui` - Booking sudah disetujui admin
- `dipinjam` - Mobil sedang dipinjam

### Status Peminjaman yang Tidak Diperhitungkan
- `ditolak` - Booking ditolak admin
- `kembali` - Peminjaman sudah selesai

## API untuk Integrasi

### Cek Ketersediaan
```http
POST /check-availability
Content-Type: application/json

{
    "mobil_id": 1,
    "tanggal_pinjam": "2024-12-15",
    "tanggal_kembali": "2024-12-20"
}
```

Response:
```json
{
    "available": true,
    "message": "Mobil tersedia untuk tanggal yang dipilih"
}
```

## Kesimpulan
Sistem booking yang baru memberikan:
- **Fleksibilitas** untuk booking jauh-jauh hari
- **Akurasi** status mobil di katalog
- **Pengalaman user** yang lebih baik
- **Maintenance** yang mudah dengan command otomatis

Sistem ini mengatasi masalah yang sering ditanyakan penguji tentang status mobil yang tidak akurat saat ada booking jauh-jauh hari. 