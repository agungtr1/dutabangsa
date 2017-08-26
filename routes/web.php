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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {
	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

	Route::resource('materi', 'MateriController');
	Route::resource('jeniskelas', 'JeniskelasController');
	Route::resource('datapeserta', 'DatapesertaController');
	Route::resource('members', 'MembersController');
	Route::get('print/{id}', [
		'as' => 'print.datapeserta',
		'uses' => 'DatapesertaController@print'
	]);
	Route::get('export/datapeserta', [
		'as' => 'export.datapeserta',
		'uses' => 'DatapesertaController@export'
	]);
	Route::post('export/datapeserta', [
		'as' => 'export.datapeserta.post',
		'uses' => 'DatapesertaController@exportPost'
	]);
	Route::post('export/all', [
		'as' => 'export.datapesertaall.post',
		'uses' => 'DatapesertaController@exportAll'
	]);
	// Route::post('/datapeserta', [
	// 	'as' => 'datapeserta.post',
	// 	'uses' => 'DatapesertaController@index'
	// ]);
	Route::get('/getdata', 'TestController@getdata');
});

Route::group(['prefix'=>'nonadmin', 'middleware'=>['auth','role:user']], function () {
	Route::resource('listdatapeserta', 'DatainputbyuserController');
	Route::get('print/{id}', [
		'as' => 'print.listdatapeserta',
		'uses' => 'DatainputbyuserController@print'
	]);
	Route::get('export/listdatapeserta', [
		'as' => 'export.listdatapeserta',
		'uses' => 'DatainputbyuserController@export'
	]);
	Route::post('export/listdatapeserta', [
		'as' => 'export.listdatapeserta.post',
		'uses' => 'DatainputbyuserController@exportPost'
	]);
	Route::post('export/alldatapeserta', [
		'as' => 'export.listdatapesertaall.post',
		'uses' => 'DatainputbyuserController@exportAll'
	]);
});

/*Route::get('/datapeserta', 'DatapesertaController@index');*/

Route::get('settings/profile', 'SettingsController@profile');
Route::get('settings/profile/edit', 'SettingsController@editProfile');
Route::post('settings/profile', 'SettingsController@updateProfile');

Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');