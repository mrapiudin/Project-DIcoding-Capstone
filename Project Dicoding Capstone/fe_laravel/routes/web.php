<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ApiProxyController;

/*
|--------------------------------------------------------------------------
| Web Routes — VitaTrack Frontend
|--------------------------------------------------------------------------
*/

// ─ Root redirect ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    if (session('role') === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (session('role') === 'user') {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// ─ Auth ──────────────────────────────────────────────────────────────────────
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Handle mockup login
Route::post('/do-login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Cek kecocokan berdasarkan seeder db
    if ($request->email === 'admin@VitaTrack.com' && $request->password === 'admin123') {
        $role = 'admin';
        $name = 'Admin User';
    } 
    // Fallback untuk semua test akun login (user)
    else if ($request->password === 'user123') {
        $role = 'user';
        $name = explode('@', $request->email)[0];
    } 
    else {
        return response()->json(['message' => 'Email atau Password salah'], 401);
    }

    // Setup session mockup
    session([
        'user_id' => 1,
        'user_name' => ucfirst($name),
        'user_email' => $request->email,
        'role' => $role,
    ]);

    return response()->json(['status' => 'success', 'role' => $role]);
});

Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('login');
})->name('logout');

// ─ Frontend API Proxy ────────────────────────────────────────────────────────
// Ini memungkinkan frontend Javascript melakukan fetch ke /api/* di route SAMA domain,
// yang kemudian diteruskan oleh Laravel ke backend Lumen.
// Ini mencegah semua problem CORS.
Route::prefix('api')->group(function () {
    // Activities
    Route::get('/activities', [ApiProxyController::class, 'activitiesIndex']);
    Route::post('/activities', [ApiProxyController::class, 'activitiesStore']);
    Route::get('/activities/{id}', [ApiProxyController::class, 'activitiesShow']);
    Route::put('/activities/{id}', [ApiProxyController::class, 'activitiesUpdate']);
    Route::delete('/activities/{id}', [ApiProxyController::class, 'activitiesDestroy']);

    // Sleep
    Route::get('/sleep', [ApiProxyController::class, 'sleepIndex']);
    Route::post('/sleep', [ApiProxyController::class, 'sleepStore']);
    Route::get('/sleep/{id}', [ApiProxyController::class, 'sleepShow']);
    Route::put('/sleep/{id}', [ApiProxyController::class, 'sleepUpdate']);
    Route::delete('/sleep/{id}', [ApiProxyController::class, 'sleepDestroy']);

    // Articles
    Route::get('/articles', [ApiProxyController::class, 'articlesIndex']);
    Route::post('/articles', [ApiProxyController::class, 'articlesStore']);
    Route::get('/articles/{id}', [ApiProxyController::class, 'articlesShow']);
    Route::put('/articles/{id}', [ApiProxyController::class, 'articlesUpdate']);
    Route::delete('/articles/{id}', [ApiProxyController::class, 'articlesDestroy']);

    // Users
    Route::get('/users', [ApiProxyController::class, 'usersIndex']);
    Route::post('/users', [ApiProxyController::class, 'usersStore']);
    Route::get('/users/{id}', [ApiProxyController::class, 'usersShow']);
    Route::put('/users/{id}', [ApiProxyController::class, 'usersUpdate']);
    Route::delete('/users/{id}', [ApiProxyController::class, 'usersDestroy']);
});

// ─ User Routes ───────────────────────────────────────────────────────────────
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/aktivitas-olahraga', function () {
    return view('activity.activity');
})->name('aktivitas-olahraga');

Route::get('/tracking-tidur', function () {
    return view('sleep.sleep');
})->name('tracking-tidur');

Route::get('/artikel-kesehatan', function () {
    return view('articel.artikel-kesehatan');
})->name('artikel-kesehatan');

Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');

// ─ Admin Routes ──────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // ─ Artikel CRUD
    Route::prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', function () { return view('admin.artikel.index'); })->name('index');
        Route::get('/create', function () { return view('admin.artikel.create'); })->name('create');
        Route::get('/{id}/edit', function ($id) { return view('admin.artikel.edit', ['id' => $id]); })->name('edit');
    });

    // ─ Users CRUD
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');

    // ─ Activities
    Route::get('/activities', function () {
        return view('admin.activities.index');
    })->name('activities.index');

    // ─ Sleep
    Route::get('/sleep', function () {
        return view('admin.sleep.index');
    })->name('sleep.index');
});
