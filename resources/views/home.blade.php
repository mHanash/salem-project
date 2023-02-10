@extends('layouts.main')

@section('content')
    @php
        $admin = false;
        $finan = false;
        $eco = false;
    @endphp
    @foreach (Auth::user()->roles as $role)
        @if ($role->name == 'ADMIN')
            @php
                $admin = true;
            @endphp
        @endif
        @if ($role->name == 'FINANCIAL')
            @php
                $finan = true;
            @endphp
        @endif
        @if ($role->name == 'ECONOMAT')
            @php
                $eco = true;
            @endphp
        @endif
    @endforeach
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <section>
                <div class="row">
                    @if ($eco || $finan)
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="nav-link" href="{{ route('repportings.home') }}">
                                        <div class="d-flex justify-content-between px-md-1">
                                            <div class="align-self-center">
                                                <i class="fas fa-pencil-alt text-info fa-3x"></i>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-danger">RAPPORTS</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="nav-link" href="{{ route('transactions.home') }}">
                                        <div class="d-flex justify-content-between px-md-1">
                                            <div class="align-self-center">
                                                <i class="far fa-comment-alt text-warning fa-3x"></i>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-danger">JOURNAL</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($eco || $admin)
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="nav-link" href="{{ route('accounts') }}">
                                        <div class="d-flex justify-content-between px-md-1">
                                            <div class="align-self-center">
                                                <i class="fas fa-chart-line text-success fa-3x"></i>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-danger">COMPTES</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($admin)
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="nav-link" href="{{ route('budgetings') }}">
                                        <div class="d-flex justify-content-between px-md-1">
                                            <div class="align-self-center">
                                                <i class="fas fa-map-marker-alt text-danger fa-3x"></i>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-danger">BUDGETS</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="nav-link" href="{{ route('users') }}">
                                        <div class="d-flex justify-content-between px-md-1">
                                            <div class="align-self-center">
                                                <i class="fas fa-cog text-danger fa-3x"></i>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-danger">Utilisateurs</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </main>
@endsection
