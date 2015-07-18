<?php namespace Broadcasters\Models;

class NewsBlog extends BaseModel{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog_news';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'body', 'excerpt', 'slug','img','broadcaster_id'];







	public function broadcaster()
	{
		return $this->belongsTo('Broadcasters\Models\Broadcaster','broadcaster_id');
	}

	
	public function scopeActive($query)
    {
        return $query->where('active', '=', true);
    }

}