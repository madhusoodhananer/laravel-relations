<?php

use App\Models\Address;
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

Route::get('/create-address', function () {
    Address::create([
        'user_id' => 1,
        'address' => '123 Main St',
    ]);

    Address::create([
        'user_id' => 5,
        'address' => 'tpm',
    ]);

    Address::create([
        'user_id' => 6,
        'address' => 'kunduthode',
    ]);

    Address::create([
        'user_id' => 7,
        'address' => 'kozhikode',
    ]);
});
/*
* This code snippet defines a route in a PHP application
* The route responds to a GET request to "/user-address"
* When the route is accessed, it retrieves a user from the database along with their associated address using the `User` model
* The `with()` method is used to eager load the `address` relation, optimizing the database query
* The user data, along with the associated address, is then returned as the response
*/
Route::get('/user-address', function () {
    $user = User::with('address')->get();
    return $user;
});

/*
* This code snippet defines a route in a PHP application
* The route responds to a GET request to "/address-user"
* When the route is accessed, it retrieves an address from the database along with its associated user using the `Address` model
* The `with()` method is used to eager load the `user` relation, optimizing the database query
* The address data, along with the associated user, is then returned as the response
*/

Route::get('/address-user', function () {
    $address = Address::with('user')->get();
    return $address;
});

/*
* This code snippet defines a route in a PHP application
* The route responds to a GET request to "/uua"
* When the route is accessed, it retrieves users from the database along with their associated addresses using the `User` model
* The `with()` method is used to eager load the `address` relation, optimizing the database query
* The user data is then iterated using a foreach loop, and for each user, their name and address are echoed as HTML headings and paragraphs
*/
Route::get('uua', function () {
    $user = User::with('address')->get();
    foreach($user as $u){
        echo (
            "<h1>" . $u->name . "</h1>" . $u->address->address."<br>"
        );
    }
});

Route::get('uau', function () {
    $address = Address::with('user')->get();
    foreach($address as $a){
        echo (
            "<h1>" . $a->address . "</h1>" . $a->user->name."<br>"
        );
    }
});

