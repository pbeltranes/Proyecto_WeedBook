<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductOnStrain;

class ProductController extends Controller
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
        return view('products/newproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = Product::create([
            'name' => $request->input('product_name'),
            'use_time' => $request->input('use_time'),
            'how_to_use' => $request->input('how_to_use'),
            ]);

        $prod->save();
        return redirect('/');
    }

    public function addProdToStrain($id){
        $data['strain_id'] = $id;
        $data['products'] = Product::all();
        return view('products/addproduct', $data);
    }

    public function saveProdToStrain(Request $request){
        $prod = ProductOnStrain::create([
            'products_id' => $request->input('prod_id'),
            'strains_id' => $request->input('strain_id'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            ]);
        $prod->save();
        return redirect('strain/' . $request->id);
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
