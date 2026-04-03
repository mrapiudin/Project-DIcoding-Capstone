# -*- coding: utf-8 -*-
import os

# Landing Page Content
landing_page_content = '''<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthSpace - Platform Kesehatan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.01em;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            font-family: 'Space Grotesk', sans-serif;
        }

        .nav-buttons {
            display: flex;
            gap: 16px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-outline {
            background: transparent;
            color: #059669;
            border: 2px solid #059669;
        }

        .btn-outline:hover {
            background: #059669;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .hero {
            padding: 150px 24px 100px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 24px;
            line-height: 1.2;
        }

        .hero .highlight {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 20px;
            color: #6b7280;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-bottom: 60px;
        }

        .hero-image {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .features {
            padding: 100px 24px;
            background: white;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 42px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }

        .section-title p {
            font-size: 18px;
            color: #6b7280;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
        }

        .feature-card {
            background: #f9fafb;
            padding: 32px;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .feature-card h3 {
            font-size: 22px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.7;
        }

        .cta {
            padding: 100px 24px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            text-align: center;
            color: white;
        }

        .cta h2 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .cta p {
            font-size: 18px;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .btn-white {
            background: white;
            color: #059669;
            padding: 16px 40px;
            font-size: 16px;
        }

        .btn-white:hover {
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .footer {
            background: #111827;
            color: white;
            padding: 40px 24px;
            text-align: center;
        }

        .footer p {
            color: #9ca3af;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .section-title h2 {
                font-size: 32px;
            }

            .cta h2 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="logo-text">HealthSpace</span>
            </a>
            <div class="nav-buttons">
                <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Kelola Kesehatanmu dengan <span class="highlight">Lebih Mudah</span></h1>
        <p>Platform kesehatan digital yang membantu kamu tracking aktivitas, pola tidur, dan hidrasi dengan mudah dan menyenangkan</p>
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 16px; padding: 16px 40px;">Mulai Sekarang</a>
            <a href="#features" class="btn btn-outline" style="font-size: 16px; padding: 16px 40px;">Lihat Fitur</a>
        </div>
        <div class="hero-image">
            <div style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #6b7280; font-size: 18px;">
                📊 Dashboard Preview
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="features-container">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
                <p>Semua yang kamu butuhkan untuk hidup lebih sehat</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🏃</div>
                    <h3>Tracking Aktivitas Olahraga</h3>
                    <p>Catat dan pantau semua aktivitas olahraga kamu dengan mudah. Lihat progress dan capai target kesehatanmu.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">😴</div>
                    <h3>Monitor Pola Tidur</h3>
                    <p>Analisis kualitas tidur kamu setiap malam dan dapatkan insight untuk tidur yang lebih berkualitas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💧</div>
                    <h3>Reminder Minum Air</h3>
                    <p>Jangan lupa hidrasi! Tracking konsumsi air harian dan dapatkan reminder agar tetap terhidrasi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Statistik Lengkap</h3>
                    <p>Dashboard interaktif dengan visualisasi data kesehatan yang mudah dipahami.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Akses Kapan Saja</h3>
                    <p>Platform responsive yang bisa diakses dari smartphone, tablet, atau komputer.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Artikel Kesehatan</h3>
                    <p>Baca artikel kesehatan terkini dan tips untuk hidup lebih sehat setiap hari.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Siap Untuk Hidup Lebih Sehat?</h2>
        <p>Bergabung dengan ribuan pengguna yang sudah merasakan manfaatnya</p>
        <a href="{{ route('register') }}" class="btn btn-white">Daftar Sekarang - Gratis!</a>
    </section>

    <footer class="footer">
        <p>&copy; 2024 HealthSpace. All rights reserved.</p>
    </footer>
</body>
</html>'''

# Login Page Content
login_page_content = '''<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - HealthSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        h1, h2, h3 {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.01em;
        }

        .login-container {
            max-width: 440px;
            width: 100%;
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            display: block;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 15px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .forgot-password {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-password:hover {
            color: #059669;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-login:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .divider {
            text-align: center;
            margin: 24px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #9ca3af;
            font-size: 14px;
            position: relative;
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6b7280;
        }

        .register-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 24px;
        }

        .back-home a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            opacity: 0.9;
        }

        .back-home a:hover {
            opacity: 1;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="logo-text">HealthSpace</span>
        </div>

        <div class="login-card">
            <div class="login-header">
                <h1>Selamat Datang Kembali!</h1>
                <p>Masuk ke akun kamu untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>

        <div class="back-home">
            <a href="{{ route('landing-page') }}">← Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>'''

# Register Page Content
register_page_content = '''<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - HealthSpace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        h1, h2, h3 {
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: -0.01em;
        }

        .register-container {
            max-width: 480px;
            width: 100%;
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            display: block;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .register-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .register-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .register-header p {
            font-size: 15px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .terms {
            display: flex;
            align-items: start;
            gap: 8px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #6b7280;
        }

        .terms input[type="checkbox"] {
            width: auto;
            margin-top: 3px;
            cursor: pointer;
        }

        .terms a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .terms a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-register:hover {
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            text-align: center;
            margin: 24px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #9ca3af;
            font-size: 14px;
            position: relative;
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6b7280;
        }

        .login-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 24px;
        }

        .back-home a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            opacity: 0.9;
        }

        .back-home a:hover {
            opacity: 1;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }

        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }

        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo">
            <div class="logo-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="logo-text">HealthSpace</span>
        </div>

        <div class="register-card">
            <div class="register-header">
                <h1>Buat Akun Baru</h1>
                <p>Mulai perjalanan hidup sehatmu sekarang!</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" placeholder="John" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-bar-fill" id="strengthBar"></div>
                        </div>
                        <span id="strengthText" style="color: #9ca3af;">Password harus minimal 8 karakter</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang password" required>
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" style="font-weight: normal; margin-bottom: 0;">
                        Dengan mendaftar, saya menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                    </label>
                </div>

                <button type="submit" class="btn-register">Daftar Sekarang</button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>

        <div class="back-home">
            <a href="{{ route('landing-page') }}">← Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            strengthBar.className = 'strength-bar-fill';
            
            if (strength === 0) {
                strengthText.textContent = 'Password harus minimal 8 karakter';
                strengthText.style.color = '#9ca3af';
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah';
                strengthText.style.color = '#ef4444';
            } else if (strength === 3) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Password sedang';
                strengthText.style.color = '#f59e0b';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Password kuat';
                strengthText.style.color = '#10b981';
            }
        });
    </script>
</body>
</html>'''

# Write all files
with open(r'd:\Project DIcoding Capstone\Project Dicoding Capstone\fe_laravel\resources\views\auth\landing-page.blade.php', 'w', encoding='utf-8') as f:
    f.write(landing_page_content)
    
with open(r'd:\Project DIcoding Capstone\Project Dicoding Capstone\fe_laravel\resources\views\auth\login.blade.php', 'w', encoding='utf-8') as f:
    f.write(login_page_content)
    
with open(r'd:\Project DIcoding Capstone\Project Dicoding Capstone\fe_laravel\resources\views\auth\register.blade.php', 'w', encoding='utf-8') as f:
    f.write(register_page_content)

print("✅ Landing page created successfully!")
print("✅ Login page created successfully!")
print("✅ Register page created successfully!")
