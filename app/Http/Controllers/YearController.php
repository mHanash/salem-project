<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();
        return view('ui.year.all', [
            'years' => $years,
            'show' => false,
            'year' => null,
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

        $values = explode("-", $request->year);

        if (count(Year::where('year', '=', $values[0] * 1)->get()) > 0) {
            return redirect()->back()->with('fail', 'Une année n\'est enregistrée qu\'une fois');
        }
        if ($year = Year::create([
            'year' => $values[0],
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Year $year)
    {
        $year = Year::find($request->id);
        $years = Year::all();
        return view('ui.year.all', [
            'years' => $years,
            'show' => true,
            'year' => $year,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $year = Year::find($request->id);
        $values = explode("-", $request->year);

        if (count(Year::where('year', '=', $values[0] * 1)->get()) > 0) {
            return redirect()->back()->with('fail', 'Vous n\'avez pas changé de valeur, soit cette année existe déjà!');
        }
        if ($year->update([
            'year' => $values[0],
        ])) {
            return redirect()->back()->with('success', 'Elément modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Year $year)
    {
        $year = Year::find($request->id);
        if ($year->delete()) {
            return redirect()->route('years')->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
