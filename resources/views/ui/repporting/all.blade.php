@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <a style="width:63px;font-size:11px;font-weight:bold;margin-bottom:10px;margin-top:-10px"
                class=" btn text-center text-light text-bg-secondary d-flex nav-link" href="{{ route('repportings.home') }}">
                < Retour</a>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class=" nav-item nav-link active text-primary" id="default" data-toggle="tab"
                                href="#defaultContent" role="tab" aria-controls="defaultContent"
                                aria-selected="true">Acceuil</a>
                            <a class=" nav-item nav-link" id="nav-rubrique-tab" data-toggle="tab" href="#nav-rubrique"
                                role="tab" aria-controls="nav-rubrique" aria-selected="true">Etat financier par
                                rubrique</a>
                            <a class=" nav-item nav-link" id="nav-rubrique-not-tab" data-toggle="tab"
                                href="#nav-rubrique-not" role="tab" aria-controls="nav-rubrique-not"
                                aria-selected="true">Etat financier par
                                rubrique non prévu</a>
                            <a class=" nav-item nav-link" id="nav-journal-tab" data-toggle="tab" href="#nav-journal"
                                role="tab" aria-controls="nav-journal" aria-selected="false">Livre journal</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane pt-10 fade show active" id="defaultContent" role="tabpanel"
                            aria-labelledby="default">
                            <form action="{{ route('repportings', ['id' => $budgeting->id]) }}" method="get">
                                <div class="row">
                                    <div class="col-md-6 pt-1">
                                        <h6>Tous les comptes</h6>
                                    </div>
                                    <div class="col-md-4 pt-1 pb-1">
                                        <div class="input-group input-daterange">
                                            <input value="{{ $from }}" name='from' type="date"
                                                class="form-control">
                                            <input value="{{ $to }}" name='to' type="date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pt-1 pb-1">
                                        <button type="submit" href="" style="color: #fff"
                                            class="btn btn-sm btn-info"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row" style="height: 70vh;overflow:scroll">
                                <div style="width:72vw" class="col ">
                                    @if (count($line_budgetings) > 0)
                                        <table id="_config"
                                            class="table table-responsive table-sm table-bordered table-striped-columns">
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
                                                        <td style="font-size: 10px;text-align:right">
                                                            <span class="numberFormat">{{ $item->amount * 1 }}</span>
                                                            {{ $budgeting->currency->currency }}
                                                        </td>
                                                        <td style="font-size: 10px;text-align:right">
                                                            <span class="numberFormat">{{ $amountReal }}</span>
                                                            {{ $budgeting->currency->currency }}
                                                        </td>
                                                        <td style="font-size: 10px;text-align:right">
                                                            <span
                                                                class="numberFormat">{{ $item->amount - $amountReal }}</span>
                                                            {{ $budgeting->currency->currency }}
                                                        </td>
                                                        <td style="text-align:center">
                                                            @if ($item->amount > $amountReal)
                                                                <span class="badge text-bg-primary">GOOD</span>
                                                            @else
                                                                <span class="badge text-bg-danger">BAD</span>
                                                            @endif
                                                        </td>
                                                        <td style="text-align:center" class="d-flex">
                                                            <a title="Afficher" style="color: #fff"
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
                        <div class="tab-pane p-10 fade " id="nav-rubrique" role="tabpanel"
                            aria-labelledby="nav-rubrique-tab">
                            <div class="row">
                                <form action="{{ route('repportings', ['id' => $budgeting->id]) }}" method="get">
                                    <div class="row">
                                        <div class="col-md-6 pt-1">
                                            <h6>Etat financier</h6>
                                        </div>
                                        <div class="col-md-4 pt-1 pb-1">
                                            <div class="input-group input-daterange">
                                                <input value="{{ $from }}" name='from' type="date"
                                                    class="form-control">
                                                <input value="{{ $to }}" name='to' type="date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 pt-1 pb-1">
                                            <button type="submit" href="" style="color: #fff"
                                                class="btn btn-sm btn-info"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills" id="pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-sm nav-link active" id="receive" data-bs-toggle="pill"
                                        data-bs-target="#receive-content" type="button" role="tab"
                                        aria-controls="receive-content" aria-selected="true">Entrées</button>
                                    <button class="nav-sm nav-link" id="send" data-bs-toggle="pill"
                                        data-bs-target="#send-content" type="button" role="tab"
                                        aria-controls="send-content" aria-selected="true">Sorties</button>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="receive-content" role="tabpanel"
                                        aria-labelledby="receive">
                                        <div class="row" style="height: 70vh;overflow:scroll">
                                            <div style="width:72vw" class="col">
                                                @if (count($line_budgetings) > 0)
                                                    <table id="_config"
                                                        class="table table-responsive table-sm table-bordered table-striped-columns">
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
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $item->amount * 1 }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $amountRealRec }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $item->amount - $amountRealRec }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="text-align: center">
                                                                            @if ($item->amount > $amountRealRec)
                                                                                <span
                                                                                    class="badge text-bg-primary">GOOD</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge text-bg-danger">BAD</span>
                                                                            @endif
                                                                        </td>
                                                                        <td style="text-align: center" class="d-flex">
                                                                            <a title="Afficher" style="color: #fff"
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
                                            <div style="width:72vw" class="col">
                                                @if (count($line_budgetings) > 0)
                                                    <table id="_config"
                                                        class="table table-responsive table-sm table-bordered table-striped-columns">
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
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $item->amount * 1 }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $amountRealSend }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="font-size: 10px;text-align:right">
                                                                            <span
                                                                                class="numberFormat">{{ $item->amount - $amountRealSend }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="text-align: center">
                                                                            @if ($item->amount > $amountRealSend)
                                                                                <span
                                                                                    class="badge text-bg-primary">GOOD</span>
                                                                            @else
                                                                                <span
                                                                                    class="badge text-bg-danger">BAD</span>
                                                                            @endif
                                                                        </td>
                                                                        <td class="d-flex">
                                                                            <a title="Afficher" style="color: #fff"
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
                        <div class="tab-pane p-10 fade " id="nav-rubrique-not" role="tabpanel"
                            aria-labelledby="nav-rubrique-not-tab">
                            <div class="row">
                                <form action="{{ route('repportings', ['id' => $budgeting->id]) }}" method="get">
                                    <div class="row">
                                        <div class="col-md-6 pt-1">
                                            <h6>Etat financier</h6>
                                        </div>
                                        <div class="col-md-4 pt-1 pb-1">
                                            <div class="input-group input-daterange">
                                                <input value="{{ $from }}" name='from' type="date"
                                                    class="form-control">
                                                <input value="{{ $to }}" name='to' type="date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 pt-1 pb-1">
                                            <button type="submit" href="" style="color: #fff"
                                                class="btn btn-sm btn-info"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills" id="pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-sm nav-link active" id="receiveNot" data-bs-toggle="pill"
                                        data-bs-target="#receiveNot-content" type="button" role="tab"
                                        aria-controls="receiveNot-content" aria-selected="true">Entrées</button>
                                    <button class="nav-sm nav-link" id="sendNot" data-bs-toggle="pill"
                                        data-bs-target="#sendNot-content" type="button" role="tab"
                                        aria-controls="sendNot-content" aria-selected="true">Sorties</button>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="receiveNot-content" role="tabpanel"
                                        aria-labelledby="receiveNot">
                                        <div class="row" style="height: 70vh;overflow:scroll">
                                            <div style="width:72vw" class="col">
                                                @if (count($line_budgetings) > 0)
                                                    <table id="_config"
                                                        class="table table-responsive table-sm table-bordered table-striped-columns">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Rubriques/Catégorie</th>
                                                                <th scope="col">Montant engagé</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 0;
                                                                $totalRealAmountRec = 0;
                                                                $totalPlanningRec = 0;
                                                            @endphp
                                                            @foreach ($budgeting->rubriques as $item)
                                                                @php
                                                                    $exist = false;
                                                                    $line = null;
                                                                @endphp
                                                                @foreach ($line_budgetings as $line)
                                                                    @if ($item->id == $line->rubrique->id)
                                                                        @php
                                                                            $exist = true;
                                                                            $line = $line->rubrique;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                                @if ($item->typeRubrique->state == 1 && !$exist)
                                                                    @php
                                                                        $i++;
                                                                        $amountRealRec = 0;
                                                                    @endphp
                                                                    @foreach ($transactions as $transact)
                                                                        @if ($transact->rubrique->id == $item->id)
                                                                            @php
                                                                                $amountRealRec += $transact->amount;
                                                                                $totalRealAmountRec += $amountRealRec;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    <tr>
                                                                        <th>{{ $i }}</th>
                                                                        <td>{{ $item->name }}</td>
                                                                        <td style="font-size: 10px;text-align:right"><span
                                                                                class="numberFormat">{{ $amountRealRec }}</span>
                                                                            {{ $budgeting->currency->currency }}
                                                                        </td>
                                                                        <td style="text-align: center" class="d-flex">
                                                                            <a title="Afficher" style="color: #fff"
                                                                                href="{{ route('repportings.show', ['id' => $line->id]) }}"
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
                                    <div class="tab-pane fade" id="sendNot-content" role="tabpanel"
                                        aria-labelledby="sendNot">
                                        <div class="row" style="height: 70vh;overflow:scroll">
                                            <div style="width:72vw" class="col">
                                                @if (count($line_budgetings) > 0)
                                                    <table id="_config"
                                                        class="table table-responsive table-sm table-bordered table-striped-columns">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Rubriques/Catégorie</th>
                                                                <th scope="col">Montant engagé</th>
                                                                <th scope="col">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 0;
                                                                $totalRealAmountSend = 0;
                                                                $totalPlanningSend = 0;
                                                            @endphp
                                                            @foreach ($budgeting->rubriques as $item)
                                                                @php
                                                                    $existSend = false;
                                                                    $line = null;
                                                                @endphp
                                                                @foreach ($line_budgetings as $line)
                                                                    @if ($item->id == $line->rubrique->id)
                                                                        @php
                                                                            $existSend = true;
                                                                            $line = $line;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                                @if ($item->typeRubrique->state != 1 && !$existSend)
                                                                    @php
                                                                        $i++;
                                                                        $amountRealSend = 0;
                                                                    @endphp
                                                                    @foreach ($transactions as $transact)
                                                                        @if ($transact->rubrique->id == $item->id)
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
                                                                        <td>{{ $item->name }}</td>
                                                                        <td style="font-size: 10px;text-align:right"><span
                                                                                class="numberFormat">{{ $amountRealSend }}</span>
                                                                            {{ $budgeting->currency->currency }}</td>
                                                                        <td class="d-flex">
                                                                            <a title="Afficher" style="color: #fff"
                                                                                href="{{ route('repportings.show', ['id' => $line->id]) }}"
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
                        <div class="tab-pane pt-10 fade " id="nav-journal" role="tabpanel"
                            aria-labelledby="nav-journal-tab">
                            <form action="{{ route('repportings', ['id' => $budgeting->id]) }}" method="get">
                                <div class="row">
                                    <div class="col-md-6 pt-1">
                                        <h6>Livre Journal</h6>
                                    </div>
                                    <div class="col-md-4 pt-1 pb-1">
                                        <div class="input-group input-daterange">
                                            <input value="{{ $from }}" name='from' type="date"
                                                class="form-control">
                                            <input value="{{ $to }}" name='to' type="date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pt-1 pb-1">
                                        <button type="submit" href="" style="color: #fff"
                                            class="btn btn-sm btn-info"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6 border-end">
                                    <h6 class="border-bottom border-top">Débit</h6>
                                    <div class="col table-responsive" style="height:70vh;overflow:scroll">
                                        @if (count($transactions) > 0 && $budgeting)
                                            <table id="data" class="table table-sm table-striped">
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
                                                                <td style="font-size:10px">{{ $item->rubrique->code }}
                                                                </td>
                                                                <td style="font-size:10px">{{ $item->description }}</td>
                                                                <td style="font-size:10px">
                                                                    <span
                                                                        class="numberFormat">{{ $item->amount * 1 }}</span>
                                                                    {{ $budgeting->currency->currency }}
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a title="Afficher"
                                                                        style="color: #fff;margin-right: 5px"
                                                                        href="{{ route('repportings.transaction.show', ['id' => $item->id]) }}"
                                                                        class="btn btn-info btn-sm"><i
                                                                            class="fas fa-eye"></i></a>
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
                                                        @if ($item->rubrique && $item->rubrique->typeRubrique->state != 1)
                                                            <tr>
                                                                @php
                                                                    $total += $item->amount;
                                                                @endphp
                                                                <td style="font-size:10px">{{ $item->date }}</td>
                                                                <td style="font-size:10px">{{ $item->rubrique->code }}
                                                                </td>
                                                                <td style="font-size:10px">{{ $item->description }}</td>
                                                                <td style="font-size:10px">
                                                                    <span
                                                                        class="numberFormat">{{ $item->amount * 1 }}</span>
                                                                    {{ $budgeting->currency->currency }}
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a title="Afficher"
                                                                        style="color: #fff;margin-right: 5px"
                                                                        href="{{ route('repportings.transaction.show', ['id' => $item->id]) }}"
                                                                        class="btn btn-info btn-sm"><i
                                                                            class="fas fa-eye"></i></a>
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
                            </div>
                        </div>
                    </div>
        </div>
    </main>
@endsection
