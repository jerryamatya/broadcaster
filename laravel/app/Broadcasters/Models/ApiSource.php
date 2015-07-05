<?php namespace Broadcasters\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSource extends BaseModel{

	protected $table = 'api_sources';

	protected $fillable =['newsapp_id','name','value','details'];
	
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }
}
