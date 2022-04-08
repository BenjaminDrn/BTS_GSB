<?php

namespace App\Http\Controllers;

use App\Models\Visiteurs;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $account = Visiteurs::where('VIS_MATRICULE', Auth::user()->VIS_MATRICULE)->first();
        return view('account', [
            "account" => $account
        ]);
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
    public function update(Request $request)
    {
        $request->validate([
            "vis_adresse" => "required|string",
            "vis_cp" => "required|string",
            "vis_ville" => "required|string"
        ]);

        Visiteurs::where("VIS_MATRICULE", Auth::user()->VIS_MATRICULE)
        ->update([
            "VIS_ADRESSE" => $request->vis_adresse,
            "VIS_CP" => $request->vis_cp,
            "VIS_VILLE" => $request->vis_ville
        ]);

        return redirect('/compte');

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
