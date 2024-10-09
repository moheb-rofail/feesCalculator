<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FeePresetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\FeePercentageController;
use App\Http\Controllers\CalculateController;

Route::get('/fee_percentages/create/{preset_id}', [FeePercentageController::class, 'create'])->name('fee_percentages.create');
Route::post('/fee_percentages/{preset_id}', [FeePercentageController::class, 'store'])->name('fee_percentages.store');
//Route::get('/fee_percentages/{fee_percentage}', [FeePercentageController::class, 'show'])->name('fee_percentages.show');
Route::get('/fee_percentages/{process_id}/edit/', [FeePercentageController::class, "edit"])->name('fee_percentages.edit');;
Route::put('/fee_percentages/{process_id}', [FeePercentageController::class, 'update'])->name('fee_percentages.update');
Route::delete('/fee_percentages/{process_id}', [FeePercentageController::class, 'destroy'])->name('fee_percentages.destroy');

Route::resource('fee_presets', FeePresetController::class);
Route::resource('services', ServiceController::class);
Route::resource('thresholds', ThresholdController::class);

Route::post('/', [CalculateController::class, 'calculate'])->name('calculate');
Route::get('/', [CalculateController::class, 'index'])->name('index');
