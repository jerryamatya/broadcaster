<?php namespace App\Http\Controllers\broadcaster;
use App\Http\Controllers\MyBaseController as MyBaseController;
use Broadcasters\Providers\ServicesServiceProvider as ServicesServiceProvider;
use Broadcasters\Providers\BroadcasterDashboardServiceProvider as BroadcasterDashboardServiceProvider;
use Broadcasters\Providers\CountryServiceProvider as CountryServiceProvider;

class HomeController extends MyBaseController {
	protected 	$servicesServiceProvider,
				$dashboardServiceProvider,
				$countryServiceProvider;

	function __construct(
		ServicesServiceProvider $servicesServiceProvider,
		BroadcasterDashboardServiceProvider $dashboardServiceProvider,
		CountryServiceProvider $countryServiceProvider
		) 
		{
		//\Auth::logOut();
        $this->middleware('authBroadcaster');
    
		$this->servicesServiceProvider = $servicesServiceProvider;
		$this->dashboardServiceProvider = $dashboardServiceProvider;
		$this->countryServiceProvider = $countryServiceProvider;
	}
	public function index()
	{
		$data =  $this->dashboardServiceProvider->getBroadcasterServicesList();
		$countries = $this->countryServiceProvider->getList();
		return view('broadcaster.index')->with(compact('data','countries'));
	}

	public function getRegister()
	{
		$services = $this->servicesServiceProvider->getList();
		return view('broadcaster.register')->with(compact('services'));
	}

}
