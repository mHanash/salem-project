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
                            ROLES UTILISATEURS
                        </h4>
                    </div>
                    <div class="col-md-7">
                        @if (count($roleData) > count($roles))
                            <button data-mdb-toggle="modal" data-mdb-target="#add" style="float: right" type="button"
                                class="btn btn-success"><i class="fas fa-plus"></i>
                                Nouveau</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    @if (count($roles) > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Intitulé</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($roles as $item)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th>{{ $i }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td class="d-flex">
                                            <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                href="{{ route('roles.show', ['id' => $item->id]) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <form
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet enregistrement ?')"
                                                action="{{ route('roles.destroy', ['id' => $item->id]) }}" method="POST">
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
                <div class="col-md-3" style="padding-top: 50px">
                    @if ($show)
                        <form method="POST" action="{{ route('roles.update', ['id' => $role->id]) }}">
                            <!-- Name input -->
                            @csrf
                            <div class="mb-4">
                                <select required="required" name="name" id="name" class="form-control">
                                    <option disabled selected value="">Faire un choix</option>
                                    @foreach ($roleData as $item)
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach ($roles as $val)
                                            @if ($item == $val->name)
                                                @php
                                                    $exist = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if (!$exist)
                                            @if ($item == $role->name)
                                                <option selected value="{{ $item }}">{{ $item }}</option>
                                            @else
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="{{ route('roles') }}">Fermer</a>
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    @else
                        @if (count($roles) > 0)
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
                    <form method="POST" action="{{ route('roles.store') }}">
                        <!-- Name input -->
                        @csrf
                        <div class="mb-4">
                            <select required="required" name="name" id="name" class="form-control">
                                <option disabled selected value="">Faire un choix</option>
                                @foreach ($roleData as $item)
                                    @php
                                        $exist = false;
                                    @endphp
                                    @foreach ($roles as $val)
                                        @if ($item == $val->name)
                                            @php
                                                $exist = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if (!$exist)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
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
