<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\TapeController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', function () {
        $movies = DB::table('movie')
            ->leftJoin('tape', 'movie.movie_id', '=', 'tape.movie_id')
            ->select('movie.*', DB::raw('COUNT(CASE WHEN tape.status = "available" THEN 1 END) as available_copies'), DB::raw('COUNT(CASE WHEN tape.status = "rented" THEN 1 END) as rented_copies'), DB::raw('COUNT(tape.tape_number) as total_copies'))
            ->groupBy('movie.movie_id', 'movie.title', 'movie.category', 'movie.director', 'movie.year', 'movie.image')
            ->orderBy('movie.title')
            ->get();
        return view('dashboard', compact('movies'));
    })->name('dashboard');

    Route::resource('movies', MovieController::class);
    Route::resource('actors', ActorController::class);
    Route::resource('tapes', TapeController::class);
    Route::resource('shelves', ShelfController::class);
    Route::resource('users', UserController::class);

    Route::post('/tapes/{tape}/rent', [TapeController::class, 'rent'])->name('tapes.rent');
    Route::post('/tapes/{tape}/return', [TapeController::class, 'returnTape'])->name('tapes.return');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/audit-logs', function() {
    $logs = DB::table('audit_logs')
        ->join('users', 'audit_logs.user_id', '=', 'users.id')
        ->select('audit_logs.*', 'users.username')
        ->orderByDesc('audit_logs.created_at')
        ->get();
    return view('audit_logs', compact('logs'));
})->name('audit-logs');

});