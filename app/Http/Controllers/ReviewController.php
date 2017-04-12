<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use App\Strain;

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
    public function create(Request $request)
    {
      $name = Auth::user()->name;
      $id = Auth::user()->id;
      $bank = "chucha";
       $data = [
       'bank' => $bank,
       'name' => $name,
       'id' => $id,
       'on_review' =>1,];
      return view('newreview',$data);
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
      if($request->title == '')
        return redirect('new-review')->withErrors('Please write the title of your review, bitch!.')->withInput();
      if($duplicate)
      {
        return redirect('new-review')->withErrors('   Title already exists.')->withInput();
      }
      else{
        $R = Review::create([
          'author_id'=> $request->user()->id,
          'strain_number'=> 1, //-->>ingresar id de la review que se esta comentando
          'title' => $request->title,
          'state' => 1,
          'active' =>1,
        ]);
        $S = Strain::create([
          'review_id' => $R->id,
          'bank' => $request->bank,
          'seed_type' =>$request->seed_type,
          'grow_type' =>$request->grow_type,
          'strain_name' => $request->strain_name,
          'technique' => $request->technique,
          'germ_date' => $request->germ_date,
          'veg_start' => $request->veg_start,
          'flow_start' => $request->flow_start,
          'harvest_date' => $request->harvest_date,
          'active' => 'true',
        ]);
        return redirect('home')->withMessage(' Review create with successfully');;
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
}
