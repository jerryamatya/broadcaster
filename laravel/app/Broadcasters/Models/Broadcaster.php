<?php namespace Broadcasters\Models;


class Broadcaster extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'broadcasters';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['company_name','display_name', 'email', 'logo'];


	/**
	 * Get the active rows
	 * @param  [type] $query Query Object
	 * @return [type]        Query object
	 */
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '=', true);
    }

    public function scopeValid($query)
    {
    	return $query->active()->approved();
    }

    public function channels()
	{
		return $this->hasMany('Broadcasters\Models\LiveTv','broadcaster_id');
	}

	public function services()
	{
		return $this->belongsToMany('Broadcasters\Models\Service','broadcasters_to_services','broadcaster_id','service_id');
	}
	public function newsapps(){
		return $this->hasMany('Broadcasters\Models\NewsApp','broadcaster_id');		
	}
	public function newsappapisources(){
		return $this->belongsToMany('Broadcasters\Models\ApiSource');
	}
	public function user()
	{
		return $this->belongsTo('app\User','user_id');
	}
	public function config()
	{
		return $this->hasOne('Broadcasters\Models\Config','object_id');
	}	
}
