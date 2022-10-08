<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use App\Models\LineBudgeting;
use App\Models\Rubrique;
use App\Models\Status;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RepportingController extends Controller
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
        return view('ui.repporting.home', [
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
        $transactions = Transaction::where('budgeting_id', '=', $request->id)->get();
        $line_budgetings = LineBudgeting::where('budgeting_id', '=', $request->id)->get();
        return view('ui.repporting.all', [
            'transactions' => $transactions,
            'line_budgetings' => $line_budgetings,
            'budgeting' => $budgeting,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $line_budgeting = LineBudgeting::find($request->id);
        $budgeting = $line_budgeting->budgeting;
        $transactions = Transaction::where('budgeting_id', '=', $budgeting->id)->orderBy('date', 'ASC')->get();
        return view('ui.repporting.show', [
            'line_budgeting' => $line_budgeting,
            'budgeting' => $budgeting,
            'transactions' => $transactions,
        ]);
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
    public function update(Request $request, $id)
    {
        //
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
