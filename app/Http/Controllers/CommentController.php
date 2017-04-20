<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Review;
use App\Comment;
use App\UsersProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $review_id)
    {
      // verificar que el body no venga vacio o se jode todo
      $body= $request->comment;
      $from_user = Auth::user()->id;

      $comment = Comment::create([
        'from_user'=> "$from_user",
        'on_review'=> $review_id, //-->>ingresar id de la review que se esta comentando
        'body' => "$body",
      ]);
       return redirect()->route('showreview',[$review_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//-->mostrar todas los comentarios de la review
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $review_id, $author_id)
    {
        $data['author'] = $author_id
        $data['review'] = Review::find($id);
        $data['comments'] = DB::table('comments')
        ->where('comments.on_review','=',$review_id)
        ->select('comments.id','comments.from_user', 'comments.on_review', 'comments.body', 'comments.created_at', 'comments.updated_at')
        ->get();

          return view('comments/editcomment', $data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
