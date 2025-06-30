# Token Authentication Fix

## Masalah yang Diperbaiki

Sebelumnya, sistem autentikasi menggunakan session yang tidak persistent antar request. Ini menyebabkan masalah dimana:

1. **Token tidak tersimpan dengan benar**: Token disimpan di session yang hilang setiap request
2. **Endpoint admin tidak bisa diakses**: Semua endpoint yang memerlukan autentikasi mengembalikan "Invalid token"
3. **Demo UI tidak menampilkan token**: User tidak bisa melihat token yang sedang digunakan

## Solusi yang Diimplementasikan

### 1. Migrasi ke Database Token System

- **Tabel baru**: `admin_tokens` untuk menyimpan token secara persistent
- **Model baru**: `AdminToken` untuk mengelola token
- **Relasi**: Admin memiliki banyak token (untuk multiple devices/sessions)

### 2. Update Middleware AdminAuth

```php
// Sebelum (menggunakan session)
$adminId = null;
foreach (session()->all() as $key => $value) {
    if (strpos($key, 'api_token_') === 0 && $value === $token) {
        $adminId = str_replace('api_token_', '', $key);
        break;
    }
}

// Sesudah (menggunakan database)
$adminToken = AdminToken::where('token', $token)
                       ->where('expires_at', '>', now())
                       ->first();
```

### 3. Perbaikan Demo UI

#### Fitur Baru:
- ✅ **Token Display**: Menampilkan token aktif setelah login
- ✅ **Copy Token**: Tombol untuk copy token ke clipboard
- ✅ **Manual Token Input**: Field untuk input token manual
- ✅ **Clear Token**: Tombol untuk hapus token
- ✅ **Persistent Storage**: Token tersimpan di localStorage

#### Perbaikan API Request:
- ✅ **FormData Handling**: Perbaikan Content-Type untuk file upload
- ✅ **Auto Authorization**: Token otomatis ditambahkan ke semua request
- ✅ **Error Handling**: Notifikasi yang jelas untuk error token

## Cara Penggunaan

### 1. Login Normal
1. Masuk ke tab "Authentication"
2. Isi form "Login Admin" dengan email dan password
3. Klik "Login"
4. Token akan otomatis tersimpan dan ditampilkan

### 2. Manual Token Input
1. Jika sudah punya token dari login sebelumnya
2. Paste token di field "Manual Token Input"
3. Klik "Set Token"
4. Token akan aktif untuk semua request

### 3. Testing Endpoint Admin
Setelah login, semua endpoint berikut bisa diakses:
- ✅ GET `/api/admin/profile`
- ✅ POST `/api/admin/change-password`
- ✅ POST `/api/admin/logout`
- ✅ CRUD `/api/admin/jurnal/*`

## Token Flow

```
1. Login → Server generates token → Save to admin_tokens table
2. Client receives token → Save to localStorage
3. All admin requests → Include Bearer token
4. Middleware validates → Check admin_tokens table
5. Valid token → Allow access
6. Logout → Delete token from table
```

## Security Features

- ✅ **Token Expiration**: Token expire setelah 24 jam
- ✅ **Token Validation**: Middleware check token di database
- ✅ **Multiple Sessions**: Admin bisa login di multiple device
- ✅ **Clean Logout**: Token dihapus dari database saat logout

## Testing Checklist

- [ ] Login admin berhasil dan token muncul
- [ ] Profile admin bisa diakses dengan token
- [ ] CRUD jurnal berfungsi dengan token
- [ ] Change password berfungsi
- [ ] Logout menghapus token
- [ ] Manual token input berfungsi
- [ ] Copy token berfungsi
- [ ] Clear token berfungsi

## Error Messages

### Common Errors:
- `Unauthorized. Token required.` → Tidak ada token di request
- `Unauthorized. Invalid or expired token.` → Token salah atau expired
- `Unauthorized. Admin not found.` → Admin sudah dihapus

### Debug Steps:
1. Check apakah token ada di localStorage
2. Check apakah token masih valid di database
3. Check apakah request header Authorization benar
4. Check apakah middleware berjalan
