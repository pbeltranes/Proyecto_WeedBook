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
use App\CommentUpVotes;
use App\ProductOnStrain;
use App\Product;

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

        $data['reviews'] = Review::join('review_up_votes', 'reviews.id', '=', 'review_up_votes.review_id') // selecciona reviews con mas likes
        ->where('active',0)
        ->groupBy('reviews.id')
        ->join('users_profiles', 'reviews.author_id', '=', 'users_profiles.user_id')
        ->orderBy(DB::raw('COUNT(reviews.id)'), 'DESC')
        ->paginate(5);

        $data['reviews'] = $data['reviews']->count() > 0 ? $data['reviews'] : Review::take(5)
          ->where('active',0)
          ->join('users_profiles', 'reviews.author_id', '=', 'users_profiles.user_id')
          ->get();

        $data['title'] = 'WeedBook World';
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
          'strain_number'=> 0, //-->>ingresar id de la review que se esta comentando
          'title' => $request->title,
          'state' => 0,
          'active' => 0, // cultivo activo
          'background_image_url' => $request->background_image_url,
        ]);
        return redirect('review/' . $R->id . '/new-strain')->withMessage('Review created successfully, it wont be shown until you add at least 1 crop to your grow.');
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
      $reviews=DB::table('reviews')
            ->where('reviews.author_id', '=', $request->id)
            ->where('reviews.active',0) // revisar solo las reviews que se encuentren activas
            ->select('reviews.id', 'reviews.title', 'reviews.active', 'reviews.state','reviews.created_at','reviews.updated_at', 'background_image_url')
            ->get();
      $title= 'Your Reviews';
        return view('reviews/myreviews',compact('reviews'))->withTitle($title)->withInput($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // se entregan datos para actualizar
    {
      $data=Review::where('id', $id)->first();
      // VERIFICAR QUIEN EDITA ES EL DUEÑO DE LA @REVIEW
      if($data->author_id == Auth::user()->id){ // validar que usuario que entra es el mismo que visitante //
            $data['id_review']= $id;
            $data=Review::where('id', $id)->first();
            $data['id'] = $id;
            $title = 'Editing Review'; // No se como chucha pasarselo el titulo a editreview
           return view('reviews/editreview',$data);
         }else{
               return $this->show($id)->withErrors('You can not edit this review');
             }
    }

    public function save(request $request) // no se donde shit se sacan datos para actualizar
    {
      if($request->title != ''){
        if( (Review::where('title', $request->input('title'))->count()) ){
          return back()->withErrors('   Title already exists.');
        }else{
          $review=Review::where("id",$request->id)->first();
          $review->title = $request->input('title');
          $review->background_image_url = $request->input('background_image_url');
          $review->save();
        }
      }
      if('Edit' != $request->input('submit')){
          return redirect('review/' .$request->id. '');
      }
        return redirect('strain/' .$request->id. '/edit');
      }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(request $request)
    {
      $duplicate = Review::where('title',$request->title)->first(); // cuidado no permite modificar titulo si exite almacenados pero esta inactivo
      if($duplicate)
      {
        return back()->withErrors('   Title already exists.')->withInput();// verificar que no exista el nombre
      }
      else{
        //  'review_id', 'update_text', 'created_at', 'updated_at'

        $review=Review::where("id",$request->id)->first();
        $review->title = $request->input('title');
        $review->background_image_url = $request->input('background_image_url');
        $review->save();
      }
      if('Edit' != $request->input('submit')){
          return redirect('review/' . $review->id . '');
      }else{
        $strain = Strain::where('review_id',$data['id'])->get();
        return view('strains/editstrain',$strain);
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
        //
    }

    public function show($id){

      $data['review'] = Review::find($id);
      $data['author'] = UsersProfile::where('user_id', $data['review']->author_id )->first();
      $data['rev_updates'] = ReviewUpdate::join('reviews', 'reviews.id', '=', 'review_updates.review_id')
                            ->where('review_id', $id);
      $data['rev_count'] = $data['rev_updates']->count();
      $data['strains'] = Strain::where('review_id', $id)->get();
      $data['strain_count'] = $data['strains']->count();

      $data['comments'] = DB::table('comments')
       ->join('users_profiles', 'comments.from_user', '=',  'users_profiles.user_id')
       ->select('comments.id','users_profiles.avatar_url', 'comments.from_user', 'comments.on_review', 'comments.body', 'comments.created_at', 'comments.updated_at')
       ->where('comments.on_review',$id)
       ->orderBy('comments.id', 'desc')
       ->get();
       // cantidad de cada strains en la review
       $data['cantidad'] = DB::table('strains')
                    ->select(DB::raw('count(*) as counter, strains.strain_name'))
                    ->where('review_id',$id)
                    ->groupBy('strains.strain_name')
                    ->get();
      //  print_r($data['comments']);
      //  die();


      $max_comment_id = Comment::where('id', DB::raw("(select max(`id`) from comments)"))->first();
      $max_strain_id = Strain::where('id', DB::raw("(select max(`id`) from strains)"))->first();

      $up_votes = array_fill(0,$max_comment_id['id'],0);
      $products_on_strain = array_fill(0,$max_strain_id['id'],0);
      $product_name = array_fill(0, 100, 0);
      $authors_comments = array_fill(0, $max_comment_id['id'], 0);

      foreach ($data['comments'] as $comment) {
        $up_votes[$comment->id - 1] = CommentUpVotes::where('comment_id', $comment->id)->count();
        $authors_comments[$comment->id - 1] = UsersProfile::where('user_id', $comment->from_user)->first();
      }

      foreach ($data['strains'] as $strain) {
        $products_on_strain[$strain->id - 1] = ProductOnStrain::where('strains_id', $strain->id) ? ProductOnStrain::where('strains_id', $strain->id)->get() : 0;
        foreach ($products_on_strain[$strain->id - 1] as $product) {
        $product_name[$product->id - 1] = Product::where('id', $product->id)->select('name')->get();

        }
      }


      $data['products_name'] = $product_name;
      $data['products_on_strain'] = $products_on_strain;
      $data['comments_upvotes'] = $up_votes;
      $data['comments_authors'] = $authors_comments;


      return view('reviews/showreview', $data);
    }
}
