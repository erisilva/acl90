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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('index');

Route::prefix('admin')->namespace('Admin')->group(function () {
    /*  Operadores */
    # alteração de senha
    Route::get('/users/password', 'ChangePasswordController@showPasswordUpdateForm')->name('users.password');
    Route::put('/users/password/update', 'ChangePasswordController@passwordUpdate')->name('users.passwordupdate');
    # alteração de tema
    Route::get('/users/theme', 'ChangeThemeController@showThemeUpdateForm')->name('users.theme');
    Route::put('/users/theme/update', 'ChangeThemeController@themeUpdate')->name('users.themeupdate');
    # relatorios
    Route::get('/users/export/csv', 'UserController@exportcsv')->name('users.export.csv');
    Route::get('/users/export/xls', 'UserController@exportxls')->name('users.export.xls');
    Route::get('/users/export/pdf', 'UserController@exportpdf')->name('users.export.pdf');
    # crud
    Route::resource('/users', 'UserController');

    /* Permissões */
    # relatorios
    Route::get('/permissions/export/csv', 'PermissionController@exportcsv')->name('permissions.export.csv');
    Route::get('/permissions/export/xls', 'PermissionController@exportxls')->name('permissions.export.xls');
    Route::get('/permissions/export/pdf', 'PermissionController@exportpdf')->name('permissions.export.pdf');
    # crud
    Route::resource('/permissions', 'PermissionController');

    /* Perfis */
    # relatorios
    Route::get('/roles/export/csv', 'RoleController@exportcsv')->name('roles.export.csv');
    Route::get('/roles/export/xls', 'RoleController@exportxls')->name('roles.export.xls');
    Route::get('/roles/export/pdf', 'RoleController@exportpdf')->name('roles.export.pdf');
    # crud
    Route::resource('/roles', 'RoleController');
});