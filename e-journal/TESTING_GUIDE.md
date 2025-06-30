# Testing E-Journal API

## Langkah-langkah Testing:

### 1. Jalankan Server Laravel
```bash
cd c:\laragon\www\backend\e-journal
php artisan serve
```
Server akan berjalan di: http://127.0.0.1:8000

### 2. Test Endpoint API dengan curl atau Postman

#### Test Connection
```bash
curl http://127.0.0.1:8000/api/test
```

#### Test Get All Jurnal
```bash
curl http://127.0.0.1:8000/api/jurnal
```

#### Test Admin Login
```bash
curl -X POST http://127.0.0.1:8000/api/admin/login \
-H "Content-Type: application/json" \
-d '{
    "login": "admin@example.com",
    "password": "password"
}'
```

#### Test Get Jurnal dengan Search
```bash
curl "http://127.0.0.1:8000/api/jurnal?search=machine"
```

#### Test Get Jurnal dengan Filter Subject
```bash
curl "http://127.0.0.1:8000/api/jurnal?subject=Teknologi Informasi"
```

#### Test Get Jurnal dengan Sort by Views
```bash
curl "http://127.0.0.1:8000/api/jurnal?sort_by=views&sort_order=desc"
```

#### Test Get Jurnal by ID (increment views)
```bash
curl http://127.0.0.1:8000/api/jurnal/1
```

### 3. Test dengan Authorization (Admin Only)

Pertama login untuk mendapatkan token:
```bash
curl -X POST http://127.0.0.1:8000/api/admin/login \
-H "Content-Type: application/json" \
-d '{
    "login": "admin@example.com",
    "password": "password"
}'
```

Gunakan token dari response untuk request yang memerlukan auth:

#### Test Create Jurnal
```bash
curl -X POST http://127.0.0.1:8000/api/admin/jurnal \
-H "Authorization: Bearer YOUR_TOKEN_HERE" \
-H "Content-Type: application/json" \
-d '{
    "judul": "Test Jurnal API",
    "deskripsi": "Ini adalah test jurnal yang dibuat melalui API",
    "akreditasi": "Sinta 1",
    "link_akreditasi": "https://sinta.ristekbrin.go.id",
    "subject": "Teknologi Informasi",
    "penerbit": "Test Publisher",
    "link_penerbit": "https://example.com/publisher"
}'
```

#### Test Update Jurnal
```bash
curl -X PUT http://127.0.0.1:8000/api/admin/jurnal/1 \
-H "Authorization: Bearer YOUR_TOKEN_HERE" \
-H "Content-Type: application/json" \
-d '{
    "judul": "Updated Jurnal Title",
    "views": 999
}'
```

#### Test Delete Jurnal
```bash
curl -X DELETE http://127.0.0.1:8000/api/admin/jurnal/6 \
-H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### 4. Test dengan Postman

1. Import collection atau buat request manual
2. Base URL: `http://127.0.0.1:8000/api`
3. Untuk auth endpoints, set Authorization type ke "Bearer Token"
4. Test semua endpoint sesuai dokumentasi

### 5. Fitur yang Sudah Diimplementasi

✅ **Autentikasi Admin:**
- Register admin (POST /admin/register)
- Login admin (POST /admin/login)
- Logout admin (POST /admin/logout)
- Change password (POST /admin/change-password)
- Get profile (GET /admin/profile)

✅ **Jurnal API:**
- Get all jurnal dengan pagination (GET /jurnal)
- Search jurnal (GET /jurnal?search=keyword)
- Filter by subject (GET /jurnal?subject=xyz)
- Filter by akreditasi (GET /jurnal?akreditasi=xyz)
- Sort by views (GET /jurnal?sort_by=views)
- Get jurnal by ID + increment views (GET /jurnal/{id})
- Create jurnal (POST /admin/jurnal)
- Update jurnal (PUT /admin/jurnal/{id})
- Delete jurnal (DELETE /admin/jurnal/{id})
- Get unique subjects (GET /jurnal/subjects)
- Get unique akreditasi (GET /jurnal/akreditasi)

### 6. Data Sample yang Tersedia

**Admin Accounts:**
- Username: admin, Email: admin@example.com, Password: password
- Username: superadmin, Email: superadmin@example.com, Password: password123

**Sample Jurnal Data:**
- 5 jurnal dengan berbagai subject dan akreditasi
- Sudah ada data views untuk testing sort

### 7. File Upload Support

API mendukung upload foto untuk jurnal dengan:
- Format: jpeg, png, jpg, gif
- Max size: 2MB
- Storage: storage/app/public/journals/
- URL: domain.com/storage/journals/filename.jpg
