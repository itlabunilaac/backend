# 🎮 DEMO UI - E-Journal REST API

## 🚀 Cara Menggunakan Demo UI

### 1. Setup & Akses
```bash
# Start Laravel server
cd c:\laragon\www\backend\e-journal
php artisan serve

# Akses Demo UI
http://127.0.0.1:8000/demo
```

### 2. Tab Navigation

#### 🔐 **Authentication Tab**
- **Login Admin:** Test login dengan kredensial default
- **Register Admin:** Buat admin baru
- **Profile & Actions:** View profile, change password, logout

#### 📚 **Jurnal API Tab** 
- **Get All Jurnal:** List dengan search, filter, sort
- **Get Detail:** Ambil detail jurnal + auto increment views
- **Helper Functions:** Get subjects dan akreditasi list

#### 👨‍💼 **Admin Panel Tab**
- **Create Jurnal:** Form lengkap tambah jurnal baru (+ upload foto)
- **Update Jurnal:** Edit jurnal existing
- **Delete Jurnal:** Hapus jurnal

#### 📖 **Documentation Tab**
- Complete API documentation
- Endpoint list
- Response format
- Query parameters

## 🎯 Demo Flow Recommended

### Step 1: Authentication
1. Buka tab **Authentication**
2. Login dengan default credentials:
   - Email: `admin@example.com`
   - Password: `password`
3. Lihat token tersimpan otomatis

### Step 2: Test Public API
1. Buka tab **Jurnal API**
2. Click "Get Jurnal" untuk melihat semua data
3. Test search: ketik "machine" di search box
4. Test filter: pilih "Teknologi Informasi" di subject
5. Test sort: pilih "Views" di sort by
6. Test detail: masukkan ID "1" dan click "Get Jurnal Detail"

### Step 3: Test Admin Functions
1. Buka tab **Admin Panel** (pastikan sudah login)
2. **Create Jurnal:**
   - Isi form create jurnal
   - Upload foto (optional)
   - Click "Create Jurnal"
3. **Update Jurnal:**
   - Masukkan ID jurnal existing (misal: 1)
   - Update beberapa field
   - Click "Update Jurnal"
4. **Delete Jurnal:**
   - Masukkan ID jurnal untuk dihapus
   - Click "Delete Jurnal"

### Step 4: Test Profile Management
1. Kembali ke tab **Authentication**
2. Click "Get Profile" untuk melihat data admin
3. Click "Change Password" untuk ganti password
4. Click "Logout" untuk keluar

## 🔧 Features Demo UI

### Real-time Features:
- ✅ **Token Management:** Auto save & use token
- ✅ **Response Display:** Pretty JSON formatting
- ✅ **Status Indicators:** Success/Error dengan color coding
- ✅ **Form Validation:** Client-side validation
- ✅ **File Upload:** Test upload foto jurnal
- ✅ **Error Handling:** Network error handling

### Interactive Testing:
- ✅ **Live API Calls:** Langsung hit API endpoint
- ✅ **Dynamic Forms:** Form yang responsive
- ✅ **Query Builder:** Build search & filter parameters
- ✅ **Auth Status:** Real-time login status
- ✅ **Response Inspector:** View full API response

## 📊 Sample Data untuk Testing

### Default Admin:
```
Email: admin@example.com
Password: password
```

### Sample Search Keywords:
- "machine" - akan find jurnal tentang machine learning
- "ekonomi" - akan find jurnal ekonomi
- "lingkungan" - akan find jurnal lingkungan

### Sample Filter Values:
- **Subject:** Teknologi Informasi, Ekonomi, Lingkungan
- **Akreditasi:** Sinta 1, Sinta 2, Sinta 3, Scopus

### Sample Create Data:
```
Judul: Implementasi AI dalam Pendidikan
Subject: Teknologi Informasi
Akreditasi: Sinta 1
Penerbit: Jurnal AI Indonesia
Deskripsi: Penelitian tentang penerapan AI...
```

## 🎯 API Endpoints Tested

### Public (No Auth):
- `GET /api/status` - API status & info
- `GET /api/jurnal` - List jurnal
- `GET /api/jurnal/{id}` - Detail jurnal
- `GET /api/jurnal/subjects` - Subjects list
- `GET /api/jurnal/akreditasi` - Akreditasi list
- `POST /api/admin/login` - Admin login
- `POST /api/admin/register` - Admin register

### Admin (Requires Token):
- `GET /api/admin/profile` - Admin profile
- `POST /api/admin/change-password` - Change password
- `POST /api/admin/logout` - Logout
- `POST /api/admin/jurnal` - Create jurnal
- `PUT /api/admin/jurnal/{id}` - Update jurnal
- `DELETE /api/admin/jurnal/{id}` - Delete jurnal

## 🚨 Troubleshooting

### Jika Demo UI tidak loading:
1. Pastikan server Laravel running: `php artisan serve`
2. Cek database connection
3. Clear cache: `php artisan config:clear`

### Jika API error:
1. Cek network tab di browser developer tools
2. Verify database ada data (run `php artisan db:seed`)
3. Pastikan CORS tidak blocking

### Jika token error:
1. Login ulang untuk get fresh token
2. Check localStorage di browser
3. Verify admin credentials

## 🎉 Complete Demo Features

Demo UI ini mengimplementasikan **SEMUA** endpoint API yang sudah dibuat:
- ✅ Authentication system lengkap
- ✅ CRUD operations untuk jurnal
- ✅ Search, filter, sort functionality
- ✅ File upload testing
- ✅ Pagination support
- ✅ Error handling
- ✅ Token management
- ✅ Real-time API testing

**Demo UI siap untuk presentasi dan testing lengkap! 🚀**
