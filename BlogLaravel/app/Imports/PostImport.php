<?php

namespace App\Imports;

use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
{
    public $id;

    public function __construct($id)
    {
        return $this->id = $id;
    }

    public function model(array $row)
    {
        if($this->id == $row[4]) {
            if(!empty($row[5]) || !empty($row[6])) {
                return new Post([
                    'title' => $row[1],
                    'description' => $row[2],
                    'category' => $row[3],
                    'user_id' => $row[4],
                    'created_at' => $row[5],
                    'updated_at' => $row[6],
                ]);
            }else {
                return new Post([
                    'title' => $row[1],
                    'description' => $row[2],
                    'category' => $row[3],
                    'user_id' => $row[4],
                ]);
            }
        }
    }
}

