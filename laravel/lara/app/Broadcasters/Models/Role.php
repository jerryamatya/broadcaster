<<<<<<< HEAD
<?php namespace Broadcasters\Models;


class Role extends BaseModel
{
	protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }

=======
<?php namespace Broadcasters\Models;


class Role extends BaseModel
{
	protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}