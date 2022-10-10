@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">PBA (Plan Budgétaire Actif)</h5>
                            <div class="list-group">
                                @foreach ($budgetings as $item)
                                    <a href="{{ route('repportings', ['id' => $item->id]) }}" type="button"
                                        class="btn mb-1 list-group-item btn-info list-group-item-action"
                                        aria-current="true">
                                        {{ $item->description }}, De {{ $item->startYear->year }} à
                                        {{ $item->endYear->year }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
