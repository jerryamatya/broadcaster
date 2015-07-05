<<<<<<< HEAD
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\NewsApp as Model;
use Broadcasters\Models\ApiSource as ApiSourceModel;

class NewsappServiceProvider  extends BaseServiceProvider {


	protected $model;
	public function __construct(Model $model, ApiSourceModel $apiSourceModel)
	{
		$this->model = $model;
		$this->apiSourceModel = $apiSourceModel;
	}

	public function getAll(){
		return $this->model->with('broadcaster')->get();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function getByIdWithBroadcaster($id){
		return $this->model->active()->with('broadcaster')->find($id);
	}

	public function getByIdWithData($id)
	{
		return $this->model->with('broadcaster')->where('id',$id)->first();
	}

	public function save($request)
	{
		$inputs = $request->all();
		try{
		$this->model->create($inputs); // broadcaster is from view, if logged in broadcaster take his id

		}
		catch(\Exception $e){

		}
	}

	public function update($request, $id)
	{
		$newsapp = $this->model->findOrFail($id);

		$newsapp->name = $request->get('name');
		$newsapp->broadcaster_id = $request->get('broadcaster_id');

		try{
			$newsapp->save();
		}
		catch(\Exception $e){
		}
	}

	public function getWithSources($id)
	{
		return $this->model->active()->with('sources')->findOrFail($id);
	}

	public function saveSources($request, $newsappid)
	{
		if(count($request->get('sources'))){
			$success = false;
			\DB::beginTransaction();
			try {
				//return $request->apisources['values'];
				$sourceIds = [];
				$sources = $request->get('sources');
				foreach ($sources['id'] as $i=>$id) {
					$name = $sources['name'][$i];
					$value = $sources['value'][$i];
					$details = $sources['details'][$i];
					if($name==null || $value==null){
						continue;
					}
					if($id){
						$apiSource = $this->apiSourceModel->find($id);
						if($sources['delete'][$i]=="yes"){
							$apiSource->delete();
						}
						else{
							if($sources['delete'][$i]=="yes"){
								continue;
							}
							$apiSource->name = $name;
							$apiSource->value = $value;
							$apiSource->details = $details;
							$apiSource->save();
						}
					}
					else {
						$this->apiSourceModel->create([
							'newsapp_id'=>$newsappid,
							'name'=>$name,
							'value'=>$value,
							'details'=>$details
						]);
					}
				}
				$success = true;
			}
			catch (\Exception $e) {
				dd($e);
			}
			if ($success) {
				\DB::commit();
			} else {
				\DB::rollback();
			}
		}

	}
	public function toggleActive($id)
	{
		$newsapp = $this->model->find($id);
		$newsapp->active = !$newsapp->active;
		try{
			$newsapp->save();
		}
		catch(\Exception $e){
			dd($e->message());
		}
	}
	public function deleteWithSources($id)
	{
		$newsapp = $this->model->findOrFail($id);
		try{
			if(count($newsapp->sources)){
				//Todo
				//delete related models
				//$newsapp->sources->disassociate();
			}
			$newsapp->delete();
		}
		catch(\Exception $e){
			dd($e);
		}		
	}


=======
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\NewsApp as Model;
use Broadcasters\Models\ApiSource as ApiSourceModel;

class NewsappServiceProvider  extends BaseServiceProvider {


	protected $model;
	public function __construct(Model $model, ApiSourceModel $apiSourceModel)
	{
		$this->model = $model;
		$this->apiSourceModel = $apiSourceModel;
	}

	public function getAll(){
		return $this->model->with('broadcaster')->get();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function getByIdWithBroadcaster($id){
		return $this->model->active()->with('broadcaster')->find($id);
	}

	public function getByIdWithData($id)
	{
		return $this->model->with('broadcaster')->where('id',$id)->first();
	}

	public function save($request)
	{
		$inputs = $request->all();
		try{
		$this->model->create($inputs); // broadcaster is from view, if logged in broadcaster take his id

		}
		catch(\Exception $e){

		}
	}

	public function update($request, $id)
	{
		$newsapp = $this->model->findOrFail($id);

		$newsapp->name = $request->get('name');
		$newsapp->broadcaster_id = $request->get('broadcaster_id');

		try{
			$newsapp->save();
		}
		catch(\Exception $e){
		}
	}

	public function getWithSources($id)
	{
		return $this->model->active()->with('sources')->findOrFail($id);
	}

	public function saveSources($request, $newsappid)
	{
		if(count($request->get('sources'))){
			$success = false;
			\DB::beginTransaction();
			try {
				//return $request->apisources['values'];
				$sourceIds = [];
				$sources = $request->get('sources');
				foreach ($sources['id'] as $i=>$id) {
					$name = $sources['name'][$i];
					$value = $sources['value'][$i];
					$details = $sources['details'][$i];
					if($name==null || $value==null){
						continue;
					}
					if($id){
						$apiSource = $this->apiSourceModel->find($id);
						if($sources['delete'][$i]=="yes"){
							$apiSource->delete();
						}
						else{
							if($sources['delete'][$i]=="yes"){
								continue;
							}
							$apiSource->name = $name;
							$apiSource->value = $value;
							$apiSource->details = $details;
							$apiSource->save();
						}
					}
					else {
						$this->apiSourceModel->create([
							'newsapp_id'=>$newsappid,
							'name'=>$name,
							'value'=>$value,
							'details'=>$details
						]);
					}
				}
				$success = true;
			}
			catch (\Exception $e) {
				dd($e);
			}
			if ($success) {
				\DB::commit();
			} else {
				\DB::rollback();
			}
		}

	}
	public function toggleActive($id)
	{
		$newsapp = $this->model->find($id);
		$newsapp->active = !$newsapp->active;
		try{
			$newsapp->save();
		}
		catch(\Exception $e){
			dd($e->message());
		}
	}
	public function deleteWithSources($id)
	{
		$newsapp = $this->model->findOrFail($id);
		try{
			if(count($newsapp->sources)){
				//Todo
				//delete related models
				//$newsapp->sources->disassociate();
			}
			$newsapp->delete();
		}
		catch(\Exception $e){
			dd($e);
		}		
	}


>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}