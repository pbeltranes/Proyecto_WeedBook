<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Strain;
use App\User;
use App\Review;
use App\Comment;
use App\UsersProfile;
use App\CommentUpVote;

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
    public function save(Request $request, $review_id){
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
    // public function show($id)//-->mostrar todas los comentarios de la review
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $review_id, $comment_id, $author_id){

            $data['author'] = UsersProfile::find($author_id);
            $data['review'] = Review::find($review_id);


            $data['strains'] = Strain::where('review_id', $review_id)->get();
            $data['strain_count'] = $data['strains']->count();

            $data['comments'] = DB::table('comments')
            ->join('users_profiles', 'comments.from_user', '=',  'users_profiles.user_id')
            ->select('comments.id','users_profiles.avatar_url', 'comments.from_user', 'comments.on_review', 'comments.body', 'comments.created_at', 'comments.updated_at')
            ->where('comments.on_review',$review_id)
            ->get();
            $data['commentedit'] = $comment_id;

            return view('comments/editonecomment', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $review_id, $comment_id){
      $id = Auth::user()->id;
      $body = $request->commentedit;
      // verificar que el usuario es quien es quien debe poder modificar el comentario
      $update = DB::table('comments')
            ->where('id', $comment_id)
            ->update(['body' => $body]);

      return redirect()->route('showreview',[$review_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($comment_id, $review_id){

      $destroy = DB::table('comments')->where('id', $comment_id)->delete();
      return redirect()->route('showreview',[$review_id]);
    }


    public function vote(Request $request, $comment_id, $review_id){

        $data ['author'] = DB::table('comments')
        ->select('comments.from_user')
        ->where('comments.id', $comment_id)
        ->get();

        $user_id = Auth::user()->id;

        if($data['author'] != $user_id){

          $votes = comments_up_votes::create([
            'comment_id' => $comment_id ,
            'from_user' => $user_id,
          ]);

            return redirect()->route('showreview',[$review_id]);
        }
            return redirect()->route('showreview',[$review_id]);
    }


}
