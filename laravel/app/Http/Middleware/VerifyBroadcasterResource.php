<?php namespace App\Http\Middleware;

use Closure;
use Broadcasters\Providers\BroadcasterResource;


class VerifyBroadcasterResource {


	protected $broadcasterResource;

	public function __construct(BroadcasterResource $broadcasterResource)
	{
		$this->broadcasterResource = $broadcasterResource;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$current = \Route::current();
		$prefix = $current->getPrefix();
		if($prefix == "broadcaster/services"){
				if(\Request::is('broadcaster/services/news*')){
					$model = "news";
				}
				else if(\Request::is('broadcaster/services/channel*')){
					$model = "channel";
				}
				else if(\Request::is('broadcaster/services/vod*')){
					$model = "vod";
				}
				else
					return $next($request);
			if($model){
				if(!$this->broadcasterResource->hasService($model)){
				return response([
					'error' => [
					'description' => 'No service available'
					]
					], 401);
				}
			}
			$params = $current->parameters();

			if($params){

				if($this->broadcasterResource->canAccess($model,$params)){
					return $next($request);
				}
				else
					return response([
					'error' => [
					'code' => 'UNAUTHORIZED',
					'description' => 'You are not authorized to access this resource.'
					]
					], 401);
			}


			

		}

		return $next($request);

	}

}
