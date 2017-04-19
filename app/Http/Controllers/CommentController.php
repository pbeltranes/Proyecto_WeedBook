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


   public function create(Request $request)
   {

    //la ruta esta dentro del middleware de Auth, por lo que solo se puede acceder si estamos logeados
    //Por lo que podemos usar el Auth::user() para obtener el usuario y todas las weas que tiene dentro
    //tambien en la vista teniai que se imprimiera la variable $name y esa era pablo siempre, teniai que imprimir $Nombre (actual $name2).

     $name = Auth::user()->name;
     $id = Auth::user()->id;
      $data = [
      "name" => "$name",
      "id" => "$id",
      "on_review" =>1,

    ];

     return view('addcomment', $data);

   }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $review_id)
    {
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
    public function show($id)//-->mostrar todas los comentarios de la review
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
