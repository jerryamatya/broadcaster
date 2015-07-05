<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\NewsappServiceProvider as Provider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use App\Http\Requests\CreateNewsappRequest;
use App\Http\Requests\CreateServiceSourceRequest;


class NewsappController extends MyBaseController {

	protected $service, $broadcasterServiceProvider;
	public function __construct(
								Provider $service,
								BroadcasterServiceProvider $broadcasterServiceProvider
								)
	{
		$this->service = $service;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
	}


	public function index()
	{
		$newsapps = $this->service->getAll();
		return view('admin.newsapp.index')->with('newsapps',$newsapps);
	}
	public function show($id)
	{
		$newsapp = $this->service->getByIdWithData($id);
		return view('admin/newsapp/view',compact('newsapp'));	
	}
	public function create()
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();

		return view('admin/newsapp/create',compact('broadcasters'));
	}
	public function store(CreateNewsappRequest $request)
	{
		$this->service->save($request);
		return \Redirect::route('newsappList')->withSuccess("New News App added");

	}

	public function edit($id)
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();

		$newsapp = $this->service->getById($id);
		return view('admin/newsapp/edit',compact('newsapp','broadcasters'));	
	}
	public function update($id, CreateNewsappRequest $request)
	{
		$this->service->update($request, $id);
		return \Redirect::route('newsappList')->withSuccess("News App Updated");

	}

	public function manageSources($id)
	{
		$newsapp = $this->service->getWithSources($id);
		return view('admin/newsapp/managesources',compact('newsapp'));	

	}
	public function saveSources($id, CreateServiceSourceRequest $request)
	{
		$this->service->saveSources($request, $id);
		return \Redirect::route('newsappManageSources',$id)->withSuccess("News App Sources Saved");
	}
	public function changeStatus($id)
	{
		$this->service->toggleActive($id);
		return \Redirect::route('newsappList')->withSuccess("News App Status Changed");
	}
	public function delete($id)
	{
		$this->service->deleteWithSources($id);
		return \Redirect::route('newsappList')->withSuccess("News App Deleted");

	}

}
