<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix'=>'management'], function() {
	Route::group(['prefix' => 'books'], function () {
		Route::get('/', [
				"as" => "books.home",
				"middleware"=>"web",
				"uses" => "BooksController@index"
		]);
		Route::get('/new', [
				"as" => "books.new",
				"middleware" => "web",
				"uses" => "BooksController@create"
		]);
		Route::post('/save_new', [
				"as" => "books.save_new",
				"middleware" => "web",
				"uses" => "BooksController@store"
		]);
		Route::post('/update_save', [
			'as' => 'books.update_save',
			'middleware'=> 'web',
			'uses'=>'BooksController@update'
		]);
		Route::get('/modify/{id?}', [
				"as" => "books.edit",
				"middleware"=> "web",
				"uses" => "BooksController@edit"
		]);
	});

	Route::group(['prefix'=>'genres'], function() {
		Route::get('/', [
			"as"=>"genres.home",
			"uses"=> "GenresController@index"
		]);
	});

	Route::group(['prefix'=>'author'], function(){
		Route::group(['prefix'=>'/async'], function() {
			Route::get('/all',['as'=>'author.async.all', function(){
				return \App\Models\Author::where('record_id', NULL)->orderBy('author_name')->get();
			}]);
			Route::post('/new-author', [
				'as'=>'author.async.newAuthor',
				"middleware"=> "web",
				'uses'=>'AuthorsController@store'
			]);
		});
	});
	Route::group(['prefix'=>'publisher'], function(){
		Route::group(['prefix'=>'/async'], function() {
			Route::get('/all',['as'=>'publisher.async.all', function(){
				return \App\Models\Publisher::where('record_id', NULL)->get();
			}]);
		});
	});
});
Route::any('/',[
	"as"=>"catalog.index",
	"uses"=>"CatalogController@index"
]);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	//
});
