<?php

namespace App\Http\Controllers;

use App\Models\TypeRubrique;
use Illuminate\Http\Request;

class TypeRubriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TypeRubrique::all();
        return view('ui.typeRubrique.all', [
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
        $stateVal = false;
        if ($request->state == "1") {
            $stateVal = true;
        }

        if ($type = TypeRubrique::create([
            'name' => $request->name,
            'state' => $stateVal,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeRubrique  $typeRubrique
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeRubrique $typeRubrique)
    {
        $typeRubrique = TypeRubrique::find($request->id);
        $types = TypeRubrique::all();
        return view('ui.typeRubrique.all', [
            'types' => $types,
            'show' => true,
            'type' => $typeRubrique,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeRubrique  $typeRubrique
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeRubrique $typeRubrique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeRubrique  $typeRubrique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeRubrique $typeRubrique)
    {
        $typeRubrique = TypeRubrique::find($request->id);
        if ($typeRubrique->update([
            'name' => $request->name,
            'state' => $request->state == "1" ? true : false,
        ])) {
            return redirect()->back()->with('success', 'Elément modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeRubrique  $typeRubrique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TypeRubrique $typeRubrique)
    {
        $typeRubrique = TypeRubrique::find($request->id);
        if ($typeRubrique->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
