# 📚 E-Journal RESTful API

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

RESTful API untuk sistem e-journal dengan fitur autentikasi admin, CRUD jurnal, search, filter, sort, pagination, dan upload foto. Dilengkapi dengan **demo UI interaktif** yang mengimplementasikan **semua endpoint**.

## 🚀 Features

### 🔐 Admin Authentication
- ✅ Register admin baru
- ✅ Login dengan token authentication
- ✅ Profile management
- ✅ Change password
- ✅ Logout
- ✅ Middleware admin auth

### 📖 Journal Management (CRUD)
- ✅ Create jurnal (admin only)
- ✅ Read jurnal (public + admin)
- ✅ Update jurnal (admin only)
- ✅ Delete jurnal (admin only)
- ✅ Upload foto jurnal
- ✅ Increment views otomatis

### 🔍 Advanced Search & Filter
- ✅ Search by keyword
- ✅ Filter by subject
- ✅ Filter by akreditasi
- ✅ Sort by multiple fields (views, date, title, author)
- ✅ Sort order (ASC/DESC)
- ✅ Pagination with metadata

### 📊 Special Features
- ✅ **Jurnal dengan views terbanyak**
- ✅ **Top N filtering**
- ✅ **API status monitoring**
- ✅ **Sample data generation**
- ✅ **Data statistics**
- ✅ **Interactive demo UI**

## 🌐 Demo UI

**URL**: `http://127.0.0.1:8000/demo`

### 🎯 Complete Demo Coverage
Demo UI menyediakan interface interaktif untuk **SEMUA endpoint**:

#### 📊 **NEW! Jurnal dengan Views Terbanyak**
- Top N jurnal (5, 10, 20, semua)
- Filter by subject
- Auto-sort by views descending

#### 🔍 **NEW! Advanced Sort & Pagination**
- 5 sort fields: views, created_at, updated_at, judul, penulis
- ASC/DESC sort order
- Per page control (5-20 items)
- Page navigation

#### 🔍 **NEW! API Status & Info**
- Server status check
- API version info
- Endpoint documentation
- Server timestamp

#### 📊 **NEW! Demo Data Management**
- Generate 12 sample journals
- Views range: 100-2500
- 4 subjects, 4 akreditasi types
- Data statistics dashboard

### 🎨 Demo Features
- 🔐 **Authentication Demo**: Login, register, profile, change password
- 📖 **Journal CRUD Demo**: Create, read, update, delete dengan upload foto
- 🔍 **Search & Filter Demo**: Keyword, subject, akreditasi filtering
- 📊 **Advanced Features Demo**: Sort, pagination, top views
- 🧪 **API Testing**: Token test, public test, status check
- 📱 **Responsive UI**: Modern, beautiful interface

## 🛠️ Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Laravel 11.x

### Quick Setup
```bash
# Clone repository
git clone <repository-url>
cd e-journal

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database (.env)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_journal
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Start server
php artisan serve
```

### 📊 Generate Demo Data
```bash
# Via API (recommended)
POST http://127.0.0.1:8000/api/sample/generate

# Via demo UI
http://127.0.0.1:8000/demo → Docs tab → Generate Sample Data
```

## 📚 API Documentation

### Base URL
```
http://127.0.0.1:8000/api
```

### 🔗 Public Endpoints
- `GET /status` - API status & info
- `GET /jurnal` - List jurnal dengan filtering
- `GET /jurnal/{id}` - Detail jurnal + increment views
- `GET /jurnal/subjects` - List unique subjects
- `GET /jurnal/akreditasi` - List unique akreditasi
- `POST /admin/register` - Register admin
- `POST /admin/login` - Login admin

### 🔒 Admin Endpoints (Requires Token)
- `GET /admin/profile` - Admin profile
- `POST /admin/change-password` - Change password
- `POST /admin/logout` - Logout
- `POST /admin/jurnal` - Create jurnal
- `PUT /admin/jurnal/{id}` - Update jurnal
- `DELETE /admin/jurnal/{id}` - Delete jurnal

### 🧪 Test Endpoints
- `GET /test` - Public test
- `GET /test-token` - Admin token test (requires auth)

### 📊 Sample Data Endpoints
- `POST /sample/generate` - Generate sample data
- `GET /sample/stats` - Get data statistics

## 🔐 Authentication

API menggunakan custom token authentication:

```javascript
// Headers
Authorization: Bearer {token}
Content-Type: application/json
```

## 📊 Advanced Query Parameters

### GET /api/jurnal
```
?search=keyword          // Search dalam judul, deskripsi, penulis
&subject=Technology      // Filter by subject
&akreditasi=Sinta 1     // Filter by akreditasi
&sort_by=views          // Sort: views, created_at, updated_at, judul, penulis
&order=desc             // Order: asc, desc
&per_page=10            // Items per page (1-50)
&page=1                 // Page number
```

### Example: Top Views Jurnal
```
GET /api/jurnal?sort_by=views&order=desc&per_page=10
```

## 🎯 Demo Scenarios

### 1. 🏆 Top Views Analysis
```bash
# Generate sample data
POST /api/sample/generate

# Get top 5 jurnal with most views
GET /api/jurnal?sort_by=views&order=desc&per_page=5

# Filter top views by subject
GET /api/jurnal?sort_by=views&order=desc&subject=Teknologi%20Informasi
```

### 2. 📄 Pagination Testing
```bash
# Page 1 with 5 items
GET /api/jurnal?per_page=5&page=1

# Page 2 with sort
GET /api/jurnal?per_page=5&page=2&sort_by=created_at&order=desc
```

### 3. 🔍 Search & Filter
```bash
# Search with multiple filters
GET /api/jurnal?search=machine&subject=Teknologi&akreditasi=Sinta%201
```

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/Api/
│   │   ├── AdminController.php      # Admin auth & profile
│   │   ├── JurnalController.php     # Journal CRUD & search
│   │   ├── TestController.php       # Testing endpoints
│   │   └── SampleController.php     # Sample data management
│   └── Middleware/
│       └── AdminAuth.php            # Token authentication
├── Models/
│   ├── Admin.php                    # Admin model
│   └── Jurnal.php                   # Journal model with scopes
database/
├── migrations/                      # Database schema
└── seeders/                        # Sample data
public/
└── demo.html                       # Interactive demo UI
routes/
├── api.php                         # API routes
└── web.php                         # Web routes
```

## 📖 Documentation Files

- 📋 `API_DOCUMENTATION.md` - Complete API reference
- 🔧 `SETUP_MYSQL.md` - MySQL setup guide
- 🎨 `DEMO_UI_GUIDE.md` - Demo UI usage guide
- 📊 `IMPLEMENTATION_SUMMARY.md` - Implementation details
- 🔐 `TOKEN_AUTHENTICATION_FIX.md` - Auth system docs
- 🎉 `DEMO_COMPLETE.md` - Complete feature overview
- 🆕 `NEW_DEMO_FEATURES.md` - Latest feature additions

## 🧪 Testing

### Manual Testing
```bash
# Test API status
curl -X GET "http://127.0.0.1:8000/api/status"

# Test top views
curl -X GET "http://127.0.0.1:8000/api/jurnal?sort_by=views&order=desc&per_page=5"

# Test with auth (replace {token})
curl -X GET "http://127.0.0.1:8000/api/admin/profile" \
  -H "Authorization: Bearer {token}"
```

### Demo UI Testing
1. 🌐 Access: `http://127.0.0.1:8000/demo`
2. 📊 Generate sample data
3. 🧪 Test all features interactively
4. 📱 Ready for presentation!

## 🎊 What's New

### ✨ Latest Updates
- ✅ **Top Views Demo** - Jurnal dengan views terbanyak
- ✅ **Advanced Pagination** - Per page control & navigation
- ✅ **API Status Check** - Server monitoring
- ✅ **Sample Data Management** - Generate & statistics
- ✅ **Enhanced Sorting** - 5 sort fields with ASC/DESC
- ✅ **Complete Demo Coverage** - All endpoints have demos

### 🎯 100% Complete
Demo UI now covers **ALL endpoints** with interactive interface!

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Laravel Framework
- MySQL Database
- Modern web technologies

---

**🎉 E-Journal API with Complete Interactive Demo - Ready for Production! 🎉**

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
