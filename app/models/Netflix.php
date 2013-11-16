<?php

class Netflix extends Eloquent {
	
	protected $table = 'netflix';

	public function generateGenre()
	{
		// Initialize 
		$genre = '';

		// Get 1 or 2 words from position 1. 2 words should be more often
		$total_p1 = (rand(0,5) > 0) ? 2 : 1;	
		$first = $this->where('position', 1)->select('term')->orderBy(DB::raw('RAND()'))->take($total_p1)->get();
		foreach ($first as $f)
		{
			$genre .= $f->term . ' ';
		}
		
		// Get 1 word from position 2.
		$second = $this->where('position', 2)->select('term')->orderBy(DB::raw('RAND()'))->take(1)->first();
		$genre .= $second->term . ' ';

		// get 1 word from position 3.
		$third = $this->where('position', 3)->select('term')->orderBy(DB::raw('RAND()'))->take(1)->first();
		$genre .= $third->term . ' ';

		// optional "from the " from position 4. randomize so it's less frequent.
		if (rand(0,4) == 0)
		{
			$fourth = $this->where('position', 4)->select('term')->orderBy(DB::raw('RAND()'))->take(1)->first();
			$genre .= 'from the ' . $fourth->term . ' ';
		}
		// optional "based on" from position 5. randomize so it's less frequent.
		if (rand(0,4) == 0)
		{
			$fifth = $this->where('position', 5)->select('term')->orderBy(DB::raw('RAND()'))->take(1)->first();
			$genre .= 'based on ' . $fifth->term . ' ';
		}

		return $genre;
	}
}