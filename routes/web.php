<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneratorController;
use App\Http\Middleware\LocalWorkspace;
Route::middleware(LocalWorkspace::class)->group(function () {
    Route::get('/', [GeneratorController::class, 'index']);
    Route::post('/generate', [GeneratorController::class, 'generate']);
    Route::post('/reset', [GeneratorController::class, 'reset']);
    Route::get('/export/{format}', [GeneratorController::class, 'export']);
});
