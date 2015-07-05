<?php namespace Broadcasters\Providers;

use App\User as Model;
use Broadcasters\Models\Broadcaster as BroadcasterModel;
class ProfileServiceProvider {


	protected $model, $broadcasterModel, $currentUser, $currentBroadcaster;
	public function __construct(Model $model, BroadcasterModel $broadcasterModel)
	{
		$this->model = $model;
		$this->broadcasterModel = $broadcasterModel;

		$authUser = \Auth::user();
		$this->currentUser = $this->model->find($authUser->id);
		$this->currentBroadcaster = $this->broadcasterModel->find($authUser->broadcaster->id);

	}

	public function getBroadcasterProfile()
	{
		$id = \Auth::user()->id;
		return $this->model->with('broadcaster')->find($id);
	}

	public function updateBroadcasterProfile($request)
	{
		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.broadcasterLogoPath'),$logo);
			$this->currentBroadcaster->logo= $logo;

		}
		$success = false;
		\DB::beginTransaction();
		try {
			$this->currentUser->name = $request->get('name');
			if($request->get('changepass'))
				$this->currentUser->password = \Hash::make(trim($request->get('password')));
			$this->currentUser->save();
			$this->currentBroadcaster->display_name = $request->get('display_name');
			$this->currentBroadcaster->company_name = $request->get('company_name');
			$this->currentBroadcaster->save();
			$success = true;
		}
		catch(\Exception $e){
			dd($e);
		}
		if ($success) {
			\DB::commit();
		} else {
			\DB::rollback();
		}			
	}

}