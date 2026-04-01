# Template Sidebar HealthSpace

Template sidebar yang sudah dibuat untuk aplikasi HealthSpace dengan Laravel Blade.

## File yang Dibuat

### 1. **layout-with-sidebar.blade.php**
File layout utama yang sudah include sidebar di dalamnya. Letakkan di `resources/views/`

### 2. **sidebar.css**
File CSS untuk styling sidebar. Letakkan di `public/`

### 3. **dashboard-example.blade.php**
Contoh implementasi dashboard menggunakan layout sidebar. Letakkan di `resources/views/`

## Cara Menggunakan

### 1. Buat halaman baru dengan sidebar

```blade
@extends('layout-with-sidebar')

@section('title', 'Judul Halaman')

@section('content')
    <!-- Konten halaman Anda di sini -->
    <h1>Konten Halaman</h1>
@endsection
```

### 2. Setup Route (di routes/web.php)

```php
Route::get('/dashboard', function () {
    return view('dashboard-example');
})->name('dashboard');

Route::get('/aktivitas-olahraga', function () {
    return view('aktivitas-olahraga');
})->name('aktivitas-olahraga');

Route::get('/tracking-tidur', function () {
    return view('tracking-tidur');
})->name('tracking-tidur');

Route::get('/artikel-kesehatan', function () {
    return view('artikel-kesehatan');
})->name('artikel-kesehatan');

Route::get('/reminder', function () {
    return view('reminder');
})->name('reminder');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');
```

## Fitur Sidebar

✅ **Logo & Branding** - Logo HealthSpace dengan icon hijau
✅ **Menu Navigasi** - 5 menu utama dengan icon SVG
✅ **Active State** - Highlight otomatis untuk halaman aktif
✅ **Profile Menu** - Menu profile di bagian bawah
✅ **Responsive** - Sidebar akan tersembunyi di mobile
✅ **Smooth Hover** - Animasi smooth saat hover

## Menu yang Tersedia

1. **Dashboard** - Icon rumah
2. **Aktivitas Olahraga** - Icon detak jantung
3. **Tracking Tidur** - Icon bulan
4. **Artikel Kesehatan** - Icon buku
5. **Reminder** - Icon notifikasi
6. **Profile** - Icon user (di bawah)

## Customisasi

### Mengubah Warna Primary
Edit di `sidebar.css` bagian:
```css
.logo-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.nav-item.active .nav-link {
    background-color: #d1fae5;
    color: #059669;
}
```

### Menambah Menu Baru
Tambahkan di dalam `<ul class="nav-list">`:
```html
<li class="nav-item">
    <a href="{{ route('nama-route') }}" class="nav-link">
        <svg class="nav-icon"><!-- SVG icon --></svg>
        <span class="nav-text">Nama Menu</span>
    </a>
</li>
```

### Mengubah Lebar Sidebar
Edit di `sidebar.css`:
```css
.sidebar {
    width: 240px; /* Ubah sesuai kebutuhan */
}

.main-content {
    margin-left: 240px; /* Samakan dengan lebar sidebar */
}
```

## Browser Support
- Chrome/Edge (Latest)
- Firefox (Latest)
- Safari (Latest)
- Mobile browsers

## Notes
- Pastikan route sudah didefinisikan di `routes/web.php`
- Icon menggunakan SVG inline untuk performa terbaik
- CSS menggunakan flexbox untuk layout responsif
- Gunakan class `.active` untuk highlight menu aktif
