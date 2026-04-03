@extends('template.sidebar')

@section('title', 'Profile - HealthSpace')

@section('content')
<div class="page-header">
    <h1>Profile</h1>
    <p>Kelola informasi profil dan pengaturan akun Anda</p>
</div>

<div class="grid grid-2">
    <!-- Profile Card -->
    <div class="card">
        <div style="text-align: center; padding: 20px;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 36px; color: white; font-weight: 600;">
                B
            </div>
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 4px;">Budi</h2>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">budi@healthspace.com</p>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 24px;">
                <div style="text-align: center;">
                    <p style="font-size: 24px; font-weight: 600; color: #10b981;">156</p>
                    <p style="font-size: 12px; color: #6b7280;">Aktivitas</p>
                </div>
                <div style="text-align: center;">
                    <p style="font-size: 24px; font-weight: 600; color: #3b82f6;">32</p>
                    <p style="font-size: 12px; color: #6b7280;">Hari Aktif</p>
                </div>
                <div style="text-align: center;">
                    <p style="font-size: 24px; font-weight: 600; color: #f59e0b;">12</p>
                    <p style="font-size: 12px; color: #6b7280;">Target</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Card -->
    <div class="card">
        <h2 class="card-title" style="margin-bottom: 20px;">Informasi Pribadi</h2>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; color: #374151;">Nama Lengkap</label>
                <input type="text" value="Budi" style="width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; color: #374151;">Email</label>
                <input type="email" value="budi@healthspace.com" style="width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; color: #374151;">Usia</label>
                <input type="number" value="28" style="width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; color: #374151;">Tinggi Badan (cm)</label>
                <input type="number" value="170" style="width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <div>
                <label style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; color: #374151;">Berat Badan (kg)</label>
                <input type="number" value="65" style="width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;">
            </div>
            <button style="width: 100%; padding: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; margin-top: 8px;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
@endsection
