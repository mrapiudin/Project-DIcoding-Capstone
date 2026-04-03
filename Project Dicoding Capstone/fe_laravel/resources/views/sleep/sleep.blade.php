@extends('template.sidebar')

@section('title', 'Tracking Tidur - HealthSpace')

@section('content')
<div class="page-header">
    <h1>Tracking Tidur</h1>
    <p>Monitor kualitas tidur Anda setiap malam</p>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Riwayat Tidur</h2>
        <button style="padding: 8px 16px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 8px; font-size: 14px; cursor: pointer;">
            + Catat Tidur
        </button>
    </div>
    <p style="color: #6b7280; text-align: center; padding: 60px 20px;">
        Konten halaman Tracking Tidur akan ditampilkan di sini.
    </p>
</div>
@endsection
