@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title">{{ _lang('Employers') }}</span>
                <a class="btn btn-primary btn-sm float-right" href="{{ route('employers.create') }}"><i
                        class="icofont-plus-circle"></i> {{ _lang('Add Employers') }}</a>
            </div>
            <div class="card-body">
                <table id="loan_products_table" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>{{ _lang('Name') }}</th>
                            <th>{{ _lang('Address') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th>{{ _lang('Contact Person') }}</th>
                            <th class="text-center">{{ _lang('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employers as $employer)
                        <tr data-id="row_{{ $employer->id }}">
                            <td class='name'>{{ $employer->name }}</td>
                            <td class='address'>{{ $employer->address }}</td>
                            <td class='phone'>{{ $employer->phone}}</td>
                            <td class='contact_name'>{{ $employer->contact_name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ _lang('Action') }}
                                    </button>
                                    <form action="{{ action('EmployerController@destroy', $employer['id']) }}"
                                        method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ action('EmployerController@edit', $employer['id']) }}"
                                                class="dropdown-item dropdown-edit dropdown-edit"><i
                                                    class="icofont-ui-edit"></i> {{ _lang('Edit') }}</a>
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