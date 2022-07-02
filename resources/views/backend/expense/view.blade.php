@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('View Expense') }}</span>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>{{ _lang('Type') }}</td>
                        <td>{{ $expense->type }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Description') }}</td>
                        <td>{{ $expense->description }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Amount') }}</td>
                        <td>{{ $expense->amount }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Created By') }}</td>
                        <td>{{ $expense->created_by->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Updated By') }}</td>
                        <td>{{ $expense->updated_by->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Branch') }}</td>
                        <td>{{ $expense->branch->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection