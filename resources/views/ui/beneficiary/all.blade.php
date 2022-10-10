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
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <div class="col-md-5">
                        <h4 class="page-title">
                            AGENT DE FINANCEMENT
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
                <div class="col">
                    @if (count($beneficiaries) > 0)
                        <table class="table table-sm responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Postnom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Poste</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($beneficiaries as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->lastname }}</td>
                                        <td>{{ $item->firstname }}</td>
                                        <td>{{ $item->job->name }}</td>
                                        <td>{{ $item->typeBeneficiary->name }}</td>
                                        <td class="d-flex">
                                            <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                href="{{ route('beneficiaries.show', ['id' => $item->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <form
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                action="{{ route('beneficiaries.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
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
                    <form method="POST" action="{{ route('beneficiaries.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input required="required" name="name" type="text" id="name" class="form-control" />
                            <label class="form-label" for="name">Nom</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required="required" name="lastname" type="text" id="lastname" class="form-control" />
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
