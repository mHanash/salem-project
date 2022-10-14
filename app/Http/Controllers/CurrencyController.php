<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use App\Models\Currency;
use App\Models\Status;
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

    public function rate()
    {
        $status = Status::where("name", "=", 'ACTIVED')->first();
        $budgetings = Budgeting::where("status_id", "=", $status->id)->get();
        return view('ui.rate.home', [
            'budgetings' => $budgetings
        ]);
    }

    public function rateIndex(Request $request)
    {
        $budgeting = Budgeting::find($request->id);
        $currency = $budgeting->currency;
        $currencies = [];
        $datas = Currency::where('id', '<>', $budgeting->currency->id)->orderBy('currency', 'ASC')->get();
        foreach ($datas as $value) {
            if (count($value->currencies) > 0) {
                $test = false;
                foreach ($value->currencies as $item) {
                    if ($item->id != $currency->id) {
                        $test = true;
                    }
                }
                if ($test) {
                    array_push($currencies, $value);
                }
            } else {
                array_push($currencies, $value);
            }
        }
        return view('ui.rate.all', ['currency' => $currency, 'show' => false, 'currencies' => $currencies, 'budgeting' => $budgeting]);
    }

    public function rateStore(Request $request)
    {
        $budgeting = Budgeting::find($request->budgeting);
        $currencyCurr = $budgeting->currency;
        $currencyCurr->changes()->attach($request->currency, ['rate' => $request->rate, 'budgeting_id' => $budgeting->id]);
        return redirect()->back()->with('success', 'Taux enregistré');
    }

    public function rateDestroy(Request $request)
    {
        $other = Currency::find($request->id);
        $budgeting = Budgeting::find($request->budgeting);
        $currencyCurr = $budgeting->currency;

        foreach ($other->currencies()->get() as $item) {
            if ($currencyCurr->id == $item->id) {
                $other->currencies(['currency_id' => $currencyCurr->id, 'budgeting_id' => $budgeting->id])->detach();
            }
        }
        return redirect()->back()->with('success', 'Suppression effectuée');
    }
}
