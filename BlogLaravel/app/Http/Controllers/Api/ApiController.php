<?php

namespace App\Http\Controllers\Api;


use App\Model\User;
use App\Mail\SendResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function login(Request $request)
    {
    	
    		$client = new Client();
	    	$response = $client->request('POST', 'http://apilaravel.test/api/login', array(
	    		'form_params' => [
	    			'email' => $request->email,
	    			'password' => $request->password
	    		],
	    	));
	    	$body = $response->getBody()->getContents();
	    	$bodyDecode = json_decode($body);
	    	if($bodyDecode->code != 401) {
	    		$request->session()->put('token', $bodyDecode->token);
                $request->session()->put('id', $bodyDecode->id);
                $request->session()->put('name', $bodyDecode->name);
	    		return redirect()->route('apiIndex')->withHeaders([
	    				"Authorization" => "Bearer ".$bodyDecode->token,
	    			]);
	    	}else {
	    		return redirect()->back()->withErrors($bodyDecode->status);
	    	}
    	
    }

    public function index(Request $request)
    {
    	$token = $request->session()->get('token');
    	$client = new Client([
    		'headers' => [
    			'Authorization' => "Bearer ".$token
    		]
    	]);
	    $response = $client->request('GET', 'http://apilaravel.test/api/post');
         $body = $response->getBody()->getContents();
	    return view('home', ['posts' => json_decode($body)]);
    }

    public function store(Request $request)
    {
    	$token = $request->session()->get('token');

    	$client = new Client([
    		'headers' => [
    			'Authorization' => "Bearer ".$token
    		],
    	]);
    	$response = $client->request('POST', 'http://apilaravel.test/api/post', array(
    		'form_params' => [
    			'title' => $request->title,
    			'description' => $request->description,
    			'category' => $request->category
    		],
    	));
        if($response->getStatusCode() == 200) {
            return redirect()->route('apiIndex');
        }
    }

    public function edit(Request $request, $id)
    {
        $token = $request->session()->get('token');

        $client = new Client([
            'headers' => [
                'Authorization' => "Bearer ".$token
            ],
        ]);

        $response = $client->request('GET', 'http://apilaravel.test/api/post/'.$id.'/edit');
        $post = json_decode($response->getBody()->getContents());
        $category = [
            "berita",
            "ekonomi",
            "mancanegara",
            "teknologi",
        ];
        return view('partial.edit', ['post' => $post, 'categories' => $category]);
    }

    public function update(Request $request)
    {
        $token = $request->session()->get('token');

        $client = new Client([
            'headers' => [
                'Authorization' => "Bearer ".$token
            ],
        ]);

        $response = $client->request("PUT", 'http://apilaravel.test/api/post/'.$request->id, array(
            'form_params' => [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category
            ],
        ));

        if($response->getStatusCode() == 200) {
            return redirect()->route('apiIndex');
        }
    }

    public function delete(Request $request, $id)
    {
        $token = $request->session()->get('token');

        $client = new Client([
            'headers' => [
                'Authorization' => "Bearer ".$token
            ],
        ]);

        $response = $client->request("DELETE", 'http://apilaravel.test/api/post/'.$request->id);
        if($response->getStatusCode() == 200) {
            return redirect()->route('apiIndex');
        }
    }

    public function logout(Request $request)
    {
        $token = $request->session()->get('token');

        $client = new Client([
            'headers' => [
                'Authorization' => "Bearer ".$token
            ],
        ]);

        $response = $client->request("POST", 'http://apilaravel.test/api/logout');
         if($response->getStatusCode() == 200) {
            $request->session()->forget('token');
            $request->session()->forget('id');
            return redirect()->route('index');
        }
    }

    public function existemail(Request $request)
    {
        $client = new Client();
        $response = $client->request("POST", 'http://apilaravel.test/api/existemail', [
            'form_params' => [
                'email' => $request->email
            ],
        ]);
        $jsonDecode = json_decode($response->getBody()->getContents());
        Mail::to('admin_api@email.com')->send(new SendResetPassword($jsonDecode));
        return redirect()->route('index');
    }

    public function viewpassword(Request $request, $id)
    {
        $user = User::find($id);
        if($user) {
            return view('auth.passwords.reset');
        }else {
            return redirect()->back()->withErrors(['ID is not found']);
        }
        
    }

    public function updatepassword(Request $request)
    {
        $client = new Client();
        $response = $client->request("POST", 'http://apilaravel.test/api/passwordupdate', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation
            ],
        ]);
        $body = json_decode($response->getBody()->getContents());
        if($body->code == 401) {
            return redirect()->back()->withErrors([$body->status]);
        }else {
            return redirect()->route('index');
        }
    }


}
