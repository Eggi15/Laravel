<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content','user_id','thumbnail','slug'];
	protected $dates =['created_at'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user()
    {
    	return $this->belongsTo(user::class);
    }

    public function thumbnail()
    {
    	// if($this->thumbnail){
    	// 	return $this->thumbnail;
    	// } else {
    	// 	return asset('No_images.jpg');
    	// }
	    // if(!$this->thumbnail){
	    // 	return asset('No_images.jpg');
	    // }
	    // return $this->thumbnail;

	    return !$this->thumbnail ? asset('No_images.jpg') : $this->thumbnail;

    }
}
