<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class PostExport implements FromArray
{
	public $post;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $post)
    {
    	return $this->post = $post;
    }

    public function array(): array
    {
       return $this->post;
    }
}
