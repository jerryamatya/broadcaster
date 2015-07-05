<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\ProfileServiceProvider as Provider;

use App\Http\Requests\CreateProfileRequest;


class ProfileController extends MyBaseController {


	protected 	$service,
				$servicesServiceProvider;

	public function __construct(Provider $service)
	{
		$this->service = $service;
	}

	public function get()
	{
		$user = $this->service->getBroadcasterProfile();
		return view('broadcaster.profile')->with(compact('user'));
	}
	public function update(CreateProfileRequest $request)
	{
		if($request->get('changepass') && !\Hash::check($request->get('currentpassword'),\Auth::user()->password)){
			$request->flashOnly('changepass');
				return redirect(route('broadcasterProfileUpdate'))->withErrors("Current password is not correct");
		}
		$this->service->updateBroadcasterProfile($request);
		return redirect(route('broadcasterProfileUpdate'))->withSuccess("Profile updated.");
	}

}
