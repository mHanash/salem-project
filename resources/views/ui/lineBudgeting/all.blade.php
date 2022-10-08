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
                            Prévision budgétaire : {{ $budgeting->startYear->year }} -
                            {{ $budgeting->endYear->year }}
                        </h5>
                    </div>
                </div>
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <div class="col-md-6">
                        <button data-mdb-toggle="modal" data-mdb-target="#addReceive" style="float: right" type="button"
                            class=" btn-sm btn btn-primary"><i class="fas fa-plus"></i>
                            Entrées</button>
                    </div>
                    <div class="col-md-6">
                        <button data-mdb-toggle="modal" data-mdb-target="#addSend" style="float: right" type="button"
                            class="btn btn-sm btn-danger"><i class="fas fa-plus"></i>
                            Sorties</button>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 border-end">
                    <h6 class="border-bottom border-top">Entrées</h6>
                    <div class="col table-responsive" style="height:70vh;overflow:scroll">
                        @if (count($lineBudgetings) > 0 && $budgeting)
                            <table id="_config" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Compte</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($lineBudgetings as $item)
                                        @if ($item->rubrique && $item->rubrique->typeRubrique->state == 1)
                                            <tr>
                                                @php
                                                    $total += $item->amount;
                                                @endphp
                                                <td style="font-size:10px">{{ $item->rubrique->code }}</td>
                                                <td style="font-size:10px">{{ $item->rubrique->name }}</td>
                                                <td style="font-size:10px" class="numberFormat">{{ $item->amount }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td class="d-flex">
                                                    <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                        href="{{ route('plannings.show', ['id' => $item->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    <form
                                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                        action="{{ route('plannings.destroy', ['id' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button title="Supprimer" style="color: #fff"
                                                            class="btn btn-danger btn-sm "><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th colspan="2" scope="col">
                                            <span class="numberFormat">{{ $total }}</span> {{ $budgeting->currency->currency }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="text-center alert alert-info">
                                Pas de données
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="border-bottom border-top">Sorties</h6>
                    <div class="col table-responsive" style="height:70vh;overflow:scroll">
                        @if (count($lineBudgetings) > 0 && $budgeting)
                            <table id="_config" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Compte</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($lineBudgetings as $item)
                                        @if ($item->rubrique && $item->rubrique->typeRubrique->state != 1)
                                            <tr>
                                                @php
                                                    $total += $item->amount;
                                                @endphp
                                                <td style="font-size:10px">{{ $item->rubrique->code }}</td>
                                                <td style="font-size:10px">{{ $item->rubrique->name }}</td>
                                                <td style="font-size:10px" class="numberFormat">{{ $item->amount }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td class="d-flex">
                                                    <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                        href="{{ route('plannings.show', ['id' => $item->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    <form
                                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                        action="{{ route('plannings.destroy', ['id' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button title="Supprimer" style="color: #fff"
                                                            class="btn btn-danger btn-sm "><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th colspan="2" scope="col">
                                                <span class="numberFormat">{{ $total }}</span> {{ $budgeting->currency->currency }}</th>
                                        </tr>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="text-center alert alert-info">
                                Pas de données
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="addReceive" tabindex="-1" aria-labelledby="addModalLabelRec" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabelRec">Ajouter un élément</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('plannings.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control"></textarea>
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" name="amount" type="number" id="amount"
                                    class="form-control" />
                                <label class="form-label" for="amount">Montant</label>
                            </div>
                            <div class="text-danger"> - {{ $budgeting->currency->currency }}</div>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="rubrique" id="rubrique" class="form-control">
                                <option value="">Compte</option>
                                @foreach ($rubriques as $item)
                                    @if ($item->typeRubrique->state == 1)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value="{{ $budgeting->id }}" name="budgeting">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSend" tabindex="-1" aria-labelledby="addModalLabelDep" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabelDep">Ajouter un élément</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('plannings.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control"></textarea>
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" name="amount" type="number" id="amount"
                                    class="form-control" />
                                <label class="form-label" for="amount">Montant</label>
                            </div>
                            <div class="text-danger"> - {{ $budgeting->currency->currency }}</div>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="rubrique" id="rubrique" class="form-control">
                                <option value="">Compte</option>
                                @foreach ($rubriques as $item)
                                    @if ($item->typeRubrique->state != 1)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value="{{ $budgeting->id }}" name="budgeting">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
