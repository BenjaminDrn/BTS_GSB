<?php

namespace App\Http\Controllers;

use App\Models\Praticiens;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PraticienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function praticiens(){
        $type_praticien = DB::table('type_praticien')->get();
        return view('praticiens', [
            "type_praticien" => $type_praticien
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $output = '<p class="search_result_error">Aucun résultat</p>';

        if($request->praticien_id){

            $request->validate([
                "praticien_id" => "required|integer",
            ]);

            $praticien = Praticiens::join('TYPE_PRATICIEN', 'PRATICIEN.TYP_CODE', '=', 'TYPE_PRATICIEN.TYP_CODE')
            ->where('PRA_NUM', $request->praticien_id)
            ->first();

            $output = '
                <div class="img_container">
                    <i class="bx bx-user"></i>
                </div>
                <h3>'.$praticien->PRA_NOM. ' ' .$praticien->PRA_PRENOM.'</h3>
                <p class="praticien_libelle">'.$praticien->TYP_LIBELLE.'</p>
                <div class="praticien_adresse">
                    <div class="title_container">
                        <i class="bx bx-map"></i>
                        <p>Adresse</p>
                    </div>
                    <p>'.$praticien->PRA_ADRESSE.'<br>'.$praticien->PRA_CP.', '.$praticien->PRA_VILLE.'</p>
                </div>
                <div class="coef_notoriete">
                    <div class="title_container">
                        <i class="bx bx-stats"></i>
                        <p>Coefficient de notoriété</p>
                    </div>
                    <p>'.$praticien->PRA_COEFNOTORIETE.'</p>
                </div>
                
            ';
        }

        if($request->praticien_name){

            $request->validate([
                "praticien_name" => "required|string",
            ]);

            $praticien = Praticiens::join('TYPE_PRATICIEN', 'PRATICIEN.TYP_CODE', '=', 'TYPE_PRATICIEN.TYP_CODE')
            ->where('PRA_NOM','LIKE','%'.$request->praticien_name.'%')
            ->orWhere('PRA_VILLE','LIKE','%'.$request->praticien_name.'%')
            ->orWhere('TYPE_PRATICIEN.TYP_LIBELLE','LIKE','%'.$request->praticien_name.'%')
            ->get();

            if(count($praticien) > 0){;
                $output = '';
                foreach ($praticien as $row) {
                    $output .= '
                        <div class="btn_open_modal search_result_praticien" data-id="'.$row->PRA_NUM.'" data-modal-id="profil-praticien">
                            <div class="result_praticien_card">
                                <div class="img_container">
                                    <i class="bx bx-user" ></i>
                                </div>
                                <div class="result_praticien_infos">
                                    <p>'.$row->PRA_NOM.' '.$row->PRA_PRENOM.'</p>
                                    <p>'.$row->TYP_LIBELLE.'</p>
                                </div>
                            </div>
                            <div class="result_praticien_location">
                                <i class="bx bx-map"></i>
                                <p>'.$row->PRA_VILLE.'</p>
                            </div>
                        </div>';
                }

            } else {
                $output = '<p class="search_result_error">Aucun résultat</p>';
            }
        } 

        return $output;
        // return response()->json($request);
    }
}
