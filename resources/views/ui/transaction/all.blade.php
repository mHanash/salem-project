@extends('layouts.main')

@section('content')
    @php
        $admin = false;
        $finan = false;
    @endphp
    @foreach (Auth::user()->roles as $role)
        @if ($role->name == 'ADMIN')
            @php
                $admin = true;
            @endphp
        @endif
        @if ($role->name == 'FINANCIAL')
            @php
                $finan = true;
            @endphp
        @endif
    @endforeach
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
                <form action="{{ route('transactions', ['id' => $budgeting->id]) }}" method="get">
                    <div class="row align-items-center" style="margin-bottom: 5px">
                        <div class="col-md-6 pt-1">
                            <a style="width:63px;font-size:11px;font-weight:bold"
                                class="btn text-center text-light text-bg-secondary d-flex nav-link"
                                href="{{ route('transactions.home') }}">
                                < Retour</a>
                                    <h5 class="page-title text-primary">
                                        Journal des transactions, Budget : {{ $budgeting->startYear->year }} -
                                        {{ $budgeting->endYear->year }}
                                    </h5>
                        </div>
                        <div class="col-md-4 pt-1 pb-1">
                            <div class="input-group input-daterange">
                                <input value="{{ $from }}" name='from' type="date" class="form-control">
                                <input value="{{ $to }}" name='to' type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 pt-1 pb-1">
                            <button type="submit" href="" style="color: #fff" class="btn btn-sm btn-info"><i
                                    class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <div class="col-md-6">
                        <button data-mdb-toggle="modal" data-mdb-target="#addRec" style="float: right" type="button"
                            class=" btn-sm btn btn-primary"><i class="fas fa-plus"></i>
                            Ajouter recette</button>
                    </div>
                    <div class="col-md-6">
                        <button data-mdb-toggle="modal" data-mdb-target="#addDep" style="float: right" type="button"
                            class="btn btn-sm btn-danger"><i class="fas fa-plus"></i>
                            Ajouter dépense</button>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 border-end">
                    <h6 class="border-bottom border-top">Crédit</h6>
                    <div class="col table-responsive" style="height:70vh;overflow:scroll">
                        @if (count($transactions) > 0 && $budgeting)
                            <table id="_config" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Libéllé</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($transactions as $item)
                                        @if ($item->rubrique && $item->rubrique->typeRubrique->state == 1)
                                            <tr>
                                                @php
                                                    $total += $item->amount;
                                                @endphp
                                                <td style="font-size:10px">{{ $item->date }}</td>
                                                <td style="font-size:10px">{{ $item->rubrique->code }}</td>
                                                <td style="font-size:10px">{{ $item->description }}</td>
                                                <td style="font-size:10px" class="numberFormat">{{ $item->amount }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td class="d-flex">
                                                    <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                        href="{{ route('transactions.show', ['id' => $item->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    @if ($admin)
                                                        <form
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                            action="{{ route('transactions.destroy', ['id' => $item->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button title="Supprimer" style="color: #fff"
                                                                class="btn btn-danger btn-sm "><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th colspan="2" scope="col"><span
                                                class="numberFormat">{{ $total }}</span>{{ $budgeting->currency->currency }}
                                        </th>
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
                    <h6 class="border-bottom border-top">Débit</h6>
                    <div class="col table-responsive" style="height:70vh;overflow:scroll">
                        @if (count($transactions) > 0 && $budgeting)
                            <table id="_config" class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Libéllé</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($transactions as $item)
                                        @if ($item->rubrique && $item->rubrique->typeRubrique->state != 1)
                                            <tr>
                                                @php
                                                    $total += $item->amount;
                                                @endphp
                                                <td style="font-size:10px">{{ $item->date }}</td>
                                                <td style="font-size:10px">{{ $item->rubrique->code }}</td>
                                                <td style="font-size:10px">{{ $item->description }}</td>
                                                <td style="font-size:10px" class="numberFormat">{{ $item->amount }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td class="d-flex">
                                                    <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                        href="{{ route('transactions.show', ['id' => $item->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    @if ($admin)
                                                        <form
                                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                            action="{{ route('transactions.destroy', ['id' => $item->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button title="Supprimer" style="color: #fff"
                                                                class="btn btn-danger btn-sm "><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th colspan="2" scope="col"><span
                                                class="numberFormat">{{ $total }}</span>
                                            {{ $budgeting->currency->currency }}</th>
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
    <div class="modal fade" id="addRec" tabindex="-1" aria-labelledby="addModalLabelRec" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabelRec">Ajouter un élément</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" value="{{ session()->get('dateCurrent') }}" name="date"
                                    type="date" id="date" class="form-control" />
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control"></textarea>
                            <label class="form-label" for="description">Libellé</label>
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
                        <div class="mb-4">
                            <select required="required" name="beneficiary" id="beneficiary" class="form-control">
                                <option value="">Attributaire</option>
                                @foreach ($beneficiaries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastname }}
                                        {{ $item->firstname }}
                                    </option>
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
    <div class="modal fade" id="addDep" tabindex="-1" aria-labelledby="addModalLabelDep" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabelDep">Ajouter un élément</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="d-flex mb-4">
                            <div class="form-outline mr-4">
                                <input required="required" value="{{ session()->get('dateCurrent') }}" name="date"
                                    type="date" id="date" class="form-control" />
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea rows="3" required="required" name="description" id="description" class="form-control"></textarea>
                            <label class="form-label" for="description">Libellé</label>
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
                        <div class="mb-4">
                            <select required="required" name="beneficiary" id="beneficiary" class="form-control">
                                <option value="">Attributaire</option>
                                @foreach ($beneficiaries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastname }}
                                        {{ $item->firstname }}
                                    </option>
                                @endforeach
                            </select>
                            <button data-mdb-toggle="modal" data-mdb-target="#addBeneficiary" style="margin-top:5px"
                                type="button" class=" btn-sm btn btn-secondary"><i class="fas fa-plus"></i>
                                Ajouter agent</button>
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
    <div class="modal fade" id="addBeneficiary" tabindex="-1" aria-labelledby="addModalBeneficiary"
        aria-hidden="true">
        <div style="width: 30%" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalBeneficiary">Ajouter un agent</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('beneficiaries.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input required="required" name="name" type="text" id="name"
                                class="form-control" />
                            <label class="form-label" for="name">Nom</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required="required" name="lastname" type="text" id="lastname"
                                class="form-control" />
                            <label class="form-label" for="lastname">Postnom</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required="required" name="firstname" type="text" id="firstname"
                                class="form-control" />
                            <label class="form-label" for="firstname">Prenom</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="job" id="job" class="form-control">
                                <option value="">Poste</option>
                                @foreach ($jobs as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="typeBeneficiary" id="typeBeneficiary"
                                class="form-control">
                                <option value="">Type Agent</option>
                                @foreach ($typeBeneficiaries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
