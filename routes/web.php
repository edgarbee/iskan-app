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
    return redirect()->route('login');
});

Auth::routes([ 'confirm' => false, 'forgot' => false, 'login' => true, 'register' => true, 'reset' => false, 'verification' => false, ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [App\Http\Controllers\MainController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'dz', 'middleware' => ['auth', 'seller']], function () {
    Route::get('/', [App\Http\Controllers\MainController::class, 'createDz'])->name('index');

    Route::get('/history/{dz_id}', [App\Http\Controllers\MainController::class, 'historyDz'])->name('historyDz');

    Route::post('/search-client', [App\Http\Controllers\MainController::class, 'searchClient'])->name('searchClient');
    Route::post('/search-perevozchik', [App\Http\Controllers\MainController::class, 'searchPerevozchik'])->name('searchPerevozchik');
    Route::post('/search-company', [App\Http\Controllers\MainController::class, 'searchCompany'])->name('searchCompany');

    Route::post('/generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF'])->name('generatePDF');

    Route::post('/add-perevozchik', [App\Http\Controllers\MainController::class, 'addPerevozchik'])->name('addPerevozchik');
});

Route::group(['prefix' => 'sb', 'middleware' => ['auth', 'sb']], function () {
    Route::get('/', [App\Http\Controllers\SBController::class, 'index'])->name('sb_index');
    Route::get('/my', [App\Http\Controllers\SBController::class, 'my'])->name('my');
    Route::get('/cancel', [App\Http\Controllers\SBController::class, 'cancel'])->name('cancel');

    Route::get('/perevozchik-sb/{id}', [App\Http\Controllers\SBController::class, 'sbSearch'])->name('sbSearch');

    // Route::post('/perevozchik-sb/status', [App\Http\Controllers\SBController::class, 'sbStatus'])->name('sbStatus');

    Route::post('/search-client', [App\Http\Controllers\SBController::class, 'searchClientSB'])->name('searchClientSB');
    Route::post('/generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDFSB'])->name('generatePDFSB');

    Route::group(['prefix' => 'perevozchik'], function () {
        Route::get('/', [App\Http\Controllers\SBController::class, 'sb_perevozchik'])->name('sb_perevozchik_index');
    });

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin_index');

    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'clients'])->name('clients_index');
        Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'clientsShow'])->name('clientsShow');
        Route::post('/edit', [App\Http\Controllers\AdminController::class, 'clientsEdit'])->name('clientsEdit');
        Route::post('/add', [App\Http\Controllers\AdminController::class, 'clientsAdd'])->name('clientsAdd');
        Route::post('/delete', [App\Http\Controllers\AdminController::class, 'clientsDelete'])->name('clientsDelete');
        Route::post('/export', [App\Http\Controllers\AdminController::class, 'excelClients'])->name('excelClients');
        Route::post('/dop-zagruzka', [App\Http\Controllers\AdminController::class, 'dopZagruzka'])->name('dopZagruzka');
        Route::post('/dop-vigruzka', [App\Http\Controllers\AdminController::class, 'dopVigruzka'])->name('dopVigruzka');
    });

    Route::group(['prefix' => 'perevozchik'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'perevozchik'])->name('perevozchik_index');
        Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'perevozchikShow'])->name('perevozchikShow');
        Route::post('/edit', [App\Http\Controllers\AdminController::class, 'perevozchikEdit'])->name('perevozchikEdit');
        Route::post('/add', [App\Http\Controllers\AdminController::class, 'perevozchikAdd'])->name('perevozchikAdd');
        Route::post('/delete', [App\Http\Controllers\AdminController::class, 'perevozchikDelete'])->name('perevozchikDelete');
        Route::post('/export', [App\Http\Controllers\AdminController::class, 'excelPerevozchik'])->name('excelPerevozchik');
    });

    Route::group(['prefix' => 'company'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'company'])->name('company_index');
        Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'companyShow'])->name('companyShow');
        Route::post('/edit', [App\Http\Controllers\AdminController::class, 'companyEdit'])->name('companyEdit');
        Route::post('/add', [App\Http\Controllers\AdminController::class, 'companyAdd'])->name('companyAdd');
        Route::post('/delete', [App\Http\Controllers\AdminController::class, 'companyDelete'])->name('companyDelete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'users'])->name('users_index');
        Route::get('/{id}', [App\Http\Controllers\AdminController::class, 'usersShow'])->name('usersShow');
        Route::post('/edit', [App\Http\Controllers\AdminController::class, 'usersEdit'])->name('usersEdit');
        Route::post('/add', [App\Http\Controllers\AdminController::class, 'usersAdd'])->name('usersAdd');
        Route::post('/delete', [App\Http\Controllers\AdminController::class, 'usersDelete'])->name('usersDelete');
    });
});
