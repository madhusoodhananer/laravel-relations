<?php

use App\Models\Phone;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phone-create', function () {
    $user = User::findOrFail(6)->phones()->create([
        'phone' => fake()->phoneNumber(),
    ]);
});

Route::get('user-phone', function () {
    $users = User::with('phones')->get();
    return response()->json($users);
});

Route::get('phone-user', function () {
    $phone = Phone::with('user')->get();
    return response()->json($phone);
});