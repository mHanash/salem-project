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
                <div class="row align-items-center">
                    <h4 class="text-primary page-title">
                        MODIFICATION INFO BUDGET
                    </h4>
                </div>
            </div>
            <div class="row" style="padding-top: 5px;padding-left:10px">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('budgetings.update', ['id' => $budgeting->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input value="{{ $budgeting->description }}" required="required" name="description"
                                type="text" id="description" class="form-control" />
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="startYear" id="startYear" class="form-control">
                                <option disabled value="">Année début</option>
                                @foreach ($years as $item)
                                    @if ($item->id == $budgeting->startYear->id)
                                        <option selected value="{{ $item->id }}">{{ $item->year }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="endYear" id="endYear" class="form-control">
                                <option disabled value="">Année fin</option>
                                @foreach ($years as $item)
                                    @if ($item->id == $budgeting->endYear->id)
                                        <option selected value="{{ $item->id }}">{{ $item->year }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="currency" id="currency" class="form-control">
                                <option disabled value="">Dévise</option>
                                @foreach ($currencies as $item)
                                    @if ($item->id == $budgeting->currency->id)
                                        <option selected value="{{ $item->id }}">{{ $item->currency }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->currency }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="status" id="status" class="form-control">
                                <option disabled value="">Status</option>
                                @foreach ($status as $item)
                                    @if ($item->id == $budgeting->status->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <p style="font-size: 10px; margin-bottom:-3px;margin-top:3px"><i>Help: Veuillez maintenir la
                                    touche CTRL
                                    (command) pour séléctionner
                                    plusieurs</i></p>
                            <select style="height: 200px" multiple="multiple" name="rubriques[]" id="rubriques"
                                class="form-control">
                                <option disabled value="">Categories utilisés</option>
                                @foreach ($rubriques as $item)
                                    @php
                                        $test = false;
                                    @endphp
                                    @if (count($budgeting->rubriques) > 0)
                                        @foreach ($budgeting->rubriques as $reb)
                                            @if ($item->id == $reb->id)
                                                @php
                                                    $test = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($test)
                                            <option class="text-primary" selected value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <button type="submit" style="margin-right: 7px" class="btn btn-primary">Modifier</button>
                            <a class="btn btn-info" href="{{ route('budgetings') }}">Retour</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5>Catégories attachées</h5>
                    <div style="height: 67vh;overflow:scroll">
                        <ul class="list-group">
                            @if (count($rubriquesOwn) > 0)
                                @foreach ($rubriquesOwn as $rub)
                                    <li style="font-size:11px" class="list-group-item">{{ $rub->code }}
                                        {{ $rub->name }}
                                    </li>
                                @endforeach
                            @else
                                <div class="alert alert-info">Pas de données</div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
