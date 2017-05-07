<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Review;
use App\User;
use App\Strain;

use App\ReviewUpdate;
use App\StrainUpdate;
use App\UsersProfile;
use App\Comment;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //saca 5 reseñas en orden por rep

        $data['reviews'] = Review::join('review_up_votes', 'reviews.id', '=', 'review_up_votes.review_id')
        ->groupBy('reviews.id')
        ->orderBy(DB::raw('COUNT(reviews.id)'), 'DESC')
        ->paginate(5);

        $data['reviews'] = $data['reviews']->count() > 0 ? $data['reviews'] : Review::take(5)->get();
        $data['title'] = 'WeedBook Index';

        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $name = Auth::user()->name;
      $id = Auth::user()->id;
      $data = [
        'name' => $name,
        'id' => $id,
        'on_review' =>1,
      ];
      return view('reviews/newreview',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $duplicate = Review::where('title',$request->title)->first();
      if($request->title == '') // verificar que el nombre no este pelado
        return redirect('reviews/new-review')->withErrors('  Please write the title of your review, bitch!.')->withInput();
      if($duplicate)
      {
        return redirect('home')->withErrors('   Title already exists.')->withInput();// verificar que no exista el nombre
      }
      else{
        $R = Review::create([ // creamos review
          'author_id'=> $request->user()->id,
          'strain_number'=> 1, //-->>ingresar id de la review que se esta comentando
          'title' => $request->title,
          'state' => 0,
          'active' => 0,
          'background_image_url' => $request->background_image_url,
        ]);
        return redirect('review/' . $R->id . '/new-strain')->withMessage('Review created successfully, it wont be shown until you add at least 1 strain to your grow.');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserReviews(request $request) // se visualiza solo para el author_id
    {
      $id = Auth::user()->id;
      if($id == $request->id){ // validar que usuario que entra es el mismo que visitante
      $reviews=DB::table('reviews')
            ->where('reviews.author_id', '=', $request->id)
            ->select('reviews.id', 'reviews.title', 'reviews.active', 'reviews.state','reviews.created_at','reviews.updated_at', 'background_image_url')
            ->get();
      $title= 'Your Reviews';
        return view('reviews/myreviews',compact('reviews'))->withTitle($title)->withInput($id);
      }
      else{
        return back()->withErrors('You can not edit this review');
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
      //$request = Review::where('id',$id)->first();

      return view('reviews/editreview');

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

    public function show($id){

      $data['review'] = Review::find($id);
      $data['author'] = UsersProfile::where('user_id', $data['review']->author_id)->first();
      $data['rev_updates'] = ReviewUpdate::join('reviews', 'reviews.id', '=', 'review_updates.review_id')
                            ->where('review_id', $id);
      $data['rev_count'] = $data['rev_updates']->count();
      $data['strains'] = Strain::where('review_id', $id)->get();
      $data['strain_count'] = $data['strains']->count();

      $data['comments'] = DB::table('comments')
       ->join('users_profiles', 'comments.from_user', '=',  'users_profiles.user_id')
       ->select('comments.id','users_profiles.avatar_url', 'comments.from_user', 'comments.on_review', 'comments.body', 'comments.created_at', 'comments.updated_at')
       ->where('comments.on_review',$id)
       ->get();

      //  print_r($data['comments']);
      //  die();
      return view('reviews/showreview', $data);

    }
}
