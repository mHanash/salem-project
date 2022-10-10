<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use App\Models\LineBudgeting;
use App\Models\Rubrique;
use App\Models\Status;
use Illuminate\Http\Request;

class LineBudgetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $status = Status::where("name", "=", 'ACTIVED')->first();
        $budgetings = Budgeting::where("status_id", "=", $status->id)->get();
        return view('ui.lineBudgeting.home', [
            'budgetings' => $budgetings
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $budgeting = Budgeting::find($request->id);
        $lineBudgetings = LineBudgeting::where('budgeting_id', '=', $budgeting->id)->get();
        $rubriques = $budgeting->rubriques()->orderBy('name', 'ASC')->get();
        return view('ui.lineBudgeting.all', [
            'rubriques' => $rubriques,
            'lineBudgetings' => $lineBudgetings,
            'budgeting' => $budgeting
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
        if ($lineBudgeting = LineBudgeting::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'rubrique_id' => $request->rubrique,
            'budgeting_id' => $request->budgeting,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LineBudgeting  $lineBudgeting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LineBudgeting $lineBudgeting)
    {
        $lineBudgeting = LineBudgeting::find($request->id);
        $budgeting = $lineBudgeting->budgeting;
        $rubriques = $budgeting->rubriques()->orderBy('name', 'ASC')->get();
        return view('ui.lineBudgeting.show', [
            'lineBudgeting' => $lineBudgeting,
            'rubriques' => $rubriques,
            'budgeting' => $budgeting,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LineBudgeting  $lineBudgeting
     * @return \Illuminate\Http\Response
     */
    public function edit(LineBudgeting $lineBudgeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LineBudgeting  $lineBudgeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LineBudgeting $lineBudgeting)
    {
        $lineBudgeting = LineBudgeting::find($request->id);
        if ($lineBudgeting->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'rubrique_id' => $request->rubrique,
            'budgeting_id' => $request->budgeting,
        ])) {
            return redirect()->route('plannings', ['id' => $request->budgeting])->with('success', 'Elément modifié');
        }
        return redirect()->route('plannings', ['id' => $request->budgeting])->with('fail', 'Une erreur est survenue lors de la modifiaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LineBudgeting  $lineBudgeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LineBudgeting $lineBudgeting)
    {
        $lineBudgeting = LineBudgeting::find($request->id);
        if ($lineBudgeting->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
