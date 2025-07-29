<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Sistem Peminjaman Mobil MD Rent Car

## Deskripsi
Sistem peminjaman mobil untuk MD Rent Car yang memungkinkan user untuk melakukan booking mobil secara online.

## Fitur Utama

### Sistem Booking yang Diperbaiki
Sistem booking telah diperbaiki untuk mengatasi masalah status mobil yang langsung berubah menjadi "tidak tersedia" saat ada booking jauh-jauh hari.

#### Perubahan Utama:
1. **Status Mobil Tidak Langsung Berubah**: Mobil tetap "tersedia" di katalog meskipun ada booking
2. **Validasi Berdasarkan Tanggal**: Ketersediaan mobil dicek berdasarkan tanggal booking yang dipilih
3. **Status Dinamis**: Status mobil hanya berubah saat ada peminjaman yang aktif

#### Cara Kerja:
- User dapat melihat semua mobil di katalog dengan status "tersedia"
- Saat user memilih tanggal booking, sistem akan mengecek apakah mobil tersedia di tanggal tersebut
- Jika ada booking yang overlap dengan tanggal yang dipilih, mobil akan ditandai sebagai "tidak tersedia"
- Status mobil di katalog hanya berubah menjadi "dipinjam" jika ada peminjaman yang aktif (disetujui atau sedang dipinjam)

#### Keuntungan:
- User tidak bingung melihat mobil "tidak tersedia" padahal booking masih lama
- Sistem lebih fleksibel untuk booking jauh-jauh hari
- Status mobil selalu akurat berdasarkan peminjaman yang aktif

### Command untuk Maintenance
Untuk memastikan status mobil selalu akurat, gunakan command:
```bash
php artisan mobil:update-status
```

Command ini akan mengupdate status semua mobil berdasarkan peminjaman yang aktif.

## Teknologi
- Laravel 10
- PHP 8.1+
- MySQL
- Bootstrap
- Font Awesome

## Instalasi
1. Clone repository
2. Install dependencies: `composer install`
3. Copy `.env.example` ke `.env` dan konfigurasi database
4. Generate key: `php artisan key:generate`
5. Jalankan migration: `php artisan migrate`
6. Jalankan seeder: `php artisan db:seed`
7. Serve aplikasi: `php artisan serve`

## Struktur Database

### Tabel Mobils
- `id` - Primary key
- `nama` - Nama mobil
- `merk` - Merk mobil
- `tahun` - Tahun produksi
- `plat_nomor` - Nomor plat (unique)
- `harga_sewa` - Harga sewa per hari
- `status` - Status mobil (tersedia/dipinjam)
- `foto` - Foto mobil

### Tabel Peminjamans
- `id` - Primary key
- `user_id` - Foreign key ke users
- `mobil_id` - Foreign key ke mobils
- `tanggal_pinjam` - Tanggal mulai pinjam
- `tanggal_kembali` - Tanggal kembali
- `status` - Status peminjaman (menunggu_pembayaran/disetujui/ditolak/dipinjam/kembali)
- `diskon` - Diskon yang diberikan
- `total_harga` - Total harga setelah diskon
- Berkas: `foto_diri`, `ktp`, `kk`, `sim_a`, `ktp_penjamin`

## API Endpoints

### Cek Ketersediaan Mobil
```
POST /check-availability
```
Body:
- `mobil_id` - ID mobil
- `tanggal_pinjam` - Tanggal mulai (YYYY-MM-DD)
- `tanggal_kembali` - Tanggal kembali (YYYY-MM-DD)

Response:
```json
{
    "available": true/false,
    "message": "Pesan status ketersediaan"
}
```

## Kontribusi
Silakan buat pull request untuk kontribusi.

## Lisensi
MIT License
