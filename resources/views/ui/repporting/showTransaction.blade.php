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
                        <li class="list-group-item">Date : {{ $transaction->date }}</li>
                        <li class="list-group-item">Rubrique : {{ $transaction->rubrique->name }}</li>
                        <li class="list-group-item">Libellé : {{ $transaction->description }}</li>
                        <li class="list-group-item">Attributaire : {{ $transaction->beneficiary->name }}
                            {{ $transaction->beneficiary->lastname }} {{ $transaction->beneficiary->firstname }}</li>
                        <li class="list-group-item">Montant : <span class="numberFormat">{{ $transaction->amount }}
                                {{ $transaction->budgeting->currency->currency }}</span></li>
                    </ul>
                    <div class="row mt-3">
                        <div class="col-md-2"><a href="" class="btn btn-sm btn-info">Retour</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
