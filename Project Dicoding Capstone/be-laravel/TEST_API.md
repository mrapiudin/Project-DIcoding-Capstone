# Testing API dengan cURL

## 1. Testing Activity API

### Membuat Activity
```bash
curl -X POST http://localhost:8000/api/activities \
  -H "Content-Type: application/json" \
  -d '{
    "nama_aktivitas": "Jogging Pagi",
    "kategori": "Olahraga",
    "durasi": 45
  }'
```

### Mendapatkan Semua Activities
```bash
curl -X GET http://localhost:8000/api/activities \
  -H "Content-Type: application/json"
```

### Edit Activity
```bash
curl -X PUT http://localhost:8000/api/activities/1 \
  -H "Content-Type: application/json" \
  -d '{
    "nama_aktivitas": "Jogging Sore",
    "kategori": "Olahraga",
    "durasi": 60
  }'
```

### Delete Activity
```bash
curl -X DELETE http://localhost:8000/api/activities/1 \
  -H "Content-Type: application/json"
```

## 2. Testing Sleep API

### Membuat Data Sleep
```bash
curl -X POST http://localhost:8000/api/sleep \
  -H "Content-Type: application/json" \
  -d '{
    "jam_tidur": "23:00",
    "jam_bangun": "07:00"
  }'
```

### Contoh Melewati Tengah Malam
```bash
curl -X POST http://localhost:8000/api/sleep \
  -H "Content-Type: application/json" \
  -d '{
    "jam_tidur": "23:30",
    "jam_bangun": "06:30"
  }'
```

### Mendapatkan Semua Data Sleep
```bash
curl -X GET http://localhost:8000/api/sleep \
  -H "Content-Type: application/json"
```

### Edit Sleep
```bash
curl -X PUT http://localhost:8000/api/sleep/1 \
  -H "Content-Type: application/json" \
  -d '{
    "jam_tidur": "23:30",
    "jam_bangun": "07:00"
  }'
```

### Delete Sleep
```bash
curl -X DELETE http://localhost:8000/api/sleep/1 \
  -H "Content-Type: application/json"
```

## 3. Testing User API

### Membuat User
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Edit User
```bash
curl -X PUT http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "password": "newpassword123"
  }'
```

### Delete User
```bash
curl -X DELETE http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json"
```

## 4. Testing Article API

### Membuat Article
```bash
curl -X POST http://localhost:8000/api/articles \
  -H "Content-Type: application/json" \
  -d '{
    "judul": "Tips Hidup Sehat",
    "sub_judul": "Panduan Lengkap",
    "isi": "Artikel lengkap tentang cara hidup sehat...",
    "image": "https://example.com/image.jpg",
    "tautan": "https://healthylife.com/tips",
    "date": "2024-04-05 10:00:00"
  }'
```

### Edit Article
```bash
curl -X PUT http://localhost:8000/api/articles/1 \
  -H "Content-Type: application/json" \
  -d '{
    "judul": "Tips Hidup Sehat Terbaru",
    "sub_judul": "Panduan Lengkap",
    "isi": "Artikel update tentang cara hidup sehat...",
    "image": "https://example.com/image-new.jpg",
    "tautan": "https://healthylife.com/tips-baru",
    "date": "2024-04-05 12:00:00"
  }'
```

### Delete Article
```bash
curl -X DELETE http://localhost:8000/api/articles/1 \
  -H "Content-Type: application/json"
```

## Cara Menjalankan Server

1. Masuk ke directory project
```bash
cd "d:\Project DIcoding Capstone\Project Dicoding Capstone\be-laravel"
```

2. Install dependencies (jika belum)
```bash
composer install
```

3. Copy .env file
```bash
copy .env.example .env
```

4. Setup database di .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations
```bash
php artisan migrate
```

6. Start server
```bash
php -S localhost:8000 -t public
```

## Flow Input seperti yang diminta:

### Input Aktivitas
- Durasi menggunakan menit: `45` (45 menit)
- Tidak perlu format 00-00, langsung input angka menit

### Input Tidur  
- Format jam tidur: `"23:00"` 
- Format jam bangun: `"07:00"`
- Total akan dihitung otomatis: 8 jam = 480 menit

### Display Created_at sebagai Day
- Response akan include field `day` dengan format: "Friday, 05 Apr 2024"
- Field `created_at` tetap ada sebagai timestamp lengkap