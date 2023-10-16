<?php

use App\Models\Car;
use App\Models\Mechanic;
use App\Models\Owner;
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

Route::get('create-mechanic', function () {
    Mechanic::create([
        'name' => fake()->name(),
        'user_id' => fake()->randomElement([1,5,6,7])
    ]);
});

Route::get('create-car', function () {
    Car::create([
        'name' => fake()->name(),
        'mechanic_id' => fake()->randomElement([1,2,3,4,5,6,7])
    ]);
});

Route::get('create-owner', function () {
    Owner::create([
        'name' => fake()->name(),
        'car_id' => fake()->randomElement([1,2,3,4,5,6])
    ]);
});

Route::get('get-car-owner', function () {
    $owner = Mechanic::with(['carOwner' => function($q){
        $q->whereNotNull('car_id');
    },'user'])->get();
    return response()->json($owner);
});