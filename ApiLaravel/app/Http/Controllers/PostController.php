<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('post')->find($this->idUser());
        return response()->json($user->post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($this->idUser());
        if($user) {
            $user->post()->create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category
            ]);
            return response()->json([
                'status' => 'User is created',
            ], 200);
        }else {
            return response()->json([
                'status' => 'ID User isnt found',
            ], 404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($this->idUser());
        if($user) {
            if($user->post) {
                $post = $user->post()->find($id);
                return response()->json($post);    
            }else {
                return response()->json(['status' => 'Post is empty']);
            }
            
        }else {
            return response()->json([
                'status' => 'ID is not found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($this->idUser());
        if($user) {
             if($user->post) {
                $post = $user->post()->find($id);
                return response()->json($post);
            }else {
                return response()->json(['status' => 'Post is empty']);
            }
        }else {
            return response()->json([
                'status' => 'Post is not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($this->idUser());
        if($user) {
            $post = $user->post()->find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category
            ]);
            return response()->json(['status' => 'Data is updated'], 200);
        }else {
            return response()->json([
                'status' => 'Post is not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($this->idUser());
        if($user) {
            $post = $user->post()->find($id)->delete();
            return response()->json(['status' => 'Data is deleted'], 200);
        }else {
            return response()->json([
                'status' => 'Post is not found',
            ], 404);
        }
    }
}
