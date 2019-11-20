<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $guarded = [];
    
    public function user()
    {
    	return $this->belonsTo('App\Model\User');
    }
}
