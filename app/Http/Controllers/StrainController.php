<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\ApiBanks;
use App\ApiStrains;
use App\Strain;
use App\Review;
use App\StrainUpdate;
use App\ProductOnStrain;

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
    public function create($review_id)
    {
        $data = [
            'review_id' => $review_id,
        ];
        return view('strains/newstrain', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      for ($i=0; $i <$request->input('nro_strains') ; $i++) {

        $strain = Strain::create([
            'review_id' => $request->input('review_id'),
            'bank' => $request->input('bank'),
            'strain_name' => $request->input('strain_name'),
            'technique' => $request->get('technique'),
            'seed_type' => $request->get('seed_type'),
            'germ_start' => $request->input('germ_start'),
            'veg_start' => $request->input('veg_start'),
            'flow_strat' => $request->input('flow_start'),
            'harvest_date' => $request->input('harvest_date'),
            'active' => 1,
            'grow_type' => $request->get('grow_type'),
            'light_type' => $request->get('light_type'),
            'light_power' => $request->input('light_power'),

            ]);
        $strain->save();
      }
      if('Other' == $request->input('submit')) // si se agregan mas plantas a la misma reseña
      {
        $data = [
            'review_id' => $request->input('review_id'),
        ];
        return view('strains/newstrain', $data);
      }else{
        // Mas adelante eliminar Strain_number de tabla review debido a que es un dato dinamico y no necesariamente un dato que deba ser almacenado, dado que se puede contar directamente
      // se deja para mas adelante cuando se disponga de mas tiempo y se vaya a pulir
        $nro= Strain::where('review_id', $request->input('review_id'))->count();
        $review = Review::find($request->input('review_id')); // Lo mismo pero de dos formas $review=Review::where("id",$request->input('review_id'))->first();
        $review->strain_number = $nro; // hay que ocultar el cultivo
        $review->save();
        return redirect('review/' . $request->input('review_id') . ''); // se termina exitosamente la operación
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
        $data['strain'] = Strain::find($id);
        $data['strain_updates'] = StrainUpdate::where('strain_id', $id)->get();
        $data['strain_products'] = ProductOnStrain::where('strains_id', $id)->get();
        $data['update_count'] = $data['strain_updates']->count();
        return view('strains/viewstrain', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
      for ($i=0; $i<count($request->strain_name); $i++) {
        $strains = Strain::where('review_id',$request->id)
                          ->where('strain_name',$request->strain_name_origin_[$i])
                          ->get();

          if($request->quanty_[$i] == 'All'){

                foreach ($strains as $strain) {
                    $strain->strain_name = $request->strain_name[$i] == '' ? $strain->strain_name: $request->strain_name[$i];
                    $strain->bank = $request->bank[$i] == '' ? $strain->bank: $request->bank[$i];
                    $strain->strain_name = $request->strain_name[$i] == '' ? $strain->strain_name: $request->strain_name[$i];
                    $strain->technique = $request->technique[$i]== '' ? $strain->technique:$request->technique[$i];
                    $strain->seed_type = $request->seed_type[$i]== '' ? $strain->seed_type:$request->seed_type[$i];
                    $strain->germ_start = $request->germ_start[$i]== '' ? $strain->germ_start:$request->germ_start[$i];
                    $strain->veg_start = $request->veg_start[$i]== '' ? $strain->veg_start:$request->veg_start[$i];
                    $strain->flow_start = $request->flow_start[$i]== '' ? $strain->flow_start:$request->flow_start[$i];
                    $strain->harvest_date = $request->harvest_date[$i]== '' ? $strain->harvest_date:$request->harvest_date[$i];
                    $strain->grow_type = $request->grow_type[$i]== '' ? $strain->grow_type:$request->grow_type[$i];
                    $strain->light_type = $request->light_type[$i]== '' ? $strain->light_type:$request->light_type[$i];
                    $strain->light_power = $request->light_power[$i]== '' ? $strain->light_power:$request->light_power[$i];
                    $strain->save();
                  }
              }

          if($request->quanty_[$i]  == 'Other'){
            $stop = 0;
            if($request->nro_strains_changes[$i] < 0) break;
            foreach ($strains as $strain) {
                $strain->strain_name = $request->strain_name[$i] == '' ? $strain->strain_name: $request->strain_name[$i]; 
                $strain->bank = $request->bank[$i] == '' ? $strain->bank: $request->bank[$i];
                $strain->strain_name = $request->strain_name[$i] == '' ? $strain->strain_name: $request->strain_name[$i];
                $strain->technique = $request->technique[$i]== '' ? $strain->technique:$request->technique[$i];
                $strain->seed_type = $request->seed_type[$i]== '' ? $strain->seed_type:$request->seed_type[$i];
                $strain->germ_start = $request->germ_start[$i]== '' ? $strain->germ_start:$request->germ_start[$i];
                $strain->veg_start = $request->veg_start[$i]== '' ? $strain->veg_start:$request->veg_start[$i];
                $strain->flow_start = $request->flow_start[$i]== '' ? $strain->flow_start:$request->flow_start[$i];
                $strain->harvest_date = $request->harvest_date[$i]== '' ? $strain->harvest_date:$request->harvest_date[$i];
                $strain->grow_type = $request->grow_type[$i]== '' ? $strain->grow_type:$request->grow_type[$i];
                $strain->light_type = $request->light_type[$i]== '' ? $strain->light_type:$request->light_type[$i];
                $strain->light_power = $request->light_power[$i]== '' ? $strain->light_power:$request->light_power[$i];
                $strain->save();
                if($stop < $request->nro_strains_changes[$i]) break;
                $stop++;

                }
              }
        }

        //return view('');
        return redirect('review/' . $request->id. '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function edit($id){
       $data['id_review']= $id;
       $data['strain'] = Strain::where('review_id',$id)->get();
       $data['review'] = Review::where('id',$id)->get();
       //$count_strains  =DB::table('reviews')->where('id',$id)->sum('reviews.strain_number');
       $data['cantidad'] = DB::table('strains')
                    ->select(DB::raw('count(*) as counter, strains.strain_name'))
                    ->where('review_id',$id)
                    ->groupBy('strains.strain_name')
                    ->get();
       if (!DB::table('reviews')->where('id',$id)->sum('reviews.strain_number'))
          return redirect('review/' .$id. '/new-strain')->withMessage('You have the review but it hasn\'t crops');
       return view('strains/editstrain',$data);
     }
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

               if(!$strain_exist){
                    ApiStrains::create([
                        'strain_name' => $strain_name,
                    ]);
               }

               if(!$banks_exist){
                    ApiBanks::create([
                        'bank_name' => $strain_bank,
                    ]);
               }

           }
        }
        return back()->withMessage('Api Actualizada con exito');
    }
}
