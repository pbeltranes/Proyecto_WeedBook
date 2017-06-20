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
use App\apiBanks;
use App\apiStrains;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //saca 6 reseñas en orden por rep

        $data['reviews'] = Review::where('active',0)
        ->join('users_profiles', 'reviews.author_id', '=', 'users_profiles.user_id')
        ->selectRaw('reviews.id, reviews.active, reviews.background_image_url, reviews.title, users_profiles.user_name, users_profiles.user_id, (SELECT COUNT(review_up_votes.id) from review_up_votes WHERE review_up_votes.review_id = reviews.id GROUP BY review_up_votes.review_id) as C')
        ->groupBy('reviews.id')
        ->orderBy('C', 'DESC')
        ->paginate(6);

        $data['title'] = 'WeedBook World';
        $data['url'] = '/images/';
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
        return back()->withErrors('     Please write the title of your review, bitch!.')->withInput();
      if($duplicate)
      {
        return back()->withErrors('       Title already exists.')->withInput();// verificar que no exista el nombre
      }
      else{
        $R = Review::create([ // creamos review
          'author_id'=> $request->user()->id,
          'strain_number'=> 0, //-->>ingresar id de la review que se esta comentando
          'title' => $request->title,
          'state' => 0,
          'active' => 0, // cultivo activo
          'background_image_url' => $this->uploading_image($request->file('background_image_url')),
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
      $data['id'] = Auth::user()->id;
      $data['reviews']=DB::table('reviews')
            ->where('reviews.author_id', '=', $request->id)
            ->where('reviews.active',0) // revisar solo las reviews que se encuentren activas
            ->select('reviews.id', 'reviews.title', 'reviews.active', 'reviews.state','reviews.created_at','reviews.updated_at', 'background_image_url')
            ->get();
      $data['title'] = 'Your Reviews';
      $data['url'] = '/images/';
        return view('reviews/myreviews',$data);
    }

    public function updateReview($id, Request $request){
      $review_update = ReviewUpdate::create([
                  'review_id' => $id,
                  'update_text' => $request->input('update_text'),
                ]);
      $review_update->save();

      $strains_id = Strain::where('review_id', $id)->selectRaw('strains.id as id')->get();

      foreach ($strains_id as $id) {
      $img  = $this->uploading_image($request->input('update_image_url' . $id->id));
           $strain_update = StrainUpdate::create([
                  'strain_id' => $id->id,
                  'height' => $request->input('height' . $id->id),
                  'darkness_time' => $request->input('darkness_time' . $id->id),
                  'light_time' => $request->input('light_time' . $id->id),
                  'stage' => $request->input('stage' . $id->id),
                  'veg_prod_quantity' => $request->input('veg_prod_quantity' . $id->id),
                  'flow_prod_quantity' => $request->input('flow_prod_quantity' . $id->id),
                  'other_prod_quantity' => $request->input('other_prod_quantity' . $id->id),
                  'update_image_url' => $img,
                  ]);

          $strain_update->save();
      }

      return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function uploading_image($file){
        if($file != NULL)
       $ext = $file->getClientOriginalExtension();
       else
       return 'DEFAULT_REVIEW_URL.png';
        if($ext =! 'jpg' & $ext != 'jpeg' & $ext != 'bmp' & $ext != 'gif' & $ext != 'png')
             return 'DEFAULT_REVIEW_URL.png';
           else{
             $nombre = $file->getClientOriginalName();
             $hash_name = md5($nombre. time()).'.'. $file->getClientOriginalExtension();
             \Storage::disk('local')->put($hash_name,  \File::get($file));
               return $hash_name;
             }
           }
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
          $review->background_image_url = $this->uploading_image($request->input('background_image_url'));
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
        $review->background_image_url = $this->uploading_image($request->input('background_image_url'));
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
      $data['url'] = '/images/';
      $data['author'] = UsersProfile::where('user_id', $data['review']->author_id)->first();

      $data['rev_updates'] = ReviewUpdate::join('reviews', 'reviews.id', '=', 'review_updates.review_id')
                            ->where('review_id', $id);

      $data['rev_count'] = $data['rev_updates']->count();

      $data['strains'] = Strain::where('review_id', $id)
                          ->leftJoin('strain_updates', 'strain_updates.strain_id', '=', 'strains.id')
                          ->selectRaw('strains.id, strains.strain_name, strains.bank, strains.technique, strains.grow_type, strains.light_type, strains.light_power, strains.seed_type')
                          ->groupBy('strains.id')
                          ->get();


      $data['strain_updates'] = Strain::where('review_id', $id)
                                ->join('strain_updates', 'strain_updates.strain_id', '=', 'strains.id')
                                ->selectRaw('strains.id as id, strain_updates.height, strain_updates.darkness_time, strain_updates.light_time, strain_updates.stage, strain_updates.veg_prod_quantity, strain_updates.flow_prod_quantity, strain_updates.other_prod_quantity, strain_updates.created_at, strain_updates.updated_at, strain_updates.update_image_url')
                                ->orderBy('strain_updates.created_at')
                                ->get();

      $data['strain_count'] = $data['strains']->count();

      $data['products_on_strain'] = ProductOnStrain::join('strains', 'strains.id', '=', 'product_on_strains.strains_id')
                                    ->where('strains.review_id', $id)
                                    ->join('products', 'products.id', '=', 'product_on_strains.products_id')
                                    ->select('strains.id', 'products.name')
                                    ->get();

       $data['comments'] = Comment::where('on_review', $id)
                            ->join('users_profiles', 'comments.from_user', '=', 'users_profiles.user_id')
                            ->leftJoin('comment_up_votes', 'comment_up_votes.comment_id', '=', 'comments.id')
                            ->groupBy('comments.id')
                            ->selectRaw('count(comment_up_votes.id) as upvotes, comments.id, users_profiles.avatar_url, comments.from_user, comments.on_review, comments.body, comments.created_at, comments.updated_at, users_profiles.user_name')
                            ->orderBy('comments.id', 'desc')
                            ->get();

       // cantidad de cada strains en la review
       $data['cantidad'] = DB::table('strains')
                    ->select(DB::raw('count(*) as counter, strains.strain_name'))
                    ->where('review_id',$id)
                    ->groupBy('strains.strain_name')
                    ->get();


      $data['owns_review'] = FALSE;
      if(isset(Auth::user()->id))
        $data['owns_review'] = Auth::user()->id == $data['review']->author_id ? TRUE : FALSE;

      $data['api_banks'] = apiBanks::selectRaw('bank_name as name')->get();
      $data['api_strains'] = apiStrains::selectRaw('strain_name as name')->get();

      //  print_r($data['comments']);
      //  die();

      return view('reviews/showreview', $data);
    }
}
