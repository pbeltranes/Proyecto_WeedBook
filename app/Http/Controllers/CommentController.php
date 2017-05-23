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
use App\CommentUpVotes;

class CommentController extends Controller
{

    public function index()
    {
        //
    }

    public function save(Request $request, $review_id){

            // verificar que el body no venga vacio o se jode todo
            $body= $request->comment;
            $from_user = Auth::user()->id;

            $comment = Comment::create([
              'from_user'=> $from_user,
              'on_review'=> $review_id,
              'body' => $body,
            ]);

             return redirect()->route('showreview',[$review_id]);
    }


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


    public function update(Request $request, $review_id, $comment_id){

            $id = Auth::user()->id;
            $body = $request->commentedit;
            // verificar que el usuario es quien es quien debe poder modificar el comentario
            $update = DB::table('comments')
                  ->where('id', $comment_id)
                  ->update(['body' => $body]);

            return redirect()->route('showreview',[$review_id]);
    }

    public function destroy($comment_id, $review_id){

            $destroy = DB::table('comments')->where('id', $comment_id)->delete();

            return redirect()->route('showreview',[$review_id]);
    }


    public function vote(Request $request, $comment_id, $review_id){
            //las votaciones se pueban directamente en la url ya que  necesito aprender el script
            // para asi diferenciar si es positivo o negativo dependiendo de eso deberia
            // hacer una insercion positiv ao negativa, deberia modificar la columna de la tabla tambien
            // y realizar nuevamente migraciones
            $user_id = Auth::user()->id;

            $data = Comment::find($comment_id);
            $vote = DB::table('comment_up_votes')
                  ->where('user_id',$user_id)
                  ->where('comment_id', $comment_id)
                  ->get();
                  // print_r($vote);
                  // die();

            if($data['from_user'] == $user_id){
                return redirect()->route('showreview',[$review_id]);
            }
            else{
                if(!$vote){
                  $vote = CommentUpVotes::create([
                    'comment_id' => $comment_id ,
                    'user_id' => $user_id,
                  ]);

                  return redirect()->route('showreview',[$review_id]);
                }
                else{
                  return redirect()->route('showreview',[$review_id]);
                }
            }
    }

}
