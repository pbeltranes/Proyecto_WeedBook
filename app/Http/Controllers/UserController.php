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
class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $data = DB::table('UsersProfile')->get();
        return view('editprofile', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function save()
     {

     }
    public function destroy($id)
    {
        //
    }

    public function profile(Request $request, $id){
        $data['user'] = User::find($id);
        $data['user_profile'] = UsersProfile::where('user_id', $id);


        $totalReviewsRep = Review::join('review_up_votes', 'reviews.id', '=', 'review_up_votes.review_id')
        ->groupBy('reviews.id')
        ->where('reviews.author_id', $id)
        ->count();
        $totalUserReviews = Review::where('author_id', $id)
        -> count();

        $totalUserReviews = $totalUserReviews > 0 ? $totalUserReviews : 1;

        $data['prom_rev_rep'] = $totalReviewsRep / $totalUserReviews;


        $totalCommentRep = Comment::join('comment_up_votes', 'comments.id', '=', 'comment_up_votes.comment_id')
        ->groupBy('comments.id')
        ->where('comments.from_user', $id)
        ->count();
        $totalUserComments = Comment::where('from_user', $id)
        -> count();

        $totalUserComments = $totalUserComments > 0 ? $totalUserComments : 1; // si es mayor a 0  total UserComments es 1 si no se hace 0

        $data['prom_comments_rep'] = $totalCommentRep / $totalUserComments;



        return view('profile', $data);
    }

}
