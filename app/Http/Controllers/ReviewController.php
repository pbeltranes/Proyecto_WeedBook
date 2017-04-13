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
       'on_review' =>1,];
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
        return redirect('reviews/new-review')->withErrors('   Title already exists.')->withInput();// verificar que no exista el nombre
      }
      else{
        $R = Review::create([ // creamos review
          'author_id'=> $request->user()->id,
          'strain_number'=> 1, //-->>ingresar id de la review que se esta comentando
          'title' => $request->title,
          'state' => 1,
          'active' =>1,
        ]);
        $S = Strain::create([
          'review_id' => $R->id, // se crea strain
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
    public function show(request $request) // se visualiza solo para el author_id
    {
      $id = Auth::user()->id;
      if($id == $request->id){ // validar que usuario que entra es el mismo que visitante
      $reviews=DB::table('reviews')
            ->where('reviews.author_id', '=', $request->id)
            ->select('reviews.id', 'reviews.title', 'reviews.active', 'reviews.state','reviews.created_at','reviews.updated_at')
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
      $request = Review::where('id',$id)->first();

      return view('editreview',$request);

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
