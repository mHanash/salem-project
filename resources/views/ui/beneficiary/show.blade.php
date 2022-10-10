@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <h4 class="text-primary page-title">
                        MODIFICATION AGENT {{ $beneficiary->name }} {{ $beneficiary->postname }}
                        {{ $beneficiary->lastname }}
                    </h4>
                </div>
            </div>
            <div class="row" style="padding-top: 70px;padding-left:10px">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('beneficiaries.update', ['id' => $beneficiary->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input value="{{ $beneficiary->name }}" required="required" name="name" type="text"
                                id="name" class="form-control" />
                            <label class="form-label" for="name">Nom</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input value="{{ $beneficiary->lastname }}" required="required" name="lastname" type="text"
                                id="lastname" class="form-control" />
                            <label class="form-label" for="lastname">Postnom</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input value="{{ $beneficiary->firstname }}" required="required" name="firstname" type="text"
                                id="firstname" class="form-control" />
                            <label class="form-label" for="firstname">Prenom</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="job" id="job" class="form-control">
                                <option disabled value="">Poste</option>
                                @foreach ($jobs as $item)
                                    @if ($item->id == $beneficiary->job->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="typeBeneficiary" id="typeBeneficiary" class="form-control">
                                <option disabled value="">Type Agent</option>
                                @foreach ($typeBeneficiaries as $item)
                                    @if ($item->id == $beneficiary->typeBeneficiary->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <button type="submit" style="margin-right: 7px" class="btn btn-primary">Modifier</button>
                            <a class="btn btn-info" href="{{ route('beneficiaries') }}">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
