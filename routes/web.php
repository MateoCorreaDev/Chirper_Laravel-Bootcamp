<?php

use App\Http\Controllers\ChirpController;
use illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index']);