<?php namespace Broadcasters\Models;


class Config extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'configs';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['object_id','key','type','value'];

	public function getValueAttribute($value)
    {
        return unserialize($value);
    }

	public function channel()
	{
		return $this->belongsTo('Broadcasters\Models\LiveTv','object_id');
	}

}
