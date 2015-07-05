<<<<<<< HEAD
<?php namespace Broadcasters\Models\api;

class BroadCasters extends \Broadcasters\Models\Broadcasters{
	
	public function getChannels($id)
	{
		return $channels = $this->with(['channels'=>function($query){
			$query->with('sources');
		}])->active()->find($id);
	}

	public function existsAndisValid($id){
		if($this->find($id)){
			return true;
		}
		return false;
	}
	public function getServices($id)
	{
		return $this->find($id)->services;
	}
	
	public function getNewsAppWithApiSources($id)
	{
		$broadcaster = $this->with('newsapps.sources')->find($id);
		$newsapps = [];
		foreach($broadcaster->newsapps as $newsapp ){
			$newsapps[] = $newsapp;
		}
		return $newsapps;
	}	

=======
<?php namespace Broadcasters\Models\api;

class BroadCasters extends \Broadcasters\Models\Broadcasters{
	
	public function getChannels($id)
	{
		return $channels = $this->with(['channels'=>function($query){
			$query->with('sources');
		}])->active()->find($id);
	}

	public function existsAndisValid($id){
		if($this->find($id)){
			return true;
		}
		return false;
	}
	public function getServices($id)
	{
		return $this->find($id)->services;
	}
	
	public function getNewsAppWithApiSources($id)
	{
		$broadcaster = $this->with('newsapps.sources')->find($id);
		$newsapps = [];
		foreach($broadcaster->newsapps as $newsapp ){
			$newsapps[] = $newsapp;
		}
		return $newsapps;
	}	

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}