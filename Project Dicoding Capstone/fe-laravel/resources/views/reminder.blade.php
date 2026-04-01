@extends('layout-with-sidebar')

@section('title', 'Reminder - HealthSpace')

@section('content')
<div class="page-header">
    <h1>Reminder</h1>
    <p>Kelola pengingat untuk aktivitas kesehatan Anda</p>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Reminder</h2>
        <button style="padding: 8px 16px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; border-radius: 8px; font-size: 14px; cursor: pointer;">
            + Tambah Reminder
        </button>
    </div>
    <div style="padding: 20px 0;">
        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background-color: #fffbeb; border-radius: 8px; margin-bottom: 12px;">
            <div style="width: 48px; height: 48px; background-color: #fef3c7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                💊
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">Minum Vitamin</h3>
                <p style="font-size: 14px; color: #6b7280;">Setiap hari, 08:00 AM</p>
            </div>
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" style="width: 20px; height: 20px;">
            </label>
        </div>

        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background-color: #dbeafe; border-radius: 8px; margin-bottom: 12px;">
            <div style="width: 48px; height: 48px; background-color: #bfdbfe; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                💧
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">Minum Air</h3>
                <p style="font-size: 14px; color: #6b7280;">Setiap 2 jam</p>
            </div>
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" style="width: 20px; height: 20px;">
            </label>
        </div>

        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background-color: #d1fae5; border-radius: 8px;">
            <div style="width: 48px; height: 48px; background-color: #a7f3d0; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                🏃
            </div>
            <div style="flex: 1;">
                <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 4px;">Olahraga Pagi</h3>
                <p style="font-size: 14px; color: #6b7280;">Senin - Jumat, 06:00 AM</p>
            </div>
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" style="width: 20px; height: 20px;">
            </label>
        </div>
    </div>
</div>
@endsection
