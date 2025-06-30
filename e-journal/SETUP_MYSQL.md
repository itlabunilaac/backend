# 🚀 QUICK SETUP - MySQL Database

## ✅ Configuration Updated

Database sudah dikonfigurasi untuk MySQL:
- Database: `e_jurnal` 
- Host: `localhost:3306`
- User: `root` (no password)

## 📋 Next Steps

### 1. Jalankan Commands Ini:

```bash
# Masuk ke folder project
cd c:\laragon\www\backend\e-journal

# Clear cache
php artisan config:clear
php artisan cache:clear

# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Start server
php artisan serve
```

### 2. Test API:

**Base URL:** `http://127.0.0.1:8000/api`

**Test Connection:**
```bash
curl http://127.0.0.1:8000/api/test
```

**Login Admin:**
```bash
curl -X POST http://127.0.0.1:8000/api/admin/login \
-H "Content-Type: application/json" \
-d '{
    "login": "admin@example.com",
    "password": "password"
}'
```

**Get All Jurnal:**
```bash
curl http://127.0.0.1:8000/api/jurnal
```

## 🎯 API Ready to Use!

Semua endpoint REST API sudah siap:

### 🔓 Public Endpoints:
- `GET /jurnal` - List semua jurnal (dengan search, filter, sort, pagination)
- `GET /jurnal/{id}` - Detail jurnal + auto increment views
- `GET /jurnal/subjects` - List unique subjects
- `GET /jurnal/akreditasi` - List unique akreditasi
- `POST /admin/register` - Register admin baru
- `POST /admin/login` - Login admin

### 🔒 Admin Endpoints (perlu token):
- `GET /admin/profile` - Profile admin
- `POST /admin/change-password` - Ganti password
- `POST /admin/logout` - Logout
- `POST /admin/jurnal` - Tambah jurnal baru
- `PUT /admin/jurnal/{id}` - Update jurnal
- `DELETE /admin/jurnal/{id}` - Hapus jurnal

## 🔑 Default Login:
- **Email:** admin@example.com
- **Password:** password

## 📱 Features:
✅ Search jurnal by keyword
✅ Filter by subject & akreditasi  
✅ Sort by views, date, title
✅ Upload foto jurnal
✅ Auto increment views
✅ Pagination
✅ Full CRUD operations
✅ Token-based authentication
✅ Input validation

**REST API E-Journal sudah COMPLETE! 🎉**
