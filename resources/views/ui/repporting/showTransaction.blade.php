@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 5px">
                    <div class="col-md-9">
                        <h5 class="page-title text-primary">
                            Détails de la transaction
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="text-primary"> Date :</span> {{ $transaction->date }}</li>
                        <li class="list-group-item"><span class="text-primary">Rubrique :</span>
                            {{ $transaction->rubrique->name }}</li>
                        <li class="list-group-item"><span class="text-primary">Libellé :</span>
                            {{ $transaction->description }}</li>
                        <li class="list-group-item"><span class="text-primary">Attributaire :</span>
                            {{ $transaction->beneficiary->name }}
                            {{ $transaction->beneficiary->lastname }} {{ $transaction->beneficiary->firstname }}</li>
                        <li class="list-group-item"><span class="text-primary">Montant : </span><span
                                class="numberFormat">{{ $transaction->amount }}
                            </span> {{ $transaction->budgeting->currency->currency }}</li>
                    </ul>
                    <div class="row mt-3">
                        <div class="col-md-2"><a href="{{ route('repportings', ['id' => $transaction->budgeting->id]) }}"
                                class="btn btn-sm btn-info">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
