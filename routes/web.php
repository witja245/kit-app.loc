<?php
use \App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::resource('files', FileController::class);
