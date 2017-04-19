<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\ApiBanks;
use App\ApiStrains;

class StrainController extends Controller
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

    public function updateApi()
    {

        $client = new Client(); 
        $meta = $client->get('https://www.cannabisreports.com/api/v1.0/strains', [
            'query' => ['sort' => 'name',
                        'page' => '1',
                        ]
        ]);

        $meta_json = json_decode($meta->getBody(), true);
        $meta = $meta_json['meta']['pagination'];
     
        $page_number = $meta['total_pages'];

        for ($page=1; $page <= $page_number; $page++) {

           $data = $client->get('https://www.cannabisreports.com/api/v1.0/strains', [
                'query' => ['sort' => 'name',
                            'page' => $page,
                            ]
            ]);               
           $data_json = json_decode($data->getBody(), true);
           $strains_in_page = $data_json['meta']['pagination']['count'];
           $data = $data_json['data'];
           for ($i=0; $i < $strains_in_page; $i++) { 
               $strain_name = $data[$i]['name'];
               $strain_bank = $data[$i]['seedCompany']['name'];
               $banks_exist = ApiBanks::where('bank_name', $strain_bank) ? TRUE:FALSE;
               $strain_exist = ApiStrains::where('strain_name', $strain_name) ? TRUE:FALSE;
               if($strain_exist && $banks_exist){
                continue;
               }else{
                ApiBanks::create([
                    'bank_name' => $strain_bank,
                ]);

               ApiStrains::create([
                    'strain_name' => $strain_name,
                ]);
               }
               
           }
        }
        return back()->withMessage('Api Actualizada con exito');
    }
}
