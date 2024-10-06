<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FeePresetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\FeePercentageController;
use App\Http\Controllers\CalculateController;

Route::resource('fee_percentages', FeePercentageController::class);
Route::resource('fee_presets', FeePresetController::class);
Route::resource('services', ServiceController::class);
Route::resource('thresholds', ThresholdController::class);

Route::post('/', [CalculateController::class, 'calculate'])->name('calculate');
Route::get('/', [CalculateController::class, 'index'])->name('index');
