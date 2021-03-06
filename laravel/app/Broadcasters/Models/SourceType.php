<?php namespace Broadcasters\Models;

use Illuminate\Database\Eloquent\Model;

class SourceType extends BaseModel{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'source_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

    public function sources()
    {
        return $this->belongsToMany('Broadcasters\Models\ServiceSource','source_to_type','type_id','source_id');
    }
  
}
