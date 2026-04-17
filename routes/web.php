<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
// use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', function () {
    return Inertia::render('Login');
});

Route::post('/login', function (Request $request) {
    if (
        $request->email === 'admin@test.com' &&
        $request->password === '123456'
    ) {
        session(['login' => true]);
        return redirect('/tasks');
    }

    return back()->withErrors([
        'message' => 'Invalid credentials'
    ]);
});

Route::middleware('simpleauth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});
