<?php namespace Broadcasters\Models;


class Role extends BaseModel
{
	protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }

}