<?php

namespace App\Http\Controllers;

use App\Models\Offrir;
use App\Models\Praticiens;
use App\Models\RapportVisite;
use App\Models\Visiteurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapportsDeVisite extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rapportDeVisite()
    {
        $rapports = RapportVisite::where('VIS_MATRICULE', Auth::user()->VIS_MATRICULE)
            ->get();
        $meds = DB::table('medicament')->select('MED_NOMCOMMERCIAL')
            ->get();
        $praticiens = DB::table('praticien')->select('PRA_NUM','PRA_NOM', 'PRA_PRENOM')
            ->get();

        return view('rapVisite', [
            "rapports" => $rapports,
            "praticiens" => $praticiens,
            "meds" => $meds
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
        // dd($request->all());

        $request->validate([
            "pra_num" => "required|integer",
            "rap_motif" => "required|string",
            "rap_bilan" => "string"
        ]);

        RapportVisite::create([
            'VIS_MATRICULE' => Auth::user()->VIS_MATRICULE,
            'PRA_NUM' => $request->pra_num,
            'RAP_DATE' =>  now()->format('Y-m-d H:i:s'),
            'RAP_MOTIF' => $request->rap_motif,
            'RAP_BILAN' => $request->rap_bilan
        ]);

        $rap_num = RapportVisite::latest('RAP_NUM')->first();

        $i = 1;
        while($i < 10){

            $med_depotlegal = "med_depotlegal_" . $i;
            $med_quantity = "med_quantity_" . $i;

            if($request->input($med_depotlegal) && $request->input($med_quantity)){
                Offrir::create([
                    'VIS_MATRICULE' => Auth::user()->VIS_MATRICULE,
                    'RAP_NUM' => $rap_num->RAP_NUM,
                    'MED_DEPOTLEGAL' => $request->$med_depotlegal,
                    'OFF_QTE' => $request->$med_quantity
                ]);
            } else {
                break;
            }
            $i++;
        }

        return redirect('/rapport-de-visite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $where = [
            'VIS_MATRICULE' => Auth::user()->VIS_MATRICULE,
            'RAP_NUM' => $id
        ];

        RapportVisite::where($where)->delete();
        Offrir::where($where)->delete();

        return redirect('/rapport-de-visite');
    }

    public function pdf($id){

        $visiteur = Visiteurs::where("VIS_MATRICULE", Auth::user()->VIS_MATRICULE)
            ->first();
        $rapport = RapportVisite::where("RAP_NUM", $id)
            ->first();
        $praticien = Praticiens::join('TYPE_PRATICIEN', 'PRATICIEN.TYP_CODE', '=', 'TYPE_PRATICIEN.TYP_CODE')
            ->where("PRA_NUM", $rapport->PRA_NUM)
            ->first();
        $medicaments = Offrir::where([
                "RAP_NUM" => $id,
                "VIS_MATRICULE" => Auth::user()->VIS_MATRICULE
            ])->get();
        

        $data = [
            "visiteur" => $visiteur,
            "rapport" => $rapport,
            "praticien" => $praticien,
            "medicaments" => $medicaments
        ];
        
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf', $data);
        return $pdf->stream();
        // return $pdf->download('rapport.pdf');
    }

}
