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
                <a href={{ route('rates.home') }} style="width:90px;padding:1px; margin-left:2px"
                    class="btn btn-secondary btn-sm"> Retour </a>
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <div class="col-md-5">
                        <h4 class="page-title">
                            DEVICES, {{ $currency->description }} ({{ $currency->currency }})
                        </h4>
                    </div>
                    <div class="col-md-7">
                        <button data-mdb-toggle="modal" data-mdb-target="#add" style="float: right" type="button"
                            class="btn btn-success"><i class="fas fa-plus"></i>
                            Nouveau</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    @if (count(
                        $currency->changes()->where('budgeting_id', '=', $budgeting->id)->get()) > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Device change</th>
                                    <th scope="col">Taux</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($currency->changes()->where('budgeting_id', '=', $budgeting->id)->get() as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ $item->currency }}</td>
                                        <td>{{ $item->pivot->rate }}</td>
                                        <td class="d-flex">
                                            <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                href="{{ route('currencies.show', ['id' => $item->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <form
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                action="{{ route('rates.delete', ['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="budgeting" value="{{ $budgeting->id }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button title="Supprimer" style="color: #fff"
                                                    class="btn btn-danger btn-sm "><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="text-center alert alert-info">
                            Pas de données
                        </div>
                    @endif
                </div>
                <div class="col-md-3" style="padding-top: 50px">
                    @if ($show)
                        <form method="POST" action="{{ route('currencies.update', ['id' => $currency->id]) }}">
                            <!-- Name input -->
                            @csrf
                            <div class="form-outline mb-4">
                                <input required="required" value="{{ $currency->description }}" name="description"
                                    type="text" id="description" class="form-control" />
                                <label class="form-label" for="currency">Description</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input required="required" value="{{ $currency->currency }}" name="currency" type="text"
                                    id="currency" class="form-control" />
                                <label class="form-label" for="currency">Libellé court</label>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="{{ route('currencies') }}">Fermer</a>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    @else
                        @if (count(
                            $currency->changes()->where('budgeting_id', '=', $budgeting->id)->get()) > 0)
                            <div class="alert alert-info">
                                Sélectionnez un élément sur le tableau pour visualiser
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Ajouter un élément</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('rates.store', ['currency' => $currency->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="mb-4">
                            <select required="required" name="currency" id="currency" class="form-control">
                                <option selected disabled value="">Choisir dévise</option>
                                @foreach ($currencies as $item)
                                    <option value="{{ $item->id }}">{{ $item->currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-outline mb-4">
                            <input required="required" name="rate" type="number" id="rate"
                                class="form-control" />
                            <label class="form-label" for="currency">Taux</label>
                        </div>
                        <input type="hidden" name="budgeting" value="{{ $budgeting->id }}">
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
