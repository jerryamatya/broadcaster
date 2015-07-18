<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\NewsBlogServiceProvider as Provider;

use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use App\Http\Requests\CreateNewsBlogRequest;


class NewsblogController extends MyBaseController {

	protected $service, $broadcasterServiceProvider;
	public function __construct(
								Provider $service,
								BroadcasterServiceProvider $broadcasterServiceProvider
								)
	{
		        $this->middleware('authBroadcaster');

		$this->service = $service;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
	}


	public function index()
	{
		$articles = $this->service->getByBroadcaster();
		return view('broadcaster.newsblog.index')->with('articles',$articles);
	}
	public function show($id)
	{
		$newsblog = $this->service->getById($id);
		return view('broadcaster/newsblog/view',compact('newsblog'));	
	}
	public function create()
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();

		return view('broadcaster/newsblog/create',compact('broadcasters'));
	}
	public function store(CreateNewsBlogRequest $request)
	{
		$this->service->save($request);
		return \Redirect::route('newsList')->withSuccess("New article added");

	}

	public function edit($id)
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();

		$newsblog = $this->service->getById($id);
		return view('broadcaster/newsblog/edit',compact('newsblog','broadcasters'));	
	}
	public function update($id, CreateNewsBlogRequest $request)
	{
		$this->service->update($request, $id);
		return \Redirect::route('newsList')->withSuccess("Article Updated");

	}

	public function delete($id)
	{
		$this->service->deleteById($id);
		return \Redirect::route('newsList')->withSuccess("Article Deleted");

	}

}
