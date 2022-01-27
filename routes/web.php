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

$backend = '/admin';

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' =>  '/auth'], function () {

    Route::get('/', function () {
        return view('auth.login');
    })->name('login_index_page');

    Route::post('/login', "AuthenticationController@actionLogin")->name('login_data');
    Route::get('/logout', "AuthenticationController@actionLogout")->name('logout_data');
    
});

Route::get('/', function () {
    return redirect()->route("dashboard_index_page");
});

Route::group(['prefix' =>  '/dashboard', 'middleware' => 'guest'], function () {
    Route::get('/', "DashboardController@actionIndex")->name('dashboard_index_page');
});

Route::group(['prefix' =>  '/department', 'middleware' => 'guest'], function () {

    Route::get('/', "DepartmentController@actionIndex")->name('department_index_page');
    Route::get('/create', "DepartmentController@actionCreate")->name('department_create_page');
    Route::get('/{id}', "DepartmentController@actionUpdate")->name('department_update_page');

    Route::get('delete/{id}', "DepartmentController@actionDelete")->name('department_delete_data');
    Route::post('/update', "DepartmentController@actionUpdate")->name('department_update_data');
    Route::post('/create', "DepartmentController@actionCreate")->name('department_create_data');

});

Route::group(['prefix' =>  '/bannedchar', 'middleware' => 'guest'], function () {

    Route::get('/', "BannedcharController@actionIndex")->name('bannedchar_index_page');
    Route::get('/create', "BannedcharController@actionCreate")->name('bannedchar_create_page');
    Route::get('/test', "BannedcharController@actionTest")->name('bannedchar_test_page');
    Route::get('/{id}', "BannedcharController@actionView")->name('bannedchar_view_page');


    Route::get('delete/{id}', "BannedcharController@actionDelete")->name('bannedchar_delete_data');
    Route::post('/update', "BannedcharController@actionUpdate")->name('bannedchar_update_data');
    Route::post('/create', "BannedcharController@actionCreate")->name('bannedchar_create_data');

});

Route::group(['prefix' =>  '/researcher', 'middleware' => 'guest'], function () {

    Route::get('/', "ResearcherController@actionIndex")->name('researcher_index_page');
    Route::get('/view/{id}', "ResearcherController@actionView")->name('researcher_view_page');
    Route::get('/exp/{id}', "ResearcherController@actionExp")->name('researcher_exp_page');
    Route::get('/exp/delete/{id}', "ResearcherController@actionExpDelete")->name('researcher_exp_delete_data');
    
    Route::post('/expwork', "ResearcherController@actionCreateExpWork")->name('keyword_saveexp_data');

    Route::post('/setkeyword', "ResearcherController@actionSetupKeyword")->name('keyword_setup_data');
    Route::post('/savekeyword', "ResearcherController@actionCategorizeKwd")->name('keyword_savekwd_data');
    

});

Route::group(['prefix' =>  '/storechar', 'middleware' => 'guest'], function () {

    Route::get('/', "StorecharController@actionIndex")->name('storechar_index_page');
    Route::get('/create', "StorecharController@actionCreate")->name('storechar_create_page');
    Route::get('/{id}', "StorecharController@actionView")->name('storechar_view_page');

    Route::get('delete/{id}', "StorecharController@actionDelete")->name('storechar_delete_data');
    Route::post('/update', "StorecharController@actionUpdate")->name('storechar_update_data');
    Route::post('/create', "StorecharController@actionCreate")->name('storechar_create_data');

});