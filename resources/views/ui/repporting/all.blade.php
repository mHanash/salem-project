@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class=" nav-item nav-link active text-primary" id="default" data-toggle="tab" href="#defaultContent"
                        role="tab" aria-controls="defaultContent" aria-selected="true">Acceuil</a>
                    <a class=" nav-item nav-link" id="nav-rubrique-tab" data-toggle="tab" href="#nav-rubrique"
                        role="tab" aria-controls="nav-rubrique" aria-selected="true">Etat financier par rubrique</a>
                    <a class=" nav-item nav-link" id="nav-journal-tab" data-toggle="tab" href="#nav-journal" role="tab"
                        aria-controls="nav-journal" aria-selected="false">Livre journal</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane pt-10 fade show active" id="defaultContent" role="tabpanel" aria-labelledby="default">
                    <h5>Dashboard</h5>
                    <div class="row" style="height: 70vh;overflow:scroll">
                        <div class="col table-responsive">
                            @if (count($line_budgetings) > 0)
                                <table id="_config" class="table table-sm table-bordered table-striped-columns">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Rubriques/Catégorie</th>
                                            <th scope="col">Montant prévu</th>
                                            <th scope="col">Montant engagé</th>
                                            <th scope="col">Ecart</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $totalPlanning = 0;
                                            $totalRealAmount = 0;
                                        @endphp
                                        @foreach ($line_budgetings as $item)
                                            @php
                                                $i++;
                                                $totalPlanning += $item->amount;
                                                $amountReal = 0;
                                            @endphp
                                            @foreach ($transactions as $transact)
                                                @if ($transact->rubrique->id == $item->rubrique->id)
                                                    @php
                                                        $amountReal += $transact->amount;
                                                    @endphp
                                                @endif
                                                @php
                                                    $totalRealAmount += $amountReal;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <td>{{ $item->rubrique->name }}</td>
                                                <td style="font-size: 10px" class="numberFormat">{{ $item->amount }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td style="font-size: 10px" class="numberFormat">{{ $amountReal }}
                                                    {{ $budgeting->currency->currency }}</td>
                                                <td style="font-size: 10px" class="numberFormat">
                                                    {{ $item->amount - $amountReal }} {{ $budgeting->currency->currency }}
                                                </td>
                                                <td>
                                                    @if ($item->amount > $amountReal)
                                                        <span class="badge text-bg-primary">GOOD</span>
                                                    @else
                                                        <span class="badge text-bg-danger">BAD</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a title="Afficher" style="color: #fff;margin-right: 5px"
                                                        href="{{ route('repportings.show', ['id' => $item['id']]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <th colspan="2">TOTAL</th>
                                        <th class="numberFormat text-danger">{{$totalPlanning}} {{$budgeting->currency->currency}}</th>
                                        <th class="numberFormat text-danger">{{$totalRealAmount}} {{$budgeting->currency->currency}}</th>
                                    </tfoot> --}}
                                </table>
                            @else
                                <div class="text-center alert alert-info">
                                    Pas de données
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-10 fade " id="nav-rubrique" role="tabpanel" aria-labelledby="nav-rubrique-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Etat financier</h5>
                        </div>
                        <div class="col-md-8">

                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-sm nav-link active" id="receive" data-bs-toggle="pill"
                                data-bs-target="#receive-content" type="button" role="tab"
                                aria-controls="receive-content" aria-selected="true">Entrées</button>
                            <button class="nav-sm nav-link" id="send" data-bs-toggle="pill"
                                data-bs-target="#send-content" type="button" role="tab" aria-controls="send-content"
                                aria-selected="false">Sorties</button>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="receive-content" role="tabpanel"
                                aria-labelledby="receive">
                                <div class="row" style="height: 70vh;overflow:scroll">
                                    <div class="col table-responsive">
                                        @if (count($line_budgetings) > 0)
                                            <table id="_config"
                                                class="table table-sm table-bordered table-striped-columns">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Rubriques/Catégorie</th>
                                                        <th scope="col">Montant prévu</th>
                                                        <th scope="col">Montant engagé</th>
                                                        <th scope="col">Ecart</th>
                                                        <th scope="col">Etat</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                        $totalRealAmountRec = 0;
                                                        $totalPlanningRec = 0;
                                                    @endphp
                                                    @foreach ($line_budgetings as $item)
                                                        @if ($item->rubrique->typeRubrique->state == 1)
                                                            @php
                                                                $i++;
                                                                $totalPlanningRec += $item->amount;
                                                                $amountRealRec = 0;
                                                            @endphp
                                                            @foreach ($transactions as $transact)
                                                                @if ($transact->rubrique->id == $item->rubrique->id)
                                                                    @php
                                                                        $amountRealRec += $transact->amount;
                                                                        $totalRealAmountRec += $amountRealRec;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            <tr>
                                                                <th>{{ $i }}</th>
                                                                <td>{{ $item->rubrique->name }}</td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $item->amount }}
                                                                    {{ $budgeting->currency->currency }}
                                                                </td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $amountRealRec }}
                                                                    {{ $budgeting->currency->currency }}
                                                                </td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $item->amount - $amountRealRec }}
                                                                    {{ $budgeting->currency->currency }}</td>
                                                                <td>
                                                                    @if ($item->amount > $amountRealRec)
                                                                        <span class="badge text-bg-primary">GOOD</span>
                                                                    @else
                                                                        <span class="badge text-bg-danger">BAD</span>
                                                                    @endif
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a title="Afficher"
                                                                        style="color: #fff;margin-right: 5px"
                                                                        href="{{ route('repportings.show', ['id' => $item['id']]) }}"
                                                                        class="btn btn-info btn-sm"><i
                                                                            class="fas fa-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <th colspan="2">TOTAL</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ $totalPlanningRec }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ $totalRealAmountRec }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ ($totalPlanningRec - $totalRealAmountRec) * -1 }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th>
                                                        @if ($totalPlanningRec > $totalRealAmountRec)
                                                            <span class="badge text-bg-primary">GOOD</span>
                                                        @else
                                                            <span class="badge text-bg-danger">BAD</span>
                                                        @endif
                                                    </th>
                                                </tfoot> --}}
                                            </table>
                                        @else
                                            <div class="text-center alert alert-info">
                                                Pas de données
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="send-content" role="tabpanel" aria-labelledby="send">
                                <div class="row" style="height: 70vh;overflow:scroll">
                                    <div class="col table-responsive">
                                        @if (count($line_budgetings) > 0)
                                            <table id="_config"
                                                class="table table-sm table-bordered table-striped-columns">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Rubriques/Catégorie</th>
                                                        <th scope="col">Montant prévu</th>
                                                        <th scope="col">Montant engagé</th>
                                                        <th scope="col">Ecart</th>
                                                        <th scope="col">Etat</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                        $totalRealAmountSend = 0;
                                                        $totalPlanningSend = 0;
                                                    @endphp
                                                    @foreach ($line_budgetings as $item)
                                                        @if ($item->rubrique->typeRubrique->state != 1)
                                                            @php
                                                                $i++;
                                                                $totalPlanningSend += $item->amount;
                                                                $amountRealSend = 0;
                                                            @endphp
                                                            @foreach ($transactions as $transact)
                                                                @if ($transact->rubrique->id == $item->rubrique->id)
                                                                    @php
                                                                        $amountRealSend += $transact->amount;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $totalRealAmountSend += $amountRealSend;
                                                                @endphp
                                                            @endforeach
                                                            <tr>
                                                                <th>{{ $i }}</th>
                                                                <td>{{ $item->rubrique->name }}</td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $item->amount }}
                                                                    {{ $budgeting->currency->currency }}</td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $amountRealSend }}
                                                                    {{ $budgeting->currency->currency }}</td>
                                                                <td style="font-size: 10px" class="numberFormat">
                                                                    {{ $item->amount - $amountRealSend }}
                                                                    {{ $budgeting->currency->currency }}</td>
                                                                <td>
                                                                    @if ($item->amount > $amountRealSend)
                                                                        <span class="badge text-bg-primary">GOOD</span>
                                                                    @else
                                                                        <span class="badge text-bg-danger">BAD</span>
                                                                    @endif
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a title="Afficher"
                                                                        style="color: #fff;margin-right: 5px"
                                                                        href="{{ route('repportings.show', ['id' => $item['id']]) }}"
                                                                        class="btn btn-info btn-sm"><i
                                                                            class="fas fa-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <th colspan="2">TOTAL</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ $totalPlanningSend }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ $totalRealAmountSend }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th style="font-size: 10px" class="numberFormat text-danger">
                                                        {{ ($totalPlanningSend - $totalRealAmountSend) * -1 }}
                                                        {{ $budgeting->currency->currency }}</th>
                                                    <th>
                                                        @if ($totalPlanningSend > $totalRealAmountSend)
                                                            <span class="badge text-bg-primary">GOOD</span>
                                                        @else
                                                            <span class="badge text-bg-danger">BAD</span>
                                                        @endif
                                                    </th>
                                                </tfoot> --}}
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
                    </div>
                </div>
                <div class="tab-pane pt-10 fade " id="nav-journal" role="tabpanel" aria-labelledby="nav-journal-tab">
                    <h5>Livre journal</h5>
                </div>
            </div>
        </div>
    </main>
@endsection
