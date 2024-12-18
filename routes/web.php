<?php

use App\Http\Controllers\Admins\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontEnd\DisplayController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;

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

Route::controller(DisplayController::class)->group(function(){
    Route::get('/','welcome');
    Route::post('/addsaran','sendck');
    Route::get('/dashboard','index');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'displaylogin');
    Route::post('/hiddenlogin', 'authenticatelogin');
    Route::get('/register', 'displayregister');
    Route::post('/hiddenregister', 'authenticateregister');
    Route::post('/logout','logout')->middleware('auth');    
});

Route::middleware('CheckRole:admin')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin-profile','profile');
        Route::put('/admin-editprofile/{id}','ubahprofile');
        Route::get('/admin-kritiksaran','acceptcs');
        Route::delete('/admin-deleteks/{id}','deleteks');
        // START CRUD DATA USER
        Route::get('/admin-datauser','userlist');
        Route::get('/admin-adduser','useradd');
        Route::post('/admin-storeuser','userstore');
        Route::get('/admin-edituser/{id}','useredit');
        Route::put('/admin-updateuser/{id}','userupdate');
        Route::delete('/admin-deleteuser/{id}','userdelete');
        // FINISH CRUD DATA USER

        // START CRUD DATA PAKET-MEMBER
        Route::get('/admin-paketmember','adminpm');
        Route::get('/admintambah-paketmember','adminaddpm');
        Route::post('/admin-storepaketmember','adminstorepm');
        Route::get('/admin-editpaketmember/{id}','admineditpm');
        Route::put('/admin-updatepaketmember/{id}','adminupdatepm');
        Route::delete('/admin-deletepaketmember/{id}','admindeletepm');
        // END CRUD DATA PAKET-MEMBER

        // ADD AND UPDATE MEMBER
        Route::get('admin-datamember','adminmemberlist');
        Route::post('admin-newmember','adminnewmember');
        Route::put('admin-updatemember/{id}','adminupdatemember');
        Route::delete('admin-deletemember/{id}','admindeletemember');
        // ADD AND UPDATE MEMBER

        // READ DATA TRANSAKSI SFESIFIK/NON SPESIFIK
        Route::get('admin-datatransaksi','admintf');
        Route::get('/admin-detailtransaksi/{id}','admintfshow');
        // READ DATA TRANSAKSI SFESIFIK/NON SPESIFIK

        // START CRUD FRENTLY ASKED QUESTION
        Route::get('/admin-faq','adminfaq');
        Route::post('admin-newfaq','adminnewfaq');
        Route::put('admin-updatefaq/{id}','adminupdatefaq');
        Route::delete('admin-deletefaq/{id}','admindeletefaq');
        // END CRUD FRENTLY ASKED QUESTION
    });
});

Route::middleware('CheckRole:admin,member')->group(function(){
    Route::controller(BarangController::class)->group(function(){
        Route::get('/barang','index');
        Route::get('/barang-create','create');
        Route::post('/barang-store','store');
        Route::get('/barang-edit/{id}','edit');
        Route::put('/barang-update/{id}','update');
        Route::delete('/barang-hapus/{id}','delete');
    });
});

Route::middleware('CheckRole:member')->group(function(){
    Route::controller(CartController::class)->group(function(){
        Route::get('/keranjang','index');
        Route::post('/tambah-keranjang/{id}','addCart');
        Route::put('/increase-keranjang/{id}','increaseCart');
        Route::patch('/decrease-keranjang/{id}','decreaseCart');
        Route::put('/forceupdate-keranjang/{id}','ForceUpCart');
        Route::delete('/delete-keranjang/{id}','DeleteCart');
    });
    Route::controller(TransaksiController::class)->group(function(){
        Route::get('/transaksi','index');
        Route::post('/store-transaksi','store');
        Route::get('/transaksi-detail/{id}','show');
    });
});

