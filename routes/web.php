<?php

use Illuminate\Support\Facades\Route;
use App\Blog;
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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/','HomeController@index')->name('home');
Route::get('/profile/{id}','HomeController@myProfile')->name('profile');
Auth::routes();



//admin routers
Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::get('/logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});
Route::resource('/admin/events','Admin\EventController');
Route::put('/admin/events/restore/{event}',[
    'uses'	=>'Admin\EventController@restore',
    'as'	=>'event.restore'
]);

Route::delete('/admin/events/forceDestroy/{event}',[
    'uses'	=>'Admin\EventController@forceDestroy',
    'as'	=>'event.force-destroy'
]);


