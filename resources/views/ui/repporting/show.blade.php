@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 5px">
                    <div class="col">
                        <h5 class="page-title text-primary">
                            Détails du compte, Budget : {{ $budgeting->description }} : {{ $budgeting->startYear->year }} -
                            {{ $budgeting->endYear->year }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item">Rubrique : {{ $line_budgeting->rubrique->name }}</li>
                        <li class="list-group-item">Montant planifié : <span
                                class="numberFormat">{{ $line_budgeting->amount }}
                                {{ $budgeting->currency->currency }}</span></li>
                        <li class="list-group-item">Description : {{ $line_budgeting->description }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('repportings', ['id' => $budgeting->id]) }}" class="btn btn-info">Retour</a>
                </div>
            </div>
            <div class="row">
                <h5 class="pt-5">Les transactions du compte</h5>
                <div class="row" style="height: 50vh;overflow:scroll">
                    <div class="col table-responsive">
                        @if (count($transactions) > 0)
                            <table id="_config" class="table table-sm table-bordered table-striped-columns">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Attributaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($transactions as $item)
                                        @php
                                            $i++;
                                        @endphp
                                        @if ($line_budgeting->rubrique->id == $item->rubrique->id)
                                            @php
                                                $total += $item->amount;
                                            @endphp
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td style="font-size: 10px"><span
                                                        class="numberFormat">{{ $item->amount }}</span>
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td>{{ $item->beneficiary->name }} {{ $item->beneficiary->lastname }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="3">TOTAL</th>
                                    <th colspan="2" class="text-danger">
                                        <span class="numberFormat">{{ $total }}</span>
                                        {{ $budgeting->currency->currency }}
                                    </th>
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
@endsection
