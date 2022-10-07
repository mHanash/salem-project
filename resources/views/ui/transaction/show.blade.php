@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succès ! </strong>{{ session()->get('success') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erreur ! </strong>{{ session()->get('fail') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 5px">
                    <div class="col-md-9">
                        <h5 class="page-title text-primary">
                            Détails de la transaction
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('transactions.update', ['id' => $transaction->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control">{{ $transaction->description }}</textarea>
                            <label class="form-label" for="description">Libellé</label>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" name="amount" value="{{ $transaction->amount }}" type="number"
                                    id="amount" class="form-control" />
                                <label class="form-label" for="amount">Montant</label>
                            </div>
                            <div class="text-danger"> - {{ $budgeting->currency->currency }}</div>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="rubrique" id="rubrique" class="form-control">
                                <option value="">Compte</option>
                                @foreach ($rubriques as $item)
                                    @if ($item->typeRubrique->state == $transaction->rubrique->typeRubrique->state)
                                        @if ($item->id == $transaction->rubrique->id)
                                            <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" value="{{ $transaction->date }}" name="date" type="date"
                                    id="date" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="beneficiary" id="beneficiary" class="form-control">
                                <option value="">Attributaire</option>
                                @foreach ($beneficiaries as $item)
                                    @if ($item->id == $transaction->beneficiary->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}
                                            {{ $item->lastname }}
                                            {{ $item->firstname }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastname }}
                                            {{ $item->firstname }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="budgeting" value="{{ $budgeting->id }}">
                        <div class="d-flex">
                            <a href="{{ route('transactions', ['id' => $budgeting->id]) }}" class="btn btn-danger"
                                style="margin-right: 5px">Retour</a>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
