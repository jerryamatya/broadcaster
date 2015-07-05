<<<<<<< HEAD
<?php namespace Broadcasters\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSource extends BaseModel{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'service_sources';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','created_by'];

	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    public function getLists($id=null,$filter='active')
    {
       return $this->getAll()->lists('name','id');
    }
    public function getAll($id=null,$filter='active')
    {
        $user = \Auth::user();
        $id=null;
        if($user->broadcaster){

            $id = $user->broadcaster->id;
        }
        switch ($filter) {
                case 'active':
                        if($id){
                            return $sources= $this->whereHas('channels', function($q) use ($id){
                              $q->where('broadcaster_id','=',$id);
                            })
                                ->with('types')->active()->get();  
                        }
                    return $sources= $this->with('types')->active()->get();
                break;
                
                default:
                    # code...
                    break;
            }       
    }
    public function getBroadcasterSources($id=null)
    {

    }
    public function types()
    {
        return $this->belongsToMany('Broadcasters\Models\SourceType','source_to_type','source_id','type_id')->withPivot('value');
    } 

    public function channels()
    {
        return $this->belongsToMany('Broadcasters\Models\LiveTv','livetvservice_to_source','source_id','service_id');
    }
}
=======
<?php namespace Broadcasters\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSource extends BaseModel{


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'service_sources';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','created_by'];

	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

    public function getLists($id=null,$filter='active')
    {
       return $this->getAll()->lists('name','id');
    }
    public function getAll($id=null,$filter='active')
    {
        $user = \Auth::user();
        $id=null;
        if($user->broadcaster){

            $id = $user->broadcaster->id;
        }
        switch ($filter) {
                case 'active':
                        if($id){
                            return $sources= $this->whereHas('channels', function($q) use ($id){
                              $q->where('broadcaster_id','=',$id);
                            })
                                ->with('types')->active()->get();  
                        }
                    return $sources= $this->with('types')->active()->get();
                break;
                
                default:
                    # code...
                    break;
            }       
    }
    public function getBroadcasterSources($id=null)
    {

    }
    public function types()
    {
        return $this->belongsToMany('Broadcasters\Models\SourceType','source_to_type','source_id','type_id')->withPivot('value');
    } 

    public function channels()
    {
        return $this->belongsToMany('Broadcasters\Models\LiveTv','livetvservice_to_source','source_id','service_id');
    }
}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
