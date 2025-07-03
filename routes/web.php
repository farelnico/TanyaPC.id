<?php

use Illuminate\Support\Facades\Route;

/* ---------- PUBLIC CONTROLLERS ---------- */
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ConsultantListController;
use App\Http\Controllers\ConsultantController;

/* ---------- ADMIN CONTROLLERS ---------- */
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminConsultantController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminUserController;

/* =======================================================
|  1.  HALAMAN PUBLIK  (bebas akses)
|=======================================================*/
Route::view('/',                 'layout');            // beranda
Route::view('/layout',           'layout');
Route::view('/tentang_kami',     'tentang_kami');
Route::view('/konten_konseling', 'konten_konseling');

/* daftar konsultan */
Route::get('/konseling_online',  [ConsultantListController::class,'online' ])->name('consult.online');
Route::get('/konseling_offline', [ConsultantListController::class,'offline'])->name('consult.offline');

/* detail konsultan */
Route::get('/konsultan/{consultant:slug}', [ConsultantController::class,'show'])
      ->name('consultant.show');

/* =======================================================
|  2.  AUTENTIKASI TAMU  (login / register)
|=======================================================*/
Route::middleware('guest')->group(function () {
    Route::get ('/login',    [AuthController::class,'showLogin'   ])->name('login');
    Route::post('/login',    [AuthController::class,'login'       ]);

    Route::get ('/register', [AuthController::class,'showRegister'])->name('register');
    Route::post('/register', [AuthController::class,'register'    ]);
});

/* =======================================================
|  3.  LOGOUT  (user sudah login)
|=======================================================*/
Route::post('/logout', [AuthController::class,'logout'])
      ->middleware('auth')
      ->name('logout');

/* =======================================================
|  4.  RUTE WAJIB LOGIN  (profil & booking user)
|=======================================================*/
Route::middleware('auth')->group(function () {

    /* ---- Profil ---- */
    Route::get ('/profile', [ProfileController::class,'edit'  ])->name('profile.edit');
    Route::post('/profile', [ProfileController::class,'update'])->name('profile.update');

    /* ---- Booking BARU (form & simpan) ---- */
    Route::get ('/booking/{consultant:slug}', [BookingController::class,'create'])->name('booking.create');
    Route::post('/booking/{consultant:slug}', [BookingController::class,'store'  ])->name('booking.store');

    /* ---- Tiket booking (detail) ---- */
    Route::get ('/booking/tiket/{booking}',
        [BookingController::class,'show'])
        ->name('booking.show')
        ->middleware('can:view,booking');

    /* ---- Daftar booking user (riwayat) ---- */
    Route::get('/my-bookings', [BookingController::class,'index'])
        ->name('booking.list');

    /* ------ BOOKING SAYA (list) ------ */
    Route::get('/booking',            //   url:  /booking
        [BookingController::class,'index'])
        ->name('booking.list')
        ->middleware('auth');

});

/* =======================================================
|  5.  ADMIN PANEL  (/admin) – role = admin
|=======================================================*/
Route::prefix('admin')
      ->middleware(['auth','admin'])
      ->name('adm.')
      ->group(function () {

    /* ---- Dashboard ---- */
    Route::get('/', [AdminDashboardController::class,'index'])->name('dashboard');

    /* ---- Konsultan CRUD ---- */
    Route::get ('consultants',               [AdminConsultantController::class,'index' ])->name('consult.index');
    Route::get ('consultants/create',        [AdminConsultantController::class,'create'])->name('consult.create');
    Route::post('consultants',               [AdminConsultantController::class,'store' ])->name('consult.store');
    Route::get ('consultants/{id}/edit',     [AdminConsultantController::class,'edit'  ])->name('consult.edit');
    Route::put ('consultants/{id}',          [AdminConsultantController::class,'update'])->name('consult.update');
    Route::post('consultants/{id}/toggle',   [AdminConsultantController::class,'toggle'])->name('consult.toggle');

    /* ---- Booking list & status ---- */
    Route::get ('bookings',                  [AdminBookingController::class,'index'       ])->name('book.index');
    Route::post('bookings/{booking}/status', [AdminBookingController::class,'updateStatus'])->name('book.status');

    /* ---- User list ---- */
    Route::get ('users',                     [AdminUserController::class,'index'])->name('user.index');

    
});
