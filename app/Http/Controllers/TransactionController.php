<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Budgeting;
use App\Models\Rubrique;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\TypeRubrique;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        return view('ui.transaction.home', [
            'budgetings' => $budgetings
        ]);
    }
    public function index(Request $request)
    {
        $budgeting = Budgeting::find($request->id);
        $transactions = Transaction::orderBy('date', 'ASC')->get();
        $rubriques = Rubrique::orderBy('name', 'ASC')->get();
        $beneficiaries = Beneficiary::orderBy('name', 'ASC')->get();;
        return view('ui.transaction.all', [
            'transactions' => $transactions,
            'budgeting' => $budgeting,
            'rubriques' => $rubriques,
            'beneficiaries' => $beneficiaries,
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
        if ($transaction = Transaction::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'rubrique_id' => $request->rubrique,
            'beneficiary_id' => $request->beneficiary,
            'budgeting_id' => $request->budgeting,
            'date' => $request->date,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::find($request->id);
        $budgeting = $transaction->budgeting;
        $rubriques = Rubrique::orderBy('name', 'ASC')->get();
        $beneficiaries = Beneficiary::orderBy('name', 'ASC')->get();;
        return view('ui.transaction.show', [
            'transaction' => $transaction,
            'rubriques' => $rubriques,
            'budgeting' => $budgeting,
            'beneficiaries' => $beneficiaries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::find($request->id);
        if ($transaction->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'rubrique_id' => $request->rubrique,
            'beneficiary_id' => $request->beneficiary,
            'budgeting_id' => $request->budgeting,
            'date' => $request->date,
        ])) {
            return redirect()->route('transactions', ['id' => $request->budgeting])->with('success', 'Elément modifié');
        }
        return redirect()->route('transactions', ['id' => $request->budgeting])->with('fail', 'Une erreur est survenue lors de la modifiaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::find($request->id);
        if ($transaction->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
