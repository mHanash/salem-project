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
                            ARCHIVE BUDGETS
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
                    @if (count($budgetings) > 0)
                        <table class="table table-sm responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Desciption</th>
                                    <th scope="col">Année Début</th>
                                    <th scope="col">Année Fin</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dévise</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($budgetings as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->startYear->year }}</td>
                                        <td>{{ $item->endYear->year }}</td>
                                        <td>{{ $item->status->name }}</td>
                                        <td>{{ $item->currency->currency }}</td>
                                        <td class="d-flex">
                                            <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                href="{{ route('budgetings.show', ['id' => $item->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <form
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                action="{{ route('budgetings.destroy', ['id' => $item->id]) }}"
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
                    <form method="POST" action="{{ route('budgetings.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input required="required" name="description" type="text" id="description"
                                class="form-control" />
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="startYear" id="startYear" class="form-control">
                                <option value="">Année début</option>
                                @foreach ($years as $item)
                                    <option value="{{ $item->id }}">{{ $item->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="endYear" id="endYear" class="form-control">
                                <option value="">Année fin</option>
                                @foreach ($years as $item)
                                    <option value="{{ $item->id }}">{{ $item->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="currency" id="currency" class="form-control">
                                <option value="">Dévise</option>
                                @foreach ($currencies as $item)
                                    <option value="{{ $item->id }}">{{ $item->currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="status" id="status" class="form-control">
                                <option value="">Status</option>
                                @foreach ($status as $item)
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
