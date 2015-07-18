<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Epg as Model;
class EpgServiceProvider {


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;

	}

	public function getChannelEpg($channelId)
	{
		return $this->model->where('channel_id','=',$channelId)->first();
	}

	public function save($id, $request)
	{
		$epg = $this->model->findOrFail($id);
		$epg->name = trim($request->get('name'));
		$epg->details = trim($request->get('details'));
		$epg->active = trim($request->get('active'));
		$schedule = serialize($request->get('programs'));
		$epg->schedule = $schedule;
		$epg->save();
	}
	public function create($channelId, $request)
	{
		$name= trim($request->get('name'));
		$details = trim($request->get('details'));
		$schedule = serialize($request->get('programs'));
		$channel_id = $channelId;

		$this->model->create(compact('name','details','schedule','channel_id'));	
	}

	/**
	 * api methods
	 */
	
	public function getByChannel($channelId)
	{
		return $this->model
			->where('channel_id','=',$channelId)
			->first();
		
	}
	


}