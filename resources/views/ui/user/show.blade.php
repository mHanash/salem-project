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
                    <h4 class="text-primary page-title">
                        MODIFICATION COMPTE {{ $user->beneficiary->name }} {{ $user->beneficiary->lastname }}
                        {{ $user->beneficiary->firstname }}
                    </h4>
                </div>
            </div>
            <div class="row" style="padding-top: 70px;padding-left:10px">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input required="required" value="{{ $user->email }}" name="email" type="email"
                                id="email" class="form-control" />
                            <label class="form-label" for="email">email</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="beneficiary" id="beneficiary" class="form-control">
                                <option disabled selected value="">Agent</option>
                                @foreach ($beneficiaries as $beneficiary)
                                    @if ($user->beneficiary->id == $beneficiary->id)
                                        <option selected value="{{ $beneficiary->id }}">{{ $beneficiary->name }}
                                            {{ $beneficiary->lastname }} {{ $beneficiary->firstname }}</option>
                                    @else
                                        <option value="{{ $beneficiary->id }}">{{ $beneficiary->name }}
                                            {{ $beneficiary->lastname }} {{ $beneficiary->firstname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <p style="font-size: 10px; margin-bottom:-2px;margin-top:2px"><i>Help: Veuillez maintenir la
                                    touche CTRL
                                    (command) pour
                                    séléctionner plusieurs</i></p>
                            <select style="height: 150px" multiple required="required" name="roles[]" id="roles"
                                class="form-control">
                                <option disabled value="">Roles</option>
                                @foreach ($roles as $item)
                                    @php
                                        $test = false;
                                    @endphp
                                    @if (count($user->roles) > 0)
                                        @foreach ($user->roles as $role)
                                            @if ($item->id == $role->id)
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
                        <div class="mb-4">
                            <select required="required" name="status" id="status" class="form-control">
                                <option selected disabled value="">Status</option>
                                @foreach ($statuses as $status)
                                    @if ($user->status->id == $status->id)
                                        <option selected value="{{ $status->id }}">{{ $status->name }}</option>
                                    @else
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('users') }}" class="btn btn-sm btn-danger" data-mdb-dismiss="modal">Retour</a>
                        <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                        <a href="{{ route('users.reset.password', ['id' => $user->id]) }}"
                            class="btn text-light btn-sm btn-info">Réinitialiser Mot de passe</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
