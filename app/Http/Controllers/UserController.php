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
        $can_edit = Auth::user()->id == $id ?TRUE:FALSE;
        if($can_edit){
            $data = UsersProfile::where('user_id', $id)->first();
            return view('editprofile', $data);
        }
        return redirect('/');
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
     public function uploading_image($file){
      if($file != NULL)
      $ext = $file->getClientOriginalExtension();
      else
      return 'DEFAULT_AVATAR_URL.png';
           if($ext =! 'jpg' & $ext != 'jpeg' & $ext != 'bmp' & $ext != 'gif' & $ext != 'png')
             return 'DEFAULT_AVATAR_URL.png';
           else{
             $nombre = $file->getClientOriginalName();
             $hash_name = md5($nombre. time()).'.'. $file->getClientOriginalExtension();
             \Storage::disk('local')->put($hash_name,  \File::get($file));
               return $hash_name;
             }
           }

    public function save(Request $request)
    {
        $user_id = $request->input('id');
        $user_profile = UsersProfile::where("user_id", $user_id)->first();
        if($request->file('avatar_url') != NULL)
        {
          \Storage::delete($user_profile->avatar_url);
          $nombre = $this->uploading_image($request->file('avatar_url'));
        }
        $user_profile->bio = $request->input('bio');
        $user_profile->birthdate = $request->input('birthdate');
        $user_profile->avatar_url = $nombre;
        $user_profile->save();
        return redirect()->action('UserController@profile', ['id' => $user_id]);

    }
    public function destroy($id)
    {
        $can_delete = Auth::user()->id == $id ? TRUE:FALSE;
        if($can_delete){
            $user = User::find($id);
            $user->delete();
        }

        return redirect('/');

    }


    public function profile(Request $request, $id){
        $data['user'] = User::find($id);
        $data['user_profile'] = UsersProfile::where('user_id', $id)->first();
        $data['url'] = '/images/';
        $data['profile_options'] = FALSE;

        if(!Auth::guest()){
            $data['profile_options'] = Auth::user()->id == $id;
        }

        $totalReviewsRep = Review::join('review_up_votes', 'reviews.id', '=', 'review_up_votes.review_id')
                            ->groupBy('reviews.id')
                            ->where('reviews.author_id', $id)
                            ->count();
        $totalUserReviews = Review::where('author_id', $id)
                            -> count();
        $data['reviews_count'] = $totalUserReviews;
        $totalUserReviews = $totalUserReviews > 0 ? $totalUserReviews : 1;
        $data['prom_rev_rep'] = $totalReviewsRep / $totalUserReviews;


        $totalCommentRep = Comment::join('comment_up_votes', 'comments.id', '=', 'comment_up_votes.comment_id')
                            ->groupBy('comments.id')
                            ->where('comments.from_user', $id)
                            ->count();

        $totalUserComments = Comment::where('from_user', $id)
                            -> count();
        $data['comments_count'] = $totalUserComments;
        $totalUserComments = $totalUserComments > 0 ? $totalUserComments : 1;
        $data['prom_comments_rep'] = $totalCommentRep / $totalUserComments;

        $data['user_reviews'] = Review::where('author_id', $id)->get();


        return view('profile', $data);
    }

}
