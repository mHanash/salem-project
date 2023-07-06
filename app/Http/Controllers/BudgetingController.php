<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use App\Models\Currency;
use App\Models\Rubrique;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\Year;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubriques = Rubrique::orderBy('name', 'ASC')->get();
        $budgetings = Budgeting::all();
        $status = Status::orderBy('name', 'ASC')->get();
        $currencies = Currency::orderBy('currency', 'ASC')->get();
        $years = Year::orderBy('year', 'ASC')->get();
        return view('ui.budgeting.all', [
            'budgetings' => $budgetings,
            'status' => $status,
            'currencies' => $currencies,
            'years' => $years,
            'rubriques' => $rubriques,
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
            $budgeting->rubriques()->attach($request->rubrique);
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
        $rubriques = Rubrique::orderBy('name', 'ASC')->get();
        $years = Year::all();
        $budgeting = Budgeting::find($request->id);
        $rubriquesOwn = $budgeting->rubriques()->orderBy('name', 'ASC')->get();
        return view('ui.budgeting.show', [
            'currencies' => $currencies,
            'rubriques' => $rubriques,
            'budgeting' => $budgeting,
            'status' => $status,
            'years' => $years,
            'rubriquesOwn' => $rubriquesOwn,
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
        ])) {
            if ($request->rubriques) {
                $budgeting->rubriques()->sync($request->rubriques);
            }

            return redirect()->route('budgetings.show', ['id' => $budgeting->id])->with('success', 'Elément modifié');
        }
        return redirect()->route('budgetings.show', ['id' => $budgeting->id])->with('fail', 'Une erreur est survenue lors de la modification');
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

    public function viewAll(Request $request)
    {
        $budgeting = Budgeting::find($request->id);
        $line_budgetings = $budgeting->rubriques()->orderBy('code', 'ASC')->get();
        $transactions = Transaction::where('budgeting_id', '=', $request->id)->get();
        $currency = $budgeting->currency;
        $datas = [];
        $toCurrencies = $currency->changes()->where('budgeting_id', "=", $budgeting->id)->orderBy('currency')->get();
        foreach ($line_budgetings as $line) {
            $amountExec = 0;
            foreach ($transactions as $value) {
                if ($line->id == $value->rubrique->id) {
                    $amountExec += $value->amount;
                }
            }
            array_push($datas, [
                'name' => $line->name,
                'state' => $line->typeRubrique->state,
                'amountExec' => $amountExec,
            ]);
        }
        $pdf = Pdf::loadView('generatePDF/executionAllToPdf', [
            'datas' => $datas,
            'user' => Auth::user(),
            'budgeting' => $budgeting,
            'toCurrencies' => $toCurrencies,

        ])->setPaper('a4', 'landscape')->set_option("isPhpEnabled", true);
        // return $pdf->stream();
        return $pdf->download(date('U-Y-m-d') . "-" . \Str::slug('Rapport Budget -') . $budgeting->startYear->year . "-" . $budgeting->endYear->year . ".pdf");
    }
}
