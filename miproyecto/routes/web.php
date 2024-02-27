<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/prueba', function () {
    return "Hola Mundo";
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Funcionaria si hubiera creado el controlador en singular
//Route::resource('contacts', ContactsController::class);

Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contacts}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contacts}', [ContactsController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contacts}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
Route::get('/contacts/{contacts}', [ContactsController::class, 'show'])->name('contacts.show');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');


// Ejercicio 4
Route::resource('products', ProductController::class);


// Test Ejercicio 3
// Route::post('/ejercicio3', function (Request $request) {
//     $request->validate([
//         'name' => 'required|string|max:64',
//         'description' => 'required|string|max:512',
//         'price' => 'required|numeric|gt:0',
//         'has_battery' => 'required|boolean',
//         'battery_duration' => 'required_if:has_battery,true|numeric|gt:0',
//         'colors' => 'required|array',
//         'colors.*' => 'required|string',
//         'dimensions' => 'required|array',
//         'dimensions.width' => 'required|numeric|gt:0',
//         'dimensions.height' => 'required|numeric|gt:0',
//         'dimensions.length' => 'required|numeric|gt:0',
//         'accessories' => 'required|array',
//         'accessories.*' => 'required|array',
//         'accessories.*.name' => 'required|string',
//         'accessories.*.price' => 'required|numeric|gt:0',
//     ]);    
//     return response();
// });

// Route::get('/contacts', function () {
//     if (Auth::check()) {
//         return Response::view('contacts');
//     } else {
//         return response("Not Authenticated", 401);
//         // return (new HttpResponse("NOT AUTHENTICATED))->setStatusCode(401):
//     }
// });

// Route::post('/contacts', function (Request $request) {
//    $data = $request->all();
     
//    // Un controlador será una clase cuya única función sera controlar a este Modelo
//    // Esta es la parte del modelo (MVC Modelo-Vista-Controlador)
//    Contacts::create($data);
    
// //    $contact = new Contacts();
// //    $contact->name = $data["name"];
// //    $contact->phone_number = $data["phone_number"];
// //    $contact->save();

//    return "Contact saved";
// });
