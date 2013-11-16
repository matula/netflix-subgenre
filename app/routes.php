<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$netflix = new Netflix;
	$movies = new Netflix_movie;
	$data['genre'] = $netflix->generateGenre();
	$data['movies'] = $movies->getMovieList();
	$data['new'] = TRUE;
	$data['code'] = FALSE;
	return View::make('home', $data);
});

// Save genre and movies
Route::post('save', array('before' => 'csrf', function()
{
	$genre = new Genre;
	$genre->genre = trim(Input::get('genre'));
	$genre->movies = Input::get('movies');
	$genre->code = substr(urlencode(base64_encode($genre->genre)), 0, 8);
	$genre->save();
	return Redirect::to('genre/' . $genre->code);
}));

Route::get('genre/{code}', function($code)
{
	$genre = Genre::where('code', $code)->take(1)->first();
	if (!$genre) {
		App::abort(404, 'Page not found');
		exit;
	}

	$data['genre'] = $genre->genre;
	$data['movies'] = Netflix_movie::whereIn('id', (array)json_decode($genre->movies))->get();
	$data['new'] = FALSE;
	$data['code'] = $code;

	return View::make('home', $data);
});
