<<<<<<< HEAD
<?php namespace Broadcasters\Models;


class Vod extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vodservices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['broadcaster_id','cod'];


	/**
	 * Get the active rows
	 * @param  [type] $query Query Object
	 * @return [type]        Query object
	 */
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}
}
=======
<?php namespace Broadcasters\Models;


class Vod extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vodservices';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['broadcaster_id','cod'];


	/**
	 * Get the active rows
	 * @param  [type] $query Query Object
	 * @return [type]        Query object
	 */
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}
}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
