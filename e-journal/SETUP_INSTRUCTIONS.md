# SETUP MANUAL UNTUK E-JOURNAL PROJECT

## Langkah-langkah Setup:

### 1. Pastikan Laragon sudah running
- Buka Laragon
- Start All Services (Apache & MySQL)

### 2. Install Composer Dependencies
Buka Command Prompt (cmd) dan jalankan:

```cmd
cd /d "c:\laragon\www\backend-1\e-journal"
c:\laragon\bin\composer\composer.bat install
```

Jika perintah di atas tidak berhasil, coba alternatif berikut:

```cmd
cd /d "c:\laragon\www\backend-1\e-journal"
c:\laragon\bin\php\php.exe c:\laragon\bin\composer\composer.phar install
```

### 3. Generate Application Key
Setelah vendor terinstall, generate APP_KEY:

```cmd
cd /d "c:\laragon\www\backend-1\e-journal"
c:\laragon\bin\php\php.exe artisan key:generate
```

### 4. Setup Database
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Create database baru dengan nama: `e_journal`
3. Import file database jika ada di folder `database/`

### 5. Run Migrations
```cmd
cd /d "c:\laragon\www\backend-1\e-journal"
c:\laragon\bin\php\php.exe artisan migrate
```

### 6. Seed Database (opsional)
```cmd
cd /d "c:\laragon\www\backend-1\e-journal"
c:\laragon\bin\php\php.exe artisan db:seed
```

### 7. Test Project
Akses: http://localhost/backend-1/e-journal/public

## Konfigurasi Sudah Dibuat:

✅ File .env sudah dibuat dengan konfigurasi MySQL untuk Laragon
✅ Database connection sudah diset ke MySQL
✅ APP_KEY sudah diset (tapi sebaiknya generate ulang dengan artisan)

## Troubleshooting:

Jika masih ada masalah dengan composer, coba:
1. Pastikan Laragon PATH sudah ditambahkan
2. Restart Command Prompt
3. Atau gunakan Terminal Laragon (klik Terminal di Laragon GUI)
