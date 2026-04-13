# VitaTrack - Digital Health Monitoring Platform

![VitaTrack Banner](https://images.unsplash.com/photo-1494390248081-4e521a5940db?auto=format&fit=crop&w=1200&h=400&q=80)

VitaTrack adalah platform digital terpadu untuk membantu Anda dan para pengguna memantau aktivitas olahraga harian, melacak kualitas tidur, serta membagikan informasi dalam bentuk artikel kesehatan. Project ini dikembangkan dengan arsitektur **Frontend-Backend terpisah** menggunakan Laravel 11 untuk frontend dan arsitektur micro-framework Lumen untuk backend.

Proyek ini dibangun sebagai bagian dari Dicoding Capstone Project.

---

## 🎯 Kegunaan & Tujuan Aplikasi

Di era modern yang serba cepat, seringkali kita lupa untuk mencatat dan memperhatikan gaya hidup dasar: olahraga yang cukup dan tidur yang berkualitas. **VitaTrack** hadir untuk memecahkan masalah ini dengan menyediakan platform monitoring sederhana namun berdampak besar.

Aplikasi ini sangat berguna untuk:
1. **Perekaman Rekam Jejak Kesehatan Personal:** Pengguna awam dapat memantau dengan tepat berapa jam mereka telah bergerak/berolahraga dan berapa jam mereka tidur, sehingga dapat mengevaluasi kebiasaan harian mereka sendiri.
2. **Kalkulasi & Kesadaran Otomatis (Awareness):** Dengan kalkulasi durasi aktual misalnya terhadap waktu tidur (yang secara otomatis mencatat `total jam`), pengguna menjadi lebih sadar (*mindful*) terhadap kualitas istirahatnya.
3. **Edukasi & Literasi:** Lewat portal **Artikel Kesehatan** yang dikelola langsung secara tersentralisasi oleh Administrator, pengguna VitaTrack tidak hanya sebatas *tracking*, tapi juga bisa diedukasi dengan sebaran bacaan seputar kesehatan, pola makan, dan bahaya kurang tidur.

---

## 🏗️ Struktur Arsitektur Sistem

Aplikasi ini dibagi menjadi 2 buah direktori project yang berjalan secara simultan:

1. **/be-laravel (Backend API)**
   Berjalan menggunakan **Lumen (Laravel)**. Bertugas sebagai pusat pangkalan data, menyediakan *RESTful API* endpoint, merespons operasi CRUD dalam format JSON, melindungi route, dan terkoneksi langsung ke database MySQL.
   - **Port Default:** `http://localhost:8000`

2. **/fe_laravel (Frontend Web)**
   Berjalan menggunakan **Laravel 11**. Bertugas menyediakan *User Interface (UI)* premium dengan tema *Dark/Glassmorphism*. Frontend ini dilengkapi dengan sistem **API Proxy** bawaan untuk menampung HTTP requests dan mem-bypass *CORS issues*, meneruskannya ke backend secara *seamless*.
   - **Port Default:** `http://localhost:8001` (atau port dinamis)

---

## ✨ Fitur Utama

### 👥 Multi-Role Access Control (Admin vs User)
Berbeda dengan sistem klasik, VitaTrack menyediakan batas menu yang sangat rapi untuk 2 tipe pengguna:
- **Pengguna Biasa (User)**
  Hanya diberi akses untuk memanajemen data kesehatan pribadi di area "Kesehatan Saya" (Tracking Tidur & Aktivitas Olahraga), serta membaca dan mencari Daftar Artikel Kesehatan.
- **Administrator (Admin)**
  Difokuskan sepenuhnya pada pengelolaan konten. Admin disajikan Dashboard khusus Administrator dan menu pusat *"Kelola Artikel"* untuk aksi *Create, Update, dan Delete* Artikel Kesehatan global.

### 🏃‍♂️ Sistem Tracking Olahraga
Operasi *Full CRUD* menggunakan *Modal dinamis* (Pop-up), di mana pengguna bisa menambahkan catatan olahraga, jenis/kategori olahraga, hingga durasi dengan rapi.

### 🌙 Monitor Kualitas Tidur
Fungsi mencatat jam tidur dan jam bangun dengan validasi input `time`. Sistem secara otomatis menghitung *total durasi* istirahat, serta memberikan rating (badge warna) terhadap kualitas tidur tersebut.

### 📰 Portal Artikel Kesehatan
*Grid layout* premium untuk menyajikan artikel ber-thumbnail. Termasuk fitur validasi dan *file input* visual khusus (untuk admin) dan *search list* khusus untuk mencari judul.

### 🎨 Premium UI / Design System
Seluruh *stylesheet* dibangun dalam 1 file inti terpusat (`sidebar.css`) tanpa menggunakan ekstensi *heavyweight* tapi tetap sekelas Tailwind/Bootstrap modern.
- Skema *Dark Mode* mendalam (`#0f172a`).
- Transisi dan efek *Glassmorphism/Blur*.
- *Response Mobile* sidebar *toggle* dinamis.

---

## 🛠️ Panduan Instalasi & Eksekusi Lokal

Berikut cara menjalankan project ini secara utuh di komputer lokal Anda.

### 1. Persiapan Backend API (`be-laravel`)
1. Buka terminal baru dan masuk ke direktori backend:
   ```bash
   cd "be-laravel"
   ```
2. Pastikan file `.env` sudah dikonfigurasi ke dalam database MySQL Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306      # Atau 3308 sesuai konfigurasi lokal Anda
   DB_DATABASE=db_capstone
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Lakukan proses migrasi tabel sekaligus menanamkan (seed) Mockup Data:
   ```bash
   php artisan migrate:refresh --seed
   ```
   > **Note:** Seeder ini otomatis akan membuat akun **Admin** (`admin@VitaTrack.com` | pass: `admin123`) dan **Reguler User** (`user@VitaTrack.com` | pass: `user123`) lengkap beserta isi data olahraga dan dummy artikel.
4. Jalankan aplikasi server Backend:
   ```bash
   php artisan serve --port=8000
   ```

### 2. Persiapan Frontend (`fe_laravel`)
1. Buka terminal/CMD **baru** (biarkan window backend tetap berjalan), masuk ke direktori frontend:
   ```bash
   cd "fe_laravel"
   ```
2. Buka `.env` di folder ini, dan pastikan target API Backend diset dengan benar (wajib menunjuk port Lumen):
   ```env
   API_URL=http://localhost:8000/api
   ```
3. Jalankan server frontend di port berbeda agar tidak bentrok dengan backend:
   ```bash
   php artisan serve --port=8001
   ```

### 3. Cara Menguji / Testing
Buka browser dan navigasikan ke URL Frontend: `http://localhost:8001`. Anda akan disambut halaman Login Premium.

Gunakan akun login yang kita injeksikan saat Data Seeding:
- **Test Admin:**
  Email: `admin@VitaTrack.com`
  Password: `admin123`
- **Test User:**
  Email: `user@VitaTrack.com`
  Password: `user123`

Sistem akan otomatis mendeteksi role tersebut dan mengarahkan panel sidebar yang tepat.

---

## 🗄️ Endpoints API Reference (Backend Lumen)

Secara internal API disusun dengan rute berikut:

| Method | Endpoint | Deskripsi Fungsi |
|---|---|---|
| `GET` | `/api/users` | Mengambil seluruh data user (Administrator) |
| `GET` | `/api/activities` | Menampilkan seluruh log aktivitas |
| `POST`| `/api/activities` | Simpan (Create) rekor aktivitas olahraga baru |
| `DELETE`| `/api/activities/{id}` | Menghapus log/rekor |
| `GET` | `/api/sleep`| Mengambil kalender catatan waktu tidur |
| `POST`| `/api/sleep`| Membuat entri jam tidur dan bangun baru |
| `GET` | `/api/articles` | Endpoint terbuka untuk *list* portal Web kesehatan |
| `POST`| `/api/articles` | Endpoint admin untuk publikasi artikel utuh |
| `PUT` | `/api/articles/{id}` | Mengupdate isi *text* judul / body artikel terkait |

Semua interaksi Cross-Origin ke endpoint di atas ditangani kuat lewat Internal Laravel Frontend Middleware (Proxy Controller) untuk memastikan **100% Bebas CORS Error**.

---

**Selamat memantau kesehatan melalui VitaTrack!** 🍀
