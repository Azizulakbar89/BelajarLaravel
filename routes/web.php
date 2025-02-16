<?php

use illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

// contoh
// Route::get('/blog', function () {
//     //routes untuk menampilkan tulisan blog
//     return ('blog');

//     // route untuk menampilkan blade blog
//     // return view('blog');

//     // untuk memanggil data di view atau menampilkan var data ke view (passing data)
//     // return view('blog', ['data' => 'jijul']);

//     // routes untuk menampilkan perhitungan langsung
//     // $a = 1;
//     // $b = 2;
//     // $c = $a + $b;
//     // return ('hasil: ' . $c);
// });

// route langsung tanpa adanya aksi
// Route::view('/blog1', 'welcome');

// Route::view('/blog', 'blog', ['data' => 'jijul']);

// named routed untuk fitur redirect
// Route::get('/blog', function () {
//     $profile = 'aku jijul';
//     return view('blog', ['data' => $profile]);
// })->name('blog');

// Route::get('/blog/{id}', function (Request $request) {
//     return redirect()->route('blog');
// });

// paramater atau menampilkan berdasarkan id
// Route::get('/blog/1', function () {
//     return ('ini adalah blog');
// });

// parameter id dinamis
// Route::get('/blog/{id}', function ($id) {
//     return ('ini adalah blog' . $id);
// });

// parameter request dari input data 
// Route::get('/blog/{id}', function (Request $request) {
//     return ('ini adalah blog' . $request->id);
// });

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

//Querybuilder
// Route::get('/blog/{id}', function (Request $request) {
//     return 'tes' . $request->id;
// });

Route::get('/blog/add', [BlogController::class, 'add']);
Route::post('/blog/create', [BlogController::class, 'create']);
Route::get('/blog/{id}/detail', [BlogController::class, 'show']);
Route::get('/blog/{id}/edit', [BlogController::class, 'edit']);
Route::patch('/blog/{id}/up', [BlogController::class, 'up']);
Route::get('/blog/{id}/delete', [BlogController::class, 'delete']);
Route::get('/blog/{id}/restore', [BlogController::class, 'restore']);
