<?php

namespace App\Http\Controllers;

use App\Models\TypeBeneficiary;
use Illuminate\Http\Request;

class TypeBeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TypeBeneficiary::all();
        return view('ui.typeBeneficiary.all', [
            'types' => $types,
            'show' => false,
            'type' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($type = TypeBeneficiary::create([
            'name' => $request->name
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeBeneficiary  $typeBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeBeneficiary $typeBeneficiary)
    {
        $typeBeneficiary = TypeBeneficiary::find($request->id);
        $types = TypeBeneficiary::all();
        return view('ui.typeBeneficiary.all', [
            'types' => $types,
            'show' => true,
            'type' => $typeBeneficiary,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeBeneficiary  $typeBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeBeneficiary $typeBeneficiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeBeneficiary  $typeBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeBeneficiary $typeBeneficiary)
    {
        $typeBeneficiary = TypeBeneficiary::find($request->id);
        if ($typeBeneficiary->update([
            'name' => $request->name
        ])) {
            return redirect()->back()->with('success', 'Elément modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeBeneficiary  $typeBeneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeBeneficiary $typeBeneficiary, Request $request)
    {
        $typeBeneficiary = TypeBeneficiary::find($request->id);
        if ($typeBeneficiary->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
