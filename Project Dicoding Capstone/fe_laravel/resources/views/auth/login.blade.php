<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VitaTrack</title>
    <meta name="description" content="Masuk ke akun VitaTrack Anda">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(16,185,129,.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(99,102,241,.1) 0%, transparent 50%);
        }
        /* Left Panel */
        .left-panel {
            width: 50%;
            display: flex; align-items: center; justify-content: center;
            padding: 40px;
            position: relative; z-index: 1;
        }
        .left-content { max-width: 400px; }
        .brand {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 48px;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px; font-weight: 700; color: #fff;
        }
        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 38px; font-weight: 800; color: #fff;
            line-height: 1.2; margin-bottom: 16px;
        }
        .hero-title span { color: #10b981; }
        .hero-desc { font-size: 15px; color: #94a3b8; line-height: 1.7; margin-bottom: 32px; }
        .feature-list { display: flex; flex-direction: column; gap: 14px; }
        .feature-item {
            display: flex; align-items: center; gap: 12px;
            font-size: 14px; color: #cbd5e1;
        }
        .feat-icon {
            width: 36px; height: 36px;
            background: rgba(16,185,129,.1);
            border: 1px solid rgba(16,185,129,.2);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }

        /* Right Panel */
        .right-panel {
            width: 50%;
            display: flex; align-items: center; justify-content: center;
            padding: 40px;
            position: relative; z-index: 1;
        }
        .login-box {
            background: rgba(30,41,59,.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .login-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26px; font-weight: 800; color: #fff;
            margin-bottom: 6px;
        }
        .login-sub { font-size: 14px; color: #94a3b8; margin-bottom: 32px; }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: #cbd5e1; margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            background: rgba(15,23,42,.6);
            border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px; color: #f1f5f9;
            outline: none;
            transition: border-color .2s;
            font-family: inherit;
        }
        .form-control::placeholder { color: #475569; }
        .form-control:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.12); }

        .role-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
            margin-bottom: 20px;
        }
        .role-card {
            padding: 14px 12px;
            border: 1.5px solid rgba(255,255,255,.1);
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
            transition: all .2s;
            background: rgba(15,23,42,.4);
        }
        .role-card:hover { border-color: rgba(16,185,129,.5); }
        .role-card.selected {
            border-color: #10b981;
            background: rgba(16,185,129,.1);
        }
        .role-card input { display: none; }
        .role-emoji { font-size: 22px; margin-bottom: 4px; }
        .role-label { font-size: 13px; font-weight: 600; color: #e2e8f0; }
        .role-desc  { font-size: 11px; color: #64748b; margin-top: 2px; }
        .role-card.selected .role-label { color: #10b981; }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
            letter-spacing: .01em;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 6px 24px rgba(16,185,129,.25); }

        .divider {
            text-align: center; position: relative;
            margin: 24px 0;
            color: #475569; font-size: 13px;
        }
        .divider::before, .divider::after {
            content: ''; position: absolute;
            top: 50%; width: calc(50% - 30px);
            height: 1px; background: rgba(255,255,255,.1);
        }
        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        .register-link {
            text-align: center; font-size: 14px; color: #94a3b8;
        }
        .register-link a { color: #10b981; text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }

        .alert-error {
            background: rgba(239,68,68,.15);
            border: 1px solid rgba(239,68,68,.3);
            color: #fca5a5;
            border-radius: 10px; padding: 12px 16px;
            font-size: 13px; margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 24px; }
        }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="left-content">
        <div class="brand">
            <div class="brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M22 12H18L15 21L9 3L6 12H2" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="brand-name">VitaTrack</span>
        </div>
        <h1 class="hero-title">Hidup Sehat<br>Dimulai <span>Dari Sini</span></h1>
        <p class="hero-desc">Platform digital untuk membantu Anda memantau aktivitas olahraga, kualitas tidur, dan membaca artikel kesehatan terpercaya.</p>
        <div class="feature-list">
            <div class="feature-item">
                <div class="feat-icon">🏃</div>
                <span>Lacak aktivitas olahraga harian Anda</span>
            </div>
            <div class="feature-item">
                <div class="feat-icon">🌙</div>
                <span>Monitor kualitas tidur setiap malam</span>
            </div>
            <div class="feature-item">
                <div class="feat-icon">📰</div>
                <span>Baca artikel kesehatan terpercaya</span>
            </div>
        </div>
    </div>
</div>

<div class="right-panel">
    <div class="login-box">
        <div class="login-title">Selamat Datang 👋</div>
        <div class="login-sub">Masuk ke akun VitaTrack Anda</div>

        <div id="alertBox" style="display:none;" class="alert-error"></div>

        <form id="loginForm" onsubmit="handleLogin(event)">


            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="nama@email.com" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login" id="btnLogin">Masuk ke VitaTrack</button>
        </form>

        <div class="divider">atau</div>
        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</div>

<script>


async function handleLogin(e) {
    e.preventDefault();
    const btn = document.getElementById('btnLogin');
    btn.disabled = true; btn.textContent = 'Memproses...';

    const email    = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const res = await fetch('/do-login', {
            method: 'POST',
            headers: {'Content-Type':'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({email, password})
        });
        if(res.ok) {
            const data = await res.json();
            localStorage.setItem('hs_role', data.role);
            localStorage.setItem('hs_email', email);
            if(data.role === 'admin') window.location.href = '{{ route("admin.dashboard") }}';
            else window.location.href = '{{ route("dashboard") }}';
        } else {
            showError('Email atau password salah.');
        }
    } catch(err) {
        showError('Terjadi kesalahan koneksi.');
    }
    btn.disabled = false; btn.textContent = 'Masuk ke VitaTrack';
}

function showError(msg) {
    const el = document.getElementById('alertBox');
    el.textContent = '⚠️ ' + msg;
    el.style.display = 'block';
}
</script>
</body>
</html>
