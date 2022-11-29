<?php

use App\Http\Controllers\Api\PasswordController;
use Illuminate\Support\Facades\Route;

Route::post('/verify', PasswordController::class)->name('verify.password');


