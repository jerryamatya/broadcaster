<?php namespace Broadcasters\Providers;

use Broadcasters\Models\NewsBlog as Model;

class NewsBlogServiceProvider  extends BaseServiceProvider {


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getAll(){
		return $this->model->orderBy('id','desc')->paginate(10);
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function getByIdWithData($id)
	{
		return $this->model->with(['broadcaster'])->where('id',$id)->first();
	}

	public function save($request)
	{
		$inputs = $request->all();

		if($request->hasFile('img')){
			$file = $request->file('img');
			$img = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.newsBlogPath'),$img);
			$inputs['img'] = $img;
		}

		$inputs['created_date'] = date("Y-m-d H:i:s");
		$slug = $inputs['slug']?str_replace(' ','-',$inputs['slug']):str_replace(' ','-',$inputs['title']);
		$inputs['slug'] = strtolower($slug);
		$inputs['broadcaster_id'] = \Auth::user()->broadcaster->id;
		
		try{
		$this->model->create($inputs); // broadcaster is from view, if logged in broadcaster take his id

		}
		catch(\Exception $e){

		}
	}

	public function update($request, $id)
	{
		$model = $this->model->findOrFail($id);

		$model->title = $request->get('title');
		$model->body = $request->get('body');
		$model->excerpt = $request->get('excerpt');
		$model->active = (int)$request->get('active');

		$slug = $request->get('slug');

		$slug = $slug?str_replace(' ','-',$slug):str_replace(' ','-',$model->title);

		$model->slug = strtolower($slug);

		//update logo
		if($request->hasFile('img')){
			$titleslug = str_replace(' ','-',$model->title);
			$file = $request->file('img');
			$img = time() . "-".$file->getClientOriginalName();
			try{
			$file->move(public_path().\Config::get('site.newsBlogPath'),$img);

			}
			catch(\Exception $e){
				dd($e);
			}
			$model->img = $img;
		}
		
		try{
			$model->save();
		}
		catch(\Exception $e){
		}
	}

	public function deleteById($id)
	{
		return $this->model->findOrFail($id)->delete();
	}

	/**
	 * api methods
	 */
	
	public function getLimitedWithBroadcasterId($id, $limit = 10)
	{
		return $this->model->active()->take($limit)->get();
	}
	
}