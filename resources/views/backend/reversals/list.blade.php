@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title">{{ _lang('Reversals') }}</span>
            </div>
            <div class="card-body">
                <table id="loan_products_table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>{{ _lang('Date') }}</th>
                            <th>{{ _lang('Description') }}</th>
                            <th>{{ _lang('Type') }}</th>
                            <th>{{ _lang('Created By') }}</th>
                            <th>{{ _lang('Reversed By') }}</th>
                            <th>{{ _lang('Branch') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reversals as $reversal)
                        <tr data-id="row_{{ $reversal->id }}">
                            <td class='date'>{{ $reversal->created_at }}</td>
                            <td class='description'>{{ $reversal->description }}</td>
                            <td class='type'>{{ $reversal->type}}</td>
                            <td class='created_by'>{{ $reversal->created_by->name }}</td>
                            <td class='reversed_by'>{{ $reversal->reversed_by->name }}</td>
                            <td class='branch'>{{ $reversal->branch->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection