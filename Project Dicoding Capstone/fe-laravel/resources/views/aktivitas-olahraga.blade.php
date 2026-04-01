@extends('layout-with-sidebar')

@section('title', 'Aktivitas Olahraga - HealthSpace')

@section('content')
<div class="page-header">
    <h1>Aktivitas Olahraga</h1>
    <p>Lacak dan kelola aktivitas olahraga Anda</p>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Aktivitas</h2>
        <button style="padding: 8px 16px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 8px; font-size: 14px; cursor: pointer;">
            + Tambah Aktivitas
        </button>
    </div>
    <p style="color: #6b7280; text-align: center; padding: 60px 20px;">
        Konten halaman Aktivitas Olahraga akan ditampilkan di sini.
    </p>
</div>
@endsection
