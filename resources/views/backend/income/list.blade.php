@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title">{{ _lang('Incomes') }}</span>
                <a class="btn btn-primary btn-sm float-right" href="{{ route('incomes.create') }}"><i
                        class="icofont-plus-circle"></i> {{ _lang('Add Income') }}</a>
            </div>
            <div class="card-body">
                <table id="loan_products_table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>{{ _lang('Date') }}</th>
                            <th>{{ _lang('Description') }}</th>
                            <th>{{ _lang('Type') }}</th>
                            <th>{{ _lang('Amount') }}</th>
                            <th>{{ _lang('Payment Method') }}</th>
                            <th>{{ _lang('Created By') }}</th>
                            <th>{{ _lang('Branch') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incomes as $income)
                        <tr data-id="row_{{ $income->id }}">
                            <td class='date'>{{ $income->created_at }}</td>
                            <td class='description'>{{ $income->description }}</td>
                            <td class='type'>{{ $income->type}}
                            </td>
                            <td class='amount'>{{ $income->amount}}</td>
                            <td class='amount'>{{ $income->payment_method->name}}</td>
                            <td class='created_by'>{{ $income->created_by->name }}</td>
                            <td class='branch'>{{ $income->branch->name }}</td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ _lang('Action') }}
                                    </button>
                                    <form action="{{ action('IncomeController@destroy', $income['id']) }}"
                                        method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ action('IncomeController@edit', $income['id']) }}"
                                                class="dropdown-item dropdown-edit dropdown-edit"><i
                                                    class="icofont-ui-edit"></i> {{ _lang('Edit') }}</a>
                                            <a href="{{ action('IncomeController@show', $income['id']) }}"
                                                data-title="{{ _lang('View') }}" class="dropdown-item dropdown-view"><i
                                                    class="icofont-eye-alt"></i> {{ _lang('View') }}</a>
                                            <button class="btn-remove dropdown-item" type="submit"><i
                                                    class="icofont-trash"></i> {{ _lang('Delete') }}</button>
                                        </div>
                                    </form>
                                </div>
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