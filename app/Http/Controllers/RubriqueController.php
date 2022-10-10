<?php

namespace App\Http\Controllers;

use App\Models\Rubrique;
use App\Models\TypeRubrique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RubriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubriques = Rubrique::orderBy('name', 'ASC')->paginate(10);
        $data = [];
        foreach ($rubriques as $value) {
            $type = TypeRubrique::find($value->type_rubrique_id);
            array_push($data, [
                'id' => $value->id,
                'name' => $value->name,
                'code' => $value->code,
                'type' => $type->name,
            ]);
        }
        $typeRubriques = TypeRubrique::all();
        return view('ui.rubrique.all', [
            'rubriques' => $rubriques,
            'typeRubriques' => $typeRubriques,
            'data' => $data,
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
        if ($rubrique = Rubrique::create([
            'code' => $request->code,
            'name' => $request->name,
            'type_rubrique_id' => $request->typeRubrique,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rubrique  $rubrique
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Rubrique $rubrique)
    {
        $typeRubriques = TypeRubrique::all();
        $rubrique = Rubrique::find($request->id);
        return view('ui.rubrique.show', [
            'rubrique' => $rubrique,
            'typeRubriques' => $typeRubriques,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rubrique  $rubrique
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubrique $rubrique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rubrique  $rubrique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubrique $rubrique)
    {
        $rubrique = Rubrique::find($request->id);
        if ($rubrique->update([
            'code' => $request->code,
            'name' => $request->name,
            'type_rubrique_id' => $request->typeRubrique,
        ])) { {
                return redirect()->route('accounts')->with('success', 'Elément modifié');
            }
            return redirect()->route('accounts')->with('fail', 'Une erreur est survenue lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rubrique  $rubrique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rubrique $rubrique)
    {
        $rubrique = Rubrique::find($request->id);
        if ($rubrique->delete()) { {
                return redirect()->route('accounts')->with('success', 'Elément supprimé');
            }
            return redirect()->route('accounts')->with('fail', 'Une erreur est survenue lors de la suppression');
        }
    }
}
