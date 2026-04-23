<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PreferenceController;

Route::get('/', function () { return view('welcome_restaurant'); });
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/fixtures', [AdminController::class, 'runFixtures'])->name('fixtures');

Route::middleware('auth.basic:web,username')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
});

Route::get('/charts/{type}', [ChartController::class, 'show'])->name('charts.show');

Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
Route::get('/files/download/{name}', [FileController::class, 'download'])->name('files.download');
Route::get('/files/delete/{name}', [FileController::class, 'delete'])->name('files.delete');

Route::get('/settings', [PreferenceController::class, 'index'])->name('settings.index');
Route::post('/settings', [PreferenceController::class, 'store'])->name('settings.store');

Route::get('/about', function () { return view('about'); });
Route::get('/contacts', function () { return view('contacts'); });
