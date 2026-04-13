<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaTrack - Platform Kesehatan Digital</title>
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
                <span class="logo-text">VitaTrack</span>
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
        <p>&copy; 2024 VitaTrack. All rights reserved.</p>
    </footer>
</body>
</html>
