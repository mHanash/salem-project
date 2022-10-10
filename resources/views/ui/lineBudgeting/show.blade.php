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
                            Détails de la prévision
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('plannings.update', ['id' => $lineBudgeting->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control">{{ $lineBudgeting->description }}</textarea>
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input value="{{ $lineBudgeting->amount }}" required="required" name="amount"
                                    type="number" id="amount" class="form-control" />
                                <label class="form-label" for="amount">Montant</label>
                            </div>
                            <div class="text-danger"> - {{ $budgeting->currency->currency }}</div>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="rubrique" id="rubrique" class="form-control">
                                <option value="">Compte</option>
                                @foreach ($rubriques as $item)
                                    @if ($item->typeRubrique->state == $lineBudgeting->rubrique->typeRubrique->state)
                                        @if ($item->id == $lineBudgeting->rubrique->id)
                                            <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value="{{ $budgeting->id }}" name="budgeting">
                        <div class="d-flex">
                            <a href="{{ route('plannings', ['id' => $budgeting->id]) }}" style="margin-right: 5px"
                                class="btn btn-danger">Fermer</a>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
