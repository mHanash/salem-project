<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use App\Models\Currency;
use App\Models\Status;
use App\Models\Year;
use Illuminate\Http\Request;

class BudgetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgetings = Budgeting::all();
        $status = Status::orderBy('name', 'ASC')->get();
        $currencies = Currency::orderBy('currency', 'ASC')->get();
        $years = Year::orderBy('year', 'ASC')->get();
        return view('ui.budgeting.all', [
            'budgetings' => $budgetings,
            'status' => $status,
            'currencies' => $currencies,
            'years' => $years,
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
        if ($budgeting = Budgeting::create([
            'description' => $request->description,
            'start_year_id' => $request->startYear,
            'end_year_id' => $request->endYear,
            'currency_id' => $request->currency,
            'status_id' => $request->status,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Budgeting $budgeting)
    {
        $status = Status::all();
        $currencies = Currency::all();
        $years = Year::all();
        $budgeting = Budgeting::find($request->id);
        return view('ui.budgeting.show', [
            'budgeting' => $budgeting,
            'status' => $status,
            'currencies' => $currencies,
            'years' => $years,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Budgeting $budgeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budgeting $budgeting)
    {
        $budgeting = Budgeting::find($request->id);
        if ($budgeting->update([
            'description' => $request->description,
            'start_year_id' => $request->startYear,
            'end_year_id' => $request->endYear,
            'currency_id' => $request->currency,
            'status_id' => $request->status,
        ])) { {
                return redirect()->route('budgetings')->with('success', 'Elément modifié');
            }
            return redirect()->route('budgetings')->with('fail', 'Une erreur est survenue lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budgeting  $budgeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Budgeting $budgeting)
    {
        $budgeting = Budgeting::find($request->id);
        if ($budgeting->delete()) { {
                return redirect()->route('budgetings')->with('success', 'Elément supprimé');
            }
            return redirect()->route('budgetings')->with('fail', 'Une erreur est survenue lors de la suppression');
        }
    }
}
