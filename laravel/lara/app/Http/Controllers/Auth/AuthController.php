<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;

use  App\Http\Requests\RegisterBroadcastersRequest;

use Broadcasters\Providers\ServicesServiceProvider as ServicesServiceProvider;

use App\Http\Requests\CreateLoginRequest;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/



use AuthenticatesAndRegistersUsers;
	protected $servicesServiceProvider;
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(
		Registrar $registrar,
		ServicesServiceProvider $servicesServiceProvider
		)
	
	{
		$this->registrar = $registrar;

		$this->servicesServiceProvider = $servicesServiceProvider;
	}
	public function postRegister(RegisterBroadcastersRequest $request, BroadcasterServiceProvider $broadcasters)
	{
		//dd($request->all());
		\DB::transaction(function() use ($request, $broadcasters){
			$user = $this->registrar->create($request->only('email','password'));
			$broadcaster = $broadcasters->saveData($request->only('company_name','display_name'));
			$broadcaster->services()->attach($request->get('services'));//add services to broadcaster
		});
		return redirect(route('broadcasterLogin'));
	}
	public function getLogin()
	{
		return view('broadcaster.login');
	}
	public function getRegister()
	{
		$services = $this->servicesServiceProvider->getList();
		return view('broadcaster.register')->with(compact('services'));
	}
	public function postLogin(CreateLoginRequest $request)
	{
		$email = $request->get('email');
		$password = $request->get('password');
		$remember = $request->get('remember');
		if (\Auth::attempt(['email' => $email, 'password' => $password,'role_id'=>2],$remember))
        {
            return redirect()->intended(route('broadcasterHome'));
        }
		return redirect()->route('broadcasterLogin');
	}

	public function getAdminLogin()
	{
		return view('admin.login');
	}

	public function postAdminLogin(CreateLoginRequest $request)
	{
		$email = $request->get('email');
		$password = $request->get('password');
		$remember = $request->get('remember');
		if (\Auth::attempt(['email' => $email, 'password' => $password,'role_id'=>1],$remember))
        {
            return redirect()->intended(route('adminHome'));
        }
		return redirect()->route('adminLogin');
	}

	public function getLogout()
	{
		$redirect = route('home');
		if(\Auth::check()){
			if(\Auth::user()->role_id==1){
				$redirect = route('adminLogin');
			}

			if(\Auth::user()->role_id==2){
				$redirect = route('broadcasterLogin');
			}
			\Auth::logout();
		}
		return redirect($redirect);

	}


}
