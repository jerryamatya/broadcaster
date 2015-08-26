<?php namespace Broadcasters\Models;

class LiveTv extends BaseModel{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'livetvservices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'broadcaster_id', 'details', 'country_id','logo','local_source','cdn_source','language'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token','created_at','updated_at'];

	public function getChannels()
	{
		$filter = \Request::get('filter');
		switch ($filter) {
			case 'all':
				return $this->getBroadcasterChannels();
				break;
			
			default:
				# code...
				break;
		}
		return $this->getBroadcasterChannels(null,'all');

	}

	public function getBroadcasterChannels()
	{

		return $this->with('broadcaster')->active()->with('sources')->get();

	}

	public function sources()
	{
		return $this->belongsToMany('Broadcasters\Models\ServiceSource','livetvservice_to_source','service_id','source_id');
	}
	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}
	public function country()
	{
		return $this->belongsTo('Broadcasters\Models\Country','country_id');
	}

	public function epg()
	{
		return $this->hasOne('Broadcasters\Models\Epg','channel_id');
	}
	
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
	public function scopeAll($query)
    {
        return $query;
    }
	public function configs()
	{
		return $this->hasMany('Broadcasters\Models\Config','object_id');
	}
	public function notifications()
	{
		return $this->hasMany('Broadcasters\Models\Notification','channel_id');
	}
}