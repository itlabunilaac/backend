# Database Setup - MySQL with phpMyAdmin

## ✅ Setup Complete

Database telah dikonfigurasi untuk menggunakan MySQL dengan phpMyAdmin.

### Configuration
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=e_jurnal
DB_USERNAME=root
DB_PASSWORD=
```

## 🚀 Next Steps

### 1. Run Migrations
```bash
cd c:\laragon\www\backend\e-journal
php artisan migrate:fresh --seed
```

### 2. Start Laravel Server
```bash
php artisan serve
```

### 3. Test API Endpoints
```bash
# Test connection
curl http://127.0.0.1:8000/api/test

# Get all journals
curl http://127.0.0.1:8000/api/jurnal

# Admin login
curl -X POST http://127.0.0.1:8000/api/admin/login \
-H "Content-Type: application/json" \
-d '{
    "login": "admin@example.com",
    "password": "password"
}'
```

## 📊 Database Tables

After running migrations, these tables will be created:
- `admins` - Admin users for authentication
- `jurnals` - Journal entries with all required fields
- `users` - Default Laravel users table
- `sessions` - Session storage
- `personal_access_tokens` - Sanctum API tokens

## 🔑 Default Admin Account

```
Username: admin
Email: admin@example.com  
Password: password
```

## 📱 API Endpoints Ready

### Public Endpoints:
- `GET /api/jurnal` - List journals with search, filter, sort
- `GET /api/jurnal/{id}` - Get journal detail + increment views
- `POST /api/admin/login` - Admin authentication

### Admin Endpoints (requires token):
- `POST /api/admin/jurnal` - Create journal
- `PUT /api/admin/jurnal/{id}` - Update journal  
- `DELETE /api/admin/jurnal/{id}` - Delete journal

## 🎯 Features Implemented

✅ Authentication with Laravel Sanctum
✅ CRUD operations for journals
✅ Search and filter functionality
✅ File upload for journal photos
✅ Auto-increment views when accessing journal
✅ Pagination for large datasets
✅ Input validation and error handling
✅ Soft delete for data integrity
