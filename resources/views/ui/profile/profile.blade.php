@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-6">
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
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="padding-left:10px;margin-bottom: 10px">
                    <h4 class="text-primary page-title">
                        MON PROFILE
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <i class="far fa-user-circle fa-8x"></i>
                </div>
            </div>
            <div class="row" style="padding-top: 10px;padding-left:10px">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="text-primary">Nom : </span>{{ $user->beneficiary->name }}
                        </li>
                        <li class="list-group-item">
                            <span class="text-primary">Postnom : </span>{{ $user->beneficiary->lastname }}
                        </li>
                        <li class="list-group-item">
                            <span class="text-primary">Prénom : </span>{{ $user->beneficiary->firstname }}
                        </li>
                        <li class="list-group-item">
                            <span class="text-primary">Poste : </span>{{ $user->beneficiary->job->name }}
                        </li>
                        <li class="list-group-item">
                            <span class="text-primary">Email : </span>{{ $user->email }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row" style="padding-top: 10px;padding-left:10px">
                <h6>Modification mot de passe</h6>
                <div class="col-md-6">
                    <form method="POST" action="{{ route('users.update.profile.password', ['id' => $user->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <input type="hidden" name="email" id="email" value="{{ $user->email }}">
                        <div class="mb-2">
                            <input class="form-control" type="password" name="password" id="pwd"
                                placeholder="Mot de passe">
                        </div>
                        <div class="mb-2">
                            <input class="form-control" type="password" name="password_confirmation" id="pwd"
                                placeholder="Confirmé Mot de passe">
                        </div>
                        <a href="{{ route('home') }}" class="btn text-light btn-info btn-sm">Retour</a>
                        <button type="submit" href="{{ route('users.reset.password', ['id' => $user->id]) }}"
                            class="btn text-light btn-sm btn-primary">Changer mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
