<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Currency::all();
        return view('ui.currency.all', [
            'currencies' => $types,
            'show' => false,
            'currency' => null,
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
        if ($currency = Currency::create([
            'currency' => $request->currency,
            'description' => $request->description,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Currency $currency)
    {
        $currency = Currency::find($request->id);
        $currencies = Currency::all();
        return view('ui.currency.all', [
            'currencies' => $currencies,
            'show' => true,
            'currency' => $currency,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $currency = Currency::find($request->id);
        if ($currency->update([
            'currency' => $request->currency,
            'description' => $request->description,
        ])) {
            return redirect()->back()->with('success', 'Elément modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Currency $currency)
    {
        $currency = Currency::find($request->id);
        if ($currency->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
