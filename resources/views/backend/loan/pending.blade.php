@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title">{{ _lang('Pending Loans') }}</span>

            </div>
            <div class="card-body">
                <table id="loans" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>{{ _lang('Loan ID') }}</th>
                            <th>{{ _lang('Loan Product') }}</th>
                            <th>{{ _lang('Borrower') }}</th>
                            <th>{{ _lang('Release Date') }}</th>
                            <th>{{ _lang('Applied Amount') }}</th>
                            <th>{{ _lang('Balance') }}</th>
                            <th>{{ _lang('Status') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr data-id="row_{{ $loan->id }}">
                            <td class='loan_id'>{{ $loan->loan_id }}</td>
                            <td class='loan_product'>{{ $loan->loan_product->name }}</td>
                            <td class='borrower'>{{ $loan->borrower->name}}</td>
                            <td class='release_date'>{{ $loan->release_date}}</td>
                            <td class='applied_amount'>{{ $loan->applied_amount}}</td>
                            <td class='balance'>{{ $loan->total_payable }}</td>
                            <td class='status'>{{ $loan->branch->name }}</td>
                            <td class="text-center">
                                @if($loan->status == 0)
                                <a class="btn btn-outline-primary btn-sm"
                                    href="{{ action('LoanController@approve', $loan['id']) }}"><i
                                        class="icofont-check-circled"></i> {{ _lang("Click to Approve") }}</a>
                                <a class="btn btn-outline-danger btn-sm float-right"
                                    href="{{ action('LoanController@reject', $loan['id']) }}"><i
                                        class="icofont-close-line-circled"></i> {{ _lang("Click to Reject") }}</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection