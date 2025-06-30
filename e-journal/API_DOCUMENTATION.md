# E-Journal REST API Documentation

## Daftar Isi
1. [Autentikasi Admin](#autentikasi-admin)
2. [Jurnal API](#jurnal-api)
3. [Response Format](#response-format)

## Base URL
```
http://localhost/e-journal/public/api
```

## Autentikasi Admin

### 1. Register Admin
**Endpoint:** `POST /admin/register`

**Request Body:**
```json
{
    "username": "admin",
    "email": "admin@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response (201):**
```json
{
    "success": true,
    "message": "Admin registered successfully",
    "data": {
        "admin": {
            "id": 1,
            "username": "admin",
            "email": "admin@example.com",
            "created_at": "2024-12-30T00:00:00.000000Z",
            "updated_at": "2024-12-30T00:00:00.000000Z"
        },
        "token": "1|abc123token"
    }
}
```

### 2. Login Admin
**Endpoint:** `POST /admin/login`

**Request Body:**
```json
{
    "login": "admin@example.com",
    "password": "password123"
}
```
*Note: `login` dapat berupa email atau username*

**Response (200):**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "admin": {
            "id": 1,
            "username": "admin",
            "email": "admin@example.com"
        },
        "token": "1|abc123token"
    }
}
```

### 3. Ganti Password Admin
**Endpoint:** `POST /admin/change-password`
**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
    "current_password": "oldpassword",
    "new_password": "newpassword123",
    "new_password_confirmation": "newpassword123"
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Password changed successfully"
}
```

### 4. Logout Admin
**Endpoint:** `POST /admin/logout`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

### 5. Profile Admin
**Endpoint:** `GET /admin/profile`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "username": "admin",
        "email": "admin@example.com",
        "created_at": "2024-12-30T00:00:00.000000Z"
    }
}
```

## Jurnal API

### 1. Get All Jurnal (Public)
**Endpoint:** `GET /jurnal`

**Query Parameters:**
- `page` (optional): Halaman (default: 1)
- `per_page` (optional): Jumlah per halaman (default: 10)
- `search` (optional): Kata kunci pencarian
- `subject` (optional): Filter berdasarkan subject
- `akreditasi` (optional): Filter berdasarkan akreditasi
- `sort_by` (optional): Urutkan berdasarkan (views, created_at, judul)
- `sort_order` (optional): Urutan (asc, desc)

**Examples:**
```
GET /jurnal
GET /jurnal?search=machine learning
GET /jurnal?subject=Teknologi Informasi
GET /jurnal?akreditasi=Sinta 1
GET /jurnal?sort_by=views&sort_order=desc
GET /jurnal?page=2&per_page=5
```

**Response (200):**
```json
{
    "success": true,
    "message": "Journals retrieved successfully",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "judul": "Implementasi Machine Learning dalam Bidang Kesehatan",
                "deskripsi": "Penelitian ini membahas...",
                "akreditasi": "Sinta 2",
                "link_akreditasi": "https://sinta.ristekbrin.go.id",
                "subject": "Teknologi Informasi",
                "penerbit": "Jurnal Teknologi Kesehatan",
                "link_penerbit": "https://example.com/jurnal",
                "foto": "journals/foto.jpg",
                "views": 150,
                "created_at": "2024-12-30T00:00:00.000000Z",
                "updated_at": "2024-12-30T00:00:00.000000Z"
            }
        ],
        "first_page_url": "http://localhost/api/jurnal?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://localhost/api/jurnal?page=1",
        "links": [...],
        "next_page_url": null,
        "path": "http://localhost/api/jurnal",
        "per_page": 10,
        "prev_page_url": null,
        "to": 5,
        "total": 5
    }
}
```

### 2. Get Jurnal by ID (Public + Increment Views)
**Endpoint:** `GET /jurnal/{id}`

**Response (200):**
```json
{
    "success": true,
    "message": "Journal retrieved successfully",
    "data": {
        "id": 1,
        "judul": "Implementasi Machine Learning dalam Bidang Kesehatan",
        "deskripsi": "Penelitian ini membahas...",
        "akreditasi": "Sinta 2",
        "link_akreditasi": "https://sinta.ristekbrin.go.id",
        "subject": "Teknologi Informasi",
        "penerbit": "Jurnal Teknologi Kesehatan",
        "link_penerbit": "https://example.com/jurnal",
        "foto": "journals/foto.jpg",
        "views": 151,
        "created_at": "2024-12-30T00:00:00.000000Z",
        "updated_at": "2024-12-30T00:00:00.000000Z"
    }
}
```

### 3. Create Jurnal (Admin Only)
**Endpoint:** `POST /admin/jurnal`
**Headers:** `Authorization: Bearer {token}`

**Request Body (multipart/form-data):**
```
judul: "Judul Jurnal Baru"
deskripsi: "Deskripsi lengkap jurnal..."
akreditasi: "Sinta 1"
link_akreditasi: "https://sinta.ristekbrin.go.id"
subject: "Teknologi Informasi"
penerbit: "Jurnal IT Indonesia"
link_penerbit: "https://example.com/jurnal"
foto: [file] (optional)
```

**Response (201):**
```json
{
    "success": true,
    "message": "Journal created successfully",
    "data": {
        "id": 6,
        "judul": "Judul Jurnal Baru",
        "deskripsi": "Deskripsi lengkap jurnal...",
        "akreditasi": "Sinta 1",
        "link_akreditasi": "https://sinta.ristekbrin.go.id",
        "subject": "Teknologi Informasi",
        "penerbit": "Jurnal IT Indonesia",
        "link_penerbit": "https://example.com/jurnal",
        "foto": "journals/1640123456_foto.jpg",
        "views": 0,
        "created_at": "2024-12-30T00:00:00.000000Z",
        "updated_at": "2024-12-30T00:00:00.000000Z"
    }
}
```

### 4. Update Jurnal (Admin Only)
**Endpoint:** `PUT /admin/jurnal/{id}`
**Headers:** `Authorization: Bearer {token}`

**Request Body (multipart/form-data):**
```
judul: "Judul Updated" (optional)
deskripsi: "Deskripsi updated..." (optional)
akreditasi: "Sinta 2" (optional)
foto: [file] (optional)
```

**Response (200):**
```json
{
    "success": true,
    "message": "Journal updated successfully",
    "data": {
        "id": 1,
        "judul": "Judul Updated",
        "deskripsi": "Deskripsi updated...",
        // ... field lainnya
    }
}
```

### 5. Delete Jurnal (Admin Only)
**Endpoint:** `DELETE /admin/jurnal/{id}`
**Headers:** `Authorization: Bearer {token}`

**Response (200):**
```json
{
    "success": true,
    "message": "Journal deleted successfully"
}
```

### 6. Get Subjects (Public)
**Endpoint:** `GET /jurnal/subjects`

**Response (200):**
```json
{
    "success": true,
    "data": [
        "Teknologi Informasi",
        "Teknik Industri",
        "Ekonomi",
        "Lingkungan",
        "Kesehatan"
    ]
}
```

### 7. Get Akreditasi (Public)
**Endpoint:** `GET /jurnal/akreditasi`

**Response (200):**
```json
{
    "success": true,
    "data": [
        "Sinta 1",
        "Sinta 2",
        "Sinta 3",
        "Scopus",
        "Web of Science"
    ]
}
```

## Response Format

### Success Response
```json
{
    "success": true,
    "message": "Success message",
    "data": {}
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": {} // optional, untuk validation errors
}
```

## Error Codes
- **200**: OK
- **201**: Created
- **400**: Bad Request
- **401**: Unauthorized
- **404**: Not Found
- **422**: Validation Error
- **500**: Internal Server Error

## Testing dengan Postman

1. **Setup Environment:**
   - Base URL: `http://localhost/e-journal/public/api`

2. **Login Admin:**
   - POST `/admin/login`
   - Simpan token dari response

3. **Set Authorization:**
   - Type: Bearer Token
   - Token: [token dari login]

4. **Test Endpoints:**
   - Mulai dengan endpoint public (GET /jurnal)
   - Test login dan register admin
   - Test CRUD jurnal dengan authorization header
