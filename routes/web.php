<?php

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

use App\SysUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

Auth::routes(['register'=>false]);

Route::get('/', 'Auth\LoginController@showLoginForm');

if(env('UNIT_TEST_CICD')==true){
    $model = [];
}else{
    $model = DB::table('permissions')->where('type',0)->get();
}

// print_r($model);exit;
foreach ($model as $row) {
    $params = $row->params ? '/'.$row->params : '';
    if($row->name){
        if($row->method=='get'){
            Route::get($row->name.$params, $row->controller.'Controller@'.$row->action)->middleware('can:'.$row->name);
        }else if($row->method=='post'){
            if($row->alias){
                Route::post($row->name.$params, $row->controller.'Controller@'.$row->action)->name($row->alias)->middleware('can:'.$row->name);
            }else{
                Route::post($row->name.$params, $row->controller.'Controller@'.$row->action)->middleware('can:'.$row->name);
            }
        }else if($row->method=='put'){
            if($row->alias){
                Route::put($row->name.$params, $row->controller.'Controller@'.$row->action)->name($row->alias)->middleware('can:'.$row->name);
            }else{
                Route::put($row->name.$params, $row->controller.'Controller@'.$row->action)->middleware('can:'.$row->name);
            }
        }else if($row->method=='delete'){
            if($row->alias){
                Route::delete($row->name.$params, $row->controller.'Controller@'.$row->action)->name($row->alias)->middleware('can:'.$row->name);
            }else{
                Route::delete($row->name.$params, $row->controller.'Controller@'.$row->action)->middleware('can:'.$row->name);
            }
        }else if($row->method=='patch'){
            if($row->alias){
                Route::patch($row->name.$params, $row->controller.'Controller@'.$row->action)->name($row->alias)->middleware('can:'.$row->name);
            }else{
                Route::patch($row->name.$params, $row->controller.'Controller@'.$row->action)->middleware('can:'.$row->name);
            }
        }
    }
  
    
}

// Route::get('/permission/generate', 'PermissionController@generate');

// Route::resource('permission', 'PermissionController');

// Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('/movie', 'MovieController@index')->middleware('can:movie.index');
// Route::get('/movie/index', 'MovieController@index')->middleware('can:movie.index');
// Route::get('/movie/create', 'MovieController@create')->middleware('can:movie.create');
// Route::post('/movie/store', 'MovieController@store')->name('create')->middleware('can:movie.store');
// Route::post('/movie/store', 'MovieController@store')->name('create');
// Route::post('/movie/store', 'MovieController@store')->name('create');
// Route::get('/movie/edit/{id}', 'MovieController@edit');
// Route::put('/movie/update/{id}', 'MovieController@update')->name('edit');
// Route::delete('/movie/destroy/{id}', 'MovieController@destroy');
// Route::patch('/movie/restore/{id}', 'MovieController@restore');
// Route::get('/movie/history', 'MovieController@history');
// Route::get('/movie/json', 'MovieController@json');
// Route::resource('movie', 'MovieController');

// Route::get('/home', 'HomeController@index')->name('home');
