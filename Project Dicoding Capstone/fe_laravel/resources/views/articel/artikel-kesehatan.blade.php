@extends('template.sidebar')

@section('title', 'Artikel Kesehatan - HealthSpace')

@section('content')
<div class="page-header">
    <h1>Artikel Kesehatan</h1>
    <p>Baca artikel kesehatan dan tips hidup sehat</p>
</div>

<div class="grid grid-2">
    <div class="card">
        <div style="width: 100%; height: 150px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 8px; margin-bottom: 16px;"></div>
        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Tips Olahraga yang Efektif</h3>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 12px;">
            Pelajari cara berolahraga dengan efektif dan aman untuk kesehatan Anda.
        </p>
        <a href="#" style="color: #10b981; font-size: 14px; text-decoration: none; font-weight: 500;">Baca Selengkapnya →</a>
    </div>

    <div class="card">
        <div style="width: 100%; height: 150px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 8px; margin-bottom: 16px;"></div>
        <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Pentingnya Tidur Berkualitas</h3>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 12px;">
            Kenapa tidur yang cukup sangat penting untuk kesehatan tubuh dan mental.
        </p>
        <a href="#" style="color: #10b981; font-size: 14px; text-decoration: none; font-weight: 500;">Baca Selengkapnya →</a>
    </div>
</div>
@endsection
