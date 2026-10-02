<?php
// routes/web.php
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('activities.index'));

Route::resource('activities', ActivityController::class);
Route::post('activities/{activity}/publish',  [ActivityController::class, 'publish'])->name('activities.publish');
Route::post('activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');
Route::get('activities-trash',                [ActivityController::class, 'trash'])->name('activities.trash');
Route::post('activities-trash/{id}/restore',  [ActivityController::class, 'restore'])->name('activities.restore');

Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store', 'destroy']);

Route::post('activities/{activity}/registrations', [RegistrationController::class, 'store'])->name('activities.registrations.store');
