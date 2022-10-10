<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('ui.status.all', [
            'statuses' => $statuses,
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
        if ($status = Status::create([
            'name' => $request->name,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Status $status)
    {
        $status = Status::find($request->id);
        $statuses = Status::all();
        return view('ui.status.all', [
            'statuses' => $statuses,
            'show' => true,
            'status' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $status = Status::find($request->id);
        if ($status->update([
            'name' => $request->name,
        ])) {
            return redirect()->back()->with('success', 'Elément modifié');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Status $status)
    {
        $status = Status::find($request->id);
        if ($status->delete()) {
            return redirect()->back()->with('success', 'Elément supprimé');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
    }
}
