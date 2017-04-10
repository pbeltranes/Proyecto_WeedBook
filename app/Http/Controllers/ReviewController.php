<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Comment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Review;
use App\UsersProfile;

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

        $reviews = Review::join('review_up_votes', 'reviews.id', '=', 'review_up_votes.review_id')
        ->groupBy('reviews.id')
        ->orderBy(DB::raw('COUNT(reviews.id)'), 'DESC')
        ->paginate(5);
        $title = 'Inicio WeedBook';
        return view('home')->withReviews($reviews)->withTitle($title);
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
        $data['comments'] = Comment::where('on_review','=',$id)->get();
        // print_r($data['comments']);
        // die();
        $data['review'] = Review::where('id','=',$id)->first();
        $author_id = $data['review']->author_id;
        $data['author'] = UsersProfile::find($author_id)->first();
        return view('showreview',$data);
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
