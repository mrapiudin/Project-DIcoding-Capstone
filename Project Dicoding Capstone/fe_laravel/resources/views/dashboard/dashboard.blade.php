@extends('template.sidebar')

@section('title', 'Dashboard - HealthSpace')

@push('styles')
<style>
/* Header Styles for Dashboard */
.page-header {
    background-color: #ffffff;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.page-header h1 {
    font-size: 28px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 8px;
}

.page-header p {
    color: #6b7280;
    font-size: 14px;
}

/* Card Styles */
.card {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
}

/* Grid Layout */
.grid {
    display: grid;
    gap: 24px;
}

.grid-3 {
    grid-template-columns: repeat(3, 1fr);
}

.grid-2 {
    grid-template-columns: repeat(2, 1fr);
}

@media (max-width: 1024px) {
    .grid-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .grid-3,
    .grid-2 {
        grid-template-columns: 1fr;
    }
}

/* Table Styles */
.table-container {
    overflow-x: auto;
    margin-top: 8px;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.data-table th,
.data-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #f3f4f6;
}

.data-table th {
    background-color: #f9fafb;
    font-weight: 600;
    color: #374151;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.data-table td {
    color: #6b7280;
}

.data-table tbody tr:hover {
    background-color: #f9fafb;
}

.data-table tbody tr:last-child td {
    border-bottom: none;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.status-selesai {
    background-color: #d1fae5;
    color: #059669;
}

.status-proses {
    background-color: #fef3c7;
    color: #d97706;
}

.status-batal {
    background-color: #fee2e2;
    color: #dc2626;
}

/* Activity Icon */
.activity-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}
</style>
@endpush

@section('content')
<div class="page-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1>Selamat pagi, Budi!</h1>
            <p>Pantau perkembangan kesehatanmu hari ini.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="color: #6b7280; font-size: 14px;">📅 24 Okt 2023</span>
        </div>
    </div>
</div>

<div class="grid grid-3" style="margin-bottom: 24px;">
    <!-- Card Total Olahraga -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 40px; height: 40px; background-color: #d1fae5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12H18L15 21L9 3L6 12H2" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span style="font-size: 14px; color: #6b7280;">Total Olahraga</span>
            </div>
            <button style="border: none; background: none; cursor: pointer; color: #9ca3af;">⋮</button>
        </div>
        <div style="margin-bottom: 4px;">
            <span style="font-size: 36px; font-weight: 600; color: #111827;">4.5</span>
            <span style="font-size: 14px; color: #6b7280; margin-left: 4px;">Jam</span>
        </div>
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 12px;">Minggu ini</p>
        <div style="width: 100%; height: 6px; background-color: #f3f4f6; border-radius: 3px; overflow: hidden; margin-bottom: 8px;">
            <div style="width: 75%; height: 100%; background: linear-gradient(90deg, #10b981 0%, #059669 100%);"></div>
        </div>
        <p style="font-size: 12px; color: #6b7280;">Target: 6 Jam</p>
    </div>

    <!-- Card Rata-rata Tidur -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 40px; height: 40px; background-color: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 12.79C20.8427 14.4922 20.2039 16.1144 19.1583 17.4668C18.1127 18.8192 16.7035 19.8458 15.0957 20.4265C13.4879 21.0073 11.748 21.1181 10.0795 20.7461C8.41104 20.3741 6.88302 19.5345 5.67425 18.3258C4.46548 17.117 3.62596 15.589 3.25393 13.9205C2.8819 12.252 2.99274 10.5121 3.57348 8.9043C4.15423 7.29651 5.18085 5.88737 6.53324 4.84175C7.88562 3.79614 9.50782 3.15731 11.21 3C10.2134 4.34827 9.73387 6.00945 9.85856 7.68141C9.98324 9.35338 10.7039 10.9251 11.8894 12.1106C13.0749 13.2961 14.6466 14.0168 16.3186 14.1414C17.9906 14.2661 19.6517 13.7866 21 12.79Z" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span style="font-size: 14px; color: #6b7280;">Rata-rata Tidur</span>
            </div>
            <button style="border: none; background: none; cursor: pointer; color: #9ca3af;">⋮</button>
        </div>
        <div style="margin-bottom: 4px;">
            <span style="font-size: 36px; font-weight: 600; color: #111827;">7.2</span>
            <span style="font-size: 14px; color: #6b7280; margin-left: 4px;">Jam</span>
        </div>
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 12px;">Per malam</p>
        <div style="width: 100%; height: 6px; background-color: #f3f4f6; border-radius: 3px; overflow: hidden; margin-bottom: 8px;">
            <div style="width: 90%; height: 100%; background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);"></div>
        </div>
        <p style="font-size: 12px; color: #6b7280;">Target: 8 Jam</p>
    </div>

    <!-- Card Konsumsi Air -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 40px; height: 40px; background-color: #cffafe; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.69L17.66 8.35C18.5 9.18 19 10.34 19 11.55C19 14.03 16.97 16.06 14.5 16.06C12.02 16.06 10 14.03 10 11.55C10 10.34 10.5 9.18 11.34 8.35L12 2.69Z" stroke="#0891b2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span style="font-size: 14px; color: #6b7280;">Konsumsi Air</span>
            </div>
            <button style="border: none; background: none; cursor: pointer; color: #9ca3af;">⋮</button>
        </div>
        <div style="margin-bottom: 4px;">
            <span style="font-size: 36px; font-weight: 600; color: #111827;">1.5</span>
            <span style="font-size: 14px; color: #6b7280; margin-left: 4px;">Liter</span>
        </div>
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 12px;">Hari ini</p>
        <div style="width: 100%; height: 6px; background-color: #f3f4f6; border-radius: 3px; overflow: hidden; margin-bottom: 8px;">
            <div style="width: 60%; height: 100%; background: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%);"></div>
        </div>
        <p style="font-size: 12px; color: #6b7280;">Target: 2.5 Liter</p>
    </div>
</div>

<div class="grid grid-2">
    <!-- Tabel Kegiatan -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Tabel Kegiatan</h2>
            <select style="padding: 6px 12px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 14px; color: #6b7280; cursor: pointer;">
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
                <option>Tahun Ini</option>
            </select>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Durasi</th>
                        <th>Kalori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="activity-icon" style="background-color: #d1fae5;">🏃</div>
                                <span style="color: #111827; font-weight: 500;">Lari Pagi</span>
                            </div>
                        </td>
                        <td>45 Min</td>
                        <td>320 kcal</td>
                        <td>24 Okt</td>
                        <td><span class="status-badge status-selesai">● Selesai</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="activity-icon" style="background-color: #dbeafe;">🚴</div>
                                <span style="color: #111827; font-weight: 500;">Bersepeda</span>
                            </div>
                        </td>
                        <td>60 Min</td>
                        <td>450 kcal</td>
                        <td>23 Okt</td>
                        <td><span class="status-badge status-selesai">● Selesai</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="activity-icon" style="background-color: #fef3c7;">🏋️</div>
                                <span style="color: #111827; font-weight: 500;">Gym</span>
                            </div>
                        </td>
                        <td>90 Min</td>
                        <td>580 kcal</td>
                        <td>22 Okt</td>
                        <td><span class="status-badge status-proses">● Proses</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="activity-icon" style="background-color: #cffafe;">🧘</div>
                                <span style="color: #111827; font-weight: 500;">Yoga</span>
                            </div>
                        </td>
                        <td>30 Min</td>
                        <td>120 kcal</td>
                        <td>21 Okt</td>
                        <td><span class="status-badge status-selesai">● Selesai</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="activity-icon" style="background-color: #fee2e2;">🏊</div>
                                <span style="color: #111827; font-weight: 500;">Renang</span>
                            </div>
                        </td>
                        <td>45 Min</td>
                        <td>400 kcal</td>
                        <td>20 Okt</td>
                        <td><span class="status-badge status-batal">● Batal</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
            <a href="#" style="font-size: 13px; color: #10b981; text-decoration: none; font-weight: 500;">Lihat Semua →</a>
        </div>
    </div>

    <!-- Aktivitas Terakhir -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Aktivitas Terakhir</h2>
            <a href="#" style="font-size: 14px; color: #10b981; text-decoration: none;">Lihat Semua</a>
        </div>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div style="display: flex; gap: 12px; align-items: start;">
                <div style="width: 48px; height: 48px; background-color: #d1fae5; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    🏃
                </div>
                <div style="flex: 1;">
                    <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 4px;">Lari Pagi</h3>
                    <p style="font-size: 13px; color: #6b7280;">Hari ini, 06:00 AM</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-size: 16px; font-weight: 600;">45 Min</p>
                    <p style="font-size: 12px; color: #6b7280;">320 kcal</p>
                </div>
            </div>
            <div style="display: flex; gap: 12px; align-items: start;">
                <div style="width: 48px; height: 48px; background-color: #dbeafe; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    😴
                </div>
                <div style="flex: 1;">
                    <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 4px;">Tidur Malam</h3>
                    <p style="font-size: 13px; color: #6b7280;">Kemarin, 22:30 PM</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-size: 16px; font-weight: 600;">7h 15m</p>
                    <p style="font-size: 12px; color: #6b7280;">Kualitas Baik</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection