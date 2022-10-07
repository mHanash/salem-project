@extends('layouts.main')

@section('content')
    <main style="margin-top: 10px">
        <div class="container pt-4">
            <div class="page-breadcrumb">
                <div class="row align-items-center" style="margin-bottom: 10px">
                    <h4 class="text-primary page-title">
                        MODIFICATION INFO BUDGET
                    </h4>
                </div>
            </div>
            <div class="row" style="padding-top: 70px;padding-left:10px">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('budgetings.update', ['id' => $budgeting->id]) }}">
                        <!-- Name input -->
                        @csrf
                        <div class="form-outline mb-4">
                            <input value="{{ $budgeting->description }}" required="required" name="description"
                                type="text" id="description" class="form-control" />
                            <label class="form-label" for="description">Description</label>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="startYear" id="startYear" class="form-control">
                                <option disabled value="">Année début</option>
                                @foreach ($years as $item)
                                    @if ($item->id == $budgeting->startYear->id)
                                        <option selected value="{{ $item->id }}">{{ $item->year }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="endYear" id="endYear" class="form-control">
                                <option disabled value="">Année fin</option>
                                @foreach ($years as $item)
                                    @if ($item->id == $budgeting->endYear->id)
                                        <option selected value="{{ $item->id }}">{{ $item->year }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="currency" id="currency" class="form-control">
                                <option disabled value="">Dévise</option>
                                @foreach ($currencies as $item)
                                    @if ($item->id == $budgeting->currency->id)
                                        <option selected value="{{ $item->id }}">{{ $item->currency }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->currency }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <select required="required" name="status" id="status" class="form-control">
                                <option disabled value="">Status</option>
                                @foreach ($status as $item)
                                    @if ($item->id == $budgeting->status->id)
                                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <button type="submit" style="margin-right: 7px" class="btn btn-primary">Modifier</button>
                            <a class="btn btn-info" href="{{ route('budgetings') }}">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
