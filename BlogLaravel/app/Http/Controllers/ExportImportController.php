<?php

namespace App\Http\Controllers;

use Session;
use App\Exports\PostExport;
use App\Imports\PostImport;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportImportController extends Controller
{
     public function exportexcel(Request $request)
    {
        $token = $request->session()->get('token');
        $client = new Client([
            'headers' => [
                'Authorization' => "Bearer ".$token
            ]
        ]);
        $response = $client->request('GET', 'http://apilaravel.test/api/post');
        $body = json_decode($response->getBody()->getContents());

        return Excel::download(new PostExport($body), 'export-post.xlsx');
    }

    public function importexcel(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // get file excel
        $file = $request->file('file');

        $namefile = rand().$file->getClientOriginalName();
        // Move file to file_post folder
        $file->move('file_post', $namefile);
        $excel = Excel::import(new PostImport($request->session()->get('id')), public_path('/file_post/'.$namefile));
        if($excel) {
            Session::flash('success', 'Data Post is success imported');    
        }else {
            Session::flash('warning', 'This data is not belongs to you');
        }
        

        return redirect()->route('apiIndex');
    }
}
