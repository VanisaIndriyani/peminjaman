# 🔧 Troubleshooting Hosting - MD Rent Car

## 🚨 **Masalah: Error Cek Ketersediaan di Hosting**

### **Gejala:**
- Modal cek ketersediaan menampilkan error
- AJAX request gagal
- Berfungsi normal di local, tapi error di hosting

### **Penyebab Umum:**

#### **1. CSRF Token Issues**
```bash
# Di hosting, CSRF token mungkin tidak ter-generate dengan benar
# Solusi: Pastikan session dan CSRF token berfungsi
```

#### **2. Route Not Found**
```bash
# Hosting mungkin tidak mendukung route POST dengan benar
# Solusi: Gunakan route fallback /api/check-availability
```

#### **3. File Permissions**
```bash
# File .htaccess atau storage tidak memiliki permission yang benar
# Solusi: Set permission 755 untuk folder, 644 untuk file
```

#### **4. PHP Version Mismatch**
```bash
# Hosting menggunakan PHP versi yang berbeda
# Solusi: Pastikan PHP 8.0+ dan ekstensi yang diperlukan
```

## 🛠️ **Solusi yang Diterapkan:**

### **1. Error Handling yang Lebih Baik**
```javascript
// JavaScript dengan fallback route
function checkAvailability() {
    // Try main route first
    tryMainRoute()
        .catch(error => {
            // If main route fails, try fallback
            return tryFallbackRoute();
        })
        .then(data => {
            // Handle response
        });
}
```

### **2. Route Fallback**
```php
// Route utama dengan CSRF
Route::post('/check-availability', function (Request $request) {
    // Main route logic
});

// Route fallback tanpa CSRF
Route::post('/api/check-availability', function (Request $request) {
    // Same logic, no CSRF required
});
```

### **3. Updated .htaccess**
```apache
# Handle CORS and routing properly
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

## 🔍 **Cara Debug:**

### **1. Cek Browser Console**
```javascript
// Buka Developer Tools > Console
// Lihat error yang muncul saat klik "Cek Ketersediaan"
```

### **2. Cek Network Tab**
```javascript
// Buka Developer Tools > Network
// Lihat request yang dikirim dan response yang diterima
```

### **3. Cek Laravel Logs**
```bash
# Cek file storage/logs/laravel.log
# Lihat error yang terjadi di backend
```

## 📋 **Checklist Hosting:**

### **✅ Konfigurasi Server**
- [ ] PHP 8.0 atau lebih tinggi
- [ ] mod_rewrite enabled
- [ ] File permissions benar (755/644)
- [ ] .htaccess berfungsi

### **✅ Laravel Configuration**
- [ ] APP_KEY sudah di-set
- [ ] APP_ENV=production
- [ ] APP_DEBUG=false
- [ ] Database connection benar

### **✅ File Upload**
- [ ] storage/app/public sudah di-link
- [ ] storage/logs writable
- [ ] bootstrap/cache writable

## 🚀 **Deployment Checklist:**

### **1. Upload Files**
```bash
# Upload semua file ke hosting
# Pastikan struktur folder benar
```

### **2. Set Permissions**
```bash
chmod 755 storage/
chmod 755 bootstrap/cache/
chmod 644 .env
```

### **3. Run Commands**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **4. Test Routes**
```bash
# Test route utama
curl -X POST https://yourdomain.com/check-availability

# Test route fallback
curl -X POST https://yourdomain.com/api/check-availability
```

## 🎯 **Solusi Cepat:**

### **Jika Masih Error:**

#### **1. Gunakan Route Fallback**
- Sistem akan otomatis mencoba `/api/check-availability` jika route utama gagal

#### **2. Disable CSRF untuk API**
```php
// Di app/Http/Middleware/VerifyCsrfToken.php
protected $except = [
    'api/*'
];
```

#### **3. Check Hosting Support**
- Hubungi provider hosting untuk memastikan mendukung Laravel
- Minta bantuan untuk konfigurasi .htaccess

## 📞 **Support:**

### **Jika Masih Bermasalah:**
1. **Cek error di browser console**
2. **Cek Laravel logs di hosting**
3. **Test route manual dengan Postman/curl**
4. **Hubungi admin hosting**

### **Informasi yang Diperlukan:**
- URL hosting
- Error message lengkap
- Browser yang digunakan
- Screenshot error

---

**Dengan solusi ini, sistem akan lebih robust dan dapat menangani berbagai konfigurasi hosting! 🎉** 