<?php namespace Broadcasters\Models;


class Epg extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'epg';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','details', 'channel_id', 'schedule'];

    public function programs()
    {
        return $this->hasMany('Broadcasters\Models\EpgProgram','epg_id');
    }
    	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

}
