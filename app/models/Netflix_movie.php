<?php

class Netflix_movie extends Eloquent {
	
	protected $table = 'netflix_movies';

	public function getMovieList()
	{
		return $this->orderBy(DB::raw('RAND()'))->take(6)->get();
	}
}