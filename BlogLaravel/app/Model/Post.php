<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $guarded = [];

    public function idNotSame()
    {
    	return ['warning' => 'This data is not belongs to you'];
    }
}
