# API Documentation

## Base URL
`http://localhost:8000/api`

## Endpoints

### 1. Activities API

#### POST /activities
Membuat aktivitas baru
```json
{
    "nama_aktivitas": "Jogging",
    "kategori": "Olahraga", 
    "durasi": 30
}
```

#### GET /activities
Mendapatkan semua aktivitas dengan format day

Response:
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "nama_aktivitas": "Jogging",
            "kategori": "Olahraga",
            "durasi": 30,
            "day": "Friday, 05 Apr 2024",
            "created_at": "2024-04-05T04:37:00.000000Z",
            "updated_at": "2024-04-05T04:37:00.000000Z"
        }
    ]
}
```

#### PUT /activities/{id}
Update aktivitas berdasarkan id
```json
{
    "nama_aktivitas": "Jogging Sore",
    "kategori": "Olahraga",
    "durasi": 60
}
```

#### DELETE /activities/{id}
Hapus aktivitas berdasarkan id

Response:
```json
{
    "status": "success",
    "message": "Activity deleted successfully"
}
```

### 2. Sleep API

#### POST /sleep
Membuat data tidur baru
```json
{
    "jam_tidur": "22:30",
    "jam_bangun": "06:00"
}
```

Note: Total menit akan dihitung otomatis

#### GET /sleep
Mendapatkan semua data tidur

Response:
```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "jam_tidur": "22:30:00",
            "jam_bangun": "06:00:00",
            "total": 450,
            "day": "Friday, 05 Apr 2024",
            "created_at": "2024-04-05T04:37:00.000000Z",
            "updated_at": "2024-04-05T04:37:00.000000Z"
        }
    ]
}
```

#### PUT /sleep/{id}
Update data sleep berdasarkan id
```json
{
    "jam_tidur": "23:30",
    "jam_bangun": "07:00"
}
```

#### DELETE /sleep/{id}
Hapus data sleep berdasarkan id

Response:
```json
{
    "status": "success",
    "message": "Sleep data deleted successfully"
}
```

### 3. Users API

#### POST /users
Membuat user baru
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

#### PUT /users/{id}
Update user berdasarkan id
```json
{
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "password": "newpassword123"
}
```

#### DELETE /users/{id}
Hapus user berdasarkan id

Response:
```json
{
    "status": "success",
    "message": "User deleted successfully"
}
```

### 4. Articles API

#### POST /articles
Membuat artikel baru
```json
{
    "judul": "Tips Kesehatan",
    "sub_judul": "Cara Hidup Sehat",
    "isi": "Artikel tentang kesehatan...",
    "image": "https://example.com/image.jpg",
    "tautan": "https://example.com/article",
    "date": "2024-04-05 10:00:00"
}
```

#### PUT /articles/{id}
Update artikel berdasarkan id
```json
{
    "judul": "Tips Kesehatan Terbaru",
    "sub_judul": "Cara Hidup Sehat",
    "isi": "Artikel update tentang kesehatan...",
    "image": "https://example.com/image-new.jpg",
    "tautan": "https://example.com/article-new",
    "date": "2024-04-05 12:00:00"
}
```

#### DELETE /articles/{id}
Hapus artikel berdasarkan id

Response:
```json
{
    "status": "success",
    "message": "Article deleted successfully"
}
```

## Format Input

### Activity
- `durasi`: dalam menit (integer)
- Format: `30` (artinya 30 menit)

### Sleep  
- `jam_tidur`: format HH:MM (24 jam)
- `jam_bangun`: format HH:MM (24 jam)
- Format: `"22:30"` dan `"06:00"`
- Total akan dihitung otomatis dalam menit

## Response Format

Semua endpoint menggunakan format response standar:
```json
{
    "status": "success|error",
    "message": "Optional message",
    "data": {}
}
```

## Error Handling

### Validation Error (422)
```json
{
    "status": "error",
    "message": "The given data was invalid.",
    "errors": {
        "field": ["Field is required"]
    }
}
```

### Not Found (404)
```json
{
    "status": "error",
    "message": "Resource not found"
}
```