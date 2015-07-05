<<<<<<< HEAD
<?php namespace Broadcasters\Models;

class NewsApp extends BaseModel{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'newsappservices';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'broadcaster_id'];

	
	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}

	//api sources
	public function sources()
	{
        return $this->hasMany('Broadcasters\Models\ApiSource','newsapp_id');

	}


	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
=======
<?php namespace Broadcasters\Models;

class NewsApp extends BaseModel{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'newsappservices';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'broadcaster_id'];

	
	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}

	//api sources
	public function sources()
	{
        return $this->hasMany('Broadcasters\Models\ApiSource','newsapp_id');

	}


	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}