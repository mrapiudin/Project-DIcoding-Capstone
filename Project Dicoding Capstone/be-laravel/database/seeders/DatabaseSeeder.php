<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        // 1. Seed Users
        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@VitaTrack.com',
                'password' => "admin123",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@VitaTrack.com',
                'password' => "user123",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => "user123",
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        // 2. Seed Activities
        \Illuminate\Support\Facades\DB::table('activities')->insert([
            ['nama_aktivitas' => 'Lari Pagi', 'kategori' => 'Cardio', 'durasi' => 30, 'created_at' => $now->copy()->subDays(2), 'updated_at' => $now->copy()->subDays(2)],
            ['nama_aktivitas' => 'Angkat Beban', 'kategori' => 'Strength', 'durasi' => 45, 'created_at' => $now->copy()->subDays(1), 'updated_at' => $now->copy()->subDays(1)],
            ['nama_aktivitas' => 'Yoga Dasar', 'kategori' => 'Flexibility', 'durasi' => 60, 'created_at' => $now, 'updated_at' => $now],
            ['nama_aktivitas' => 'Bersepeda', 'kategori' => 'Cardio', 'durasi' => 40, 'created_at' => $now, 'updated_at' => $now],
            ['nama_aktivitas' => 'Renang', 'kategori' => 'Cardio', 'durasi' => 50, 'created_at' => $now->copy()->subDays(3), 'updated_at' => $now->copy()->subDays(3)],
        ]);

        // 3. Seed Sleep
        \Illuminate\Support\Facades\DB::table('sleep')->insert([
            ['jam_tidur' => '22:00:00', 'jam_bangun' => '05:30:00', 'total' => 450, 'created_at' => $now->copy()->subDays(2), 'updated_at' => $now->copy()->subDays(2)],
            ['jam_tidur' => '23:30:00', 'jam_bangun' => '06:00:00', 'total' => 390, 'created_at' => $now->copy()->subDays(1), 'updated_at' => $now->copy()->subDays(1)],
            ['jam_tidur' => '21:45:00', 'jam_bangun' => '05:00:00', 'total' => 435, 'created_at' => $now, 'updated_at' => $now],
            ['jam_tidur' => '00:00:00', 'jam_bangun' => '06:00:00', 'total' => 360, 'created_at' => $now->copy()->subDays(3), 'updated_at' => $now->copy()->subDays(3)],
        ]);

        // 4. Seed Articles
        \Illuminate\Support\Facades\DB::table('articles')->insert([
            [
                'judul' => 'Manfaat Lari Pagi Bagi Kesehatan Jantung',
                'sub_judul' => 'Rahasia jantung kuat di pagi hari',
                'isi' => "Lari pagi bukan sekadar tren gaya hidup sehat. Berdasarkan berbagai penelitian, berlari minimal 30 menit setiap pagi mampu meningkatkan sirkulasi darah dan menurunkan risiko penyakit kardiovaskular secara signifikan.\n\nTidak perlu berlari kencang, cukup joging ringan atau jalan cepat yang konsisten sudah bisa memberikan dampak positif. Pastikan selalu melakukan pemanasan sebelum memulai untuk menghindari cedera otot.",
                'image' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=80',
                'tautan' => 'https://example.com/lari-pagi',
                'date' => $now->copy()->subDays(5),
                'created_at' => $now->copy()->subDays(5),
                'updated_at' => $now->copy()->subDays(5)
            ],
            [
                'judul' => 'Pentingnya Tidur 8 Jam Mengapa Kurang Tidur Berbahaya',
                'sub_judul' => 'Dampak buruk begadang bagi produktivitas',
                'isi' => "Kurang tidur secara terus menerus sangat berbahaya bagi sistem kekebalan tubuh. Ketika kita tidur kurang dari 7 jam, produksi hormon sitokin yang bertugas melawan infeksi menjadi berkurang.\n\nSelain imun, kurang tidur juga akan mengganggu konsentrasi, memicu peningkatan berat badan, dan mempercepat penuaan kulit. Mulailah perbaiki jadwal tidur Anda dengan menjauhkan gadget 1 jam sebelum tidur.",
                'image' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?auto=format&fit=crop&w=600&q=80',
                'tautan' => 'https://example.com/pentingnya-tidur',
                'date' => $now->copy()->subDays(2),
                'created_at' => $now->copy()->subDays(2),
                'updated_at' => $now->copy()->subDays(2)
            ],
            [
                'judul' => 'Mengenal Clean Eating untuk Pemula',
                'sub_judul' => 'Makan sehat tanpa menyiksa diri',
                'isi' => "Clean eating adalah pola makan yang berfokus pada konsumsi makanan dalam bentuk paling alami, menghindari makanan olahan atau makanan yang mengandung gula tambahan dan pengawet buatan.\n\nMemulai clean eating bisa dilakukan bertahap, mulai dari memperbanyak porsi sayur di setiap makanan, hingga mengganti camilan manis dengan buah segar.",
                'image' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=600&q=80',
                'tautan' => null,
                'date' => $now,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
