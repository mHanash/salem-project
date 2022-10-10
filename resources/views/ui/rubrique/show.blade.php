@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <h4 class="text-primary page-title">
                        MODIFICATION COMPTE {{ $rubrique->name }}
                    </h4>
                </div>
            </div>
            <div class="row" style="padding-top: 70px;padding-left:10px">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('accounts.update', ['id' => $rubrique->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input value="{{ $rubrique->code }}" required="required" name="code" type="text"
                                id="code" class="form-control" />
                            <label class="form-label" for="code">Code</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input value="{{ $rubrique->name }}" required="required" name="name" type="text"
                                id="name" class="form-control" />
                            <label class="form-label" for="name">Intitulé</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="typeRubrique" id="typeRubrique" class="form-control">
                                <option disabled value="">Type Compte</option>
                                @foreach ($typeRubriques as $item)
                                    @if ($item->id == $rubrique->typeRubrique->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <button type="submit" style="margin-right: 7px" class="btn btn-primary">Modifier</button>
                            <a class="btn btn-info" href="{{ route('accounts') }}">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
