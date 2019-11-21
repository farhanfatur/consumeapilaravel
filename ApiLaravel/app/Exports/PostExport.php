<?php

namespace App\Exports;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class PostExport implements FromArray
{
	public $post;

    public function __construct(array $dataPost)
    {
    	return $this->post = $dataPost;
    }

    public function array(): array
    {
        return $this->post;
    }
}
