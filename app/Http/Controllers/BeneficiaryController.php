<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Job;
use App\Models\TypeBeneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        $jobs = Job::all();
        $typeBeneficiaries = TypeBeneficiary::all();
        return view('ui.beneficiary.all', [
            'beneficiaries' => $beneficiaries,
            'typeBeneficiaries' => $typeBeneficiaries,
            'typeBeneficiaries' => $typeBeneficiaries,
            'jobs' => $jobs,
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
        if ($beneficiary = Beneficiary::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'type_beneficiary_id' => $request->typeBeneficiary,
            'job_id' => $request->job,
        ])) {
            return redirect()->back()->with('success', 'Elément ajouté');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enregistrement');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Beneficiary $beneficiary)
    {
        $jobs = Job::all();
        $typeBeneficiaries = TypeBeneficiary::all();
        $beneficiary = Beneficiary::find($request->id);
        return view('ui.beneficiary.show', [
            'beneficiary' => $beneficiary,
            'jobs' => $jobs,
            'typeBeneficiaries' => $typeBeneficiaries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Beneficiary $beneficiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $beneficiary = Beneficiary::find($request->id);
        if ($beneficiary->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'type_beneficiary_id' => $request->typeBeneficiary,
            'job_id' => $request->job,
        ])) { {
                return redirect()->route('beneficiaries')->with('success', 'Elément modifié');
            }
            return redirect()->route('beneficiaries')->with('fail', 'Une erreur est survenue lors de la modification');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beneficiary $beneficiary)
    {
        $beneficiary = Beneficiary::find($request->id);
        if ($beneficiary->delete()) { {
                return redirect()->route('beneficiaries')->with('success', 'Elément supprimé');
            }
            return redirect()->route('beneficiaries')->with('fail', 'Une erreur est survenue lors de la suppression');
        }
    }
}
