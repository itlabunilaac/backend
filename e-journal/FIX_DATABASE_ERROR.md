# 🚨 SOLUSI ERROR "could not find driver"

## Masalah
Error `could not find driver (Connection: sqlite)` terjadi karena SQLite extension tidak tersedia di instalasi PHP Anda.

## ✅ SOLUSI CEPAT

### 1. Aktifkan SQLite di PHP (PALING MUDAH)

**Langkah 1: Cari file php.ini**
```bash
php --ini
```

**Langkah 2: Edit php.ini**
Buka file php.ini dan hapus tanda `;` (uncomment) di baris berikut:
```ini
extension=pdo_sqlite
extension=sqlite3
```

**Langkah 3: Restart Apache/Server**
- Jika pakai XAMPP: restart Apache
- Jika pakai Laragon: restart Laragon
- Jika pakai `php artisan serve`: stop dan start lagi

### 2. ATAU Ganti ke MySQL (Jika Laragon sudah running)

**Update file .env:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_journal
DB_USERNAME=root
DB_PASSWORD=
```

**Buat database di MySQL:**
```sql
CREATE DATABASE e_journal;
```

## 🚀 SETELAH DATABASE FIX

```bash
# 1. Clear cache
php artisan config:clear
php artisan cache:clear

# 2. Jalankan migrasi
php artisan migrate:fresh --seed

# 3. Start server
php artisan serve

# 4. Test API
curl http://127.0.0.1:8000/api/test
```

## 📍 LOKASI FILES PENTING

- **API Routes:** `routes/api.php`
- **Models:** `app/Models/Admin.php`, `app/Models/Jurnal.php`
- **Controllers:** `app/Http/Controllers/Api/`
- **Migrations:** `database/migrations/`
- **Config:** `config/auth.php` (sudah di-update untuk guard admin)

## 🧪 TEST ENDPOINTS

### Public Endpoints:
```bash
GET  /api/test                    # Test connection
GET  /api/jurnal                  # List all journals
GET  /api/jurnal?search=keyword   # Search journals
POST /api/admin/login             # Admin login
```

### Admin Endpoints (perlu token):
```bash
POST /api/admin/jurnal            # Create journal
PUT  /api/admin/jurnal/{id}       # Update journal
DELETE /api/admin/jurnal/{id}     # Delete journal
```

## 💡 LOGIN ADMIN DEFAULT

```json
{
    "login": "admin@example.com",
    "password": "password"
}
```

API sudah COMPLETE dan siap pakai! Hanya perlu fix database driver saja.

## 🔧 Jika Masih Error

1. **Cek PHP Extensions:**
   ```bash
   php -m | findstr -i "sqlite\|mysql\|pdo"
   ```

2. **Install PHP Extensions** (jika tidak ada):
   - Download PHP dengan extensions
   - Atau gunakan XAMPP/Laragon yang sudah include extensions

3. **Alternatif: Gunakan Docker**
   ```dockerfile
   FROM php:8.2-apache
   RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite
   ```
