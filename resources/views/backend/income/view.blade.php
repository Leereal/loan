@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('View Income') }}</span>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>{{ _lang('Type') }}</td>
                        <td>{{ $income->type }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Description') }}</td>
                        <td>{{ $income->description }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Amount') }}</td>
                        <td>{{ $income->amount }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Created By') }}</td>
                        <td>{{ $income->created_by->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Updated By') }}</td>
                        <td>{{ $income->updated_by->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Branch') }}</td>
                        <td>{{ $income->branch->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection