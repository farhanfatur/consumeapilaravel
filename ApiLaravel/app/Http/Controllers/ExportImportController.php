<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Post;
use App\Exports\PostExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportImportController extends Controller
{
    public function export()
    {
    	$user = User::with('post')->find($this->idUser())->toArray();
       	return Excel::download(new PostExport($user['post']), 'post-export.xlsx');
    }
}
