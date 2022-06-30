<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('type', function () {
    $number = 8937834823428923468324565345435000000000000000000000000000000000;

//    return $number;
//    return gettype($number);
//    $number = '8937834823428923468324565345435000000000000000000000000000000000';

//    $num = explode('\'', $number);
//    return $num[0] + 1;
//    return $number + 1 ;

    $data = \App\Models\Wallet::query()->create([
        'address' => \Illuminate\Support\Str::random(10),
        'balance' => strval($number)
    ]);
    $data = \App\Models\Wallet::query()->find($data->id);
    return $data;
});
