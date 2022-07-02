@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('Add Expense') }}</span>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('expenses.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Type') }}</label>
                                <select class="form-control auto-select" data-selected="{{ old('type') }}" name="type"
                                    required>
                                    <option value="withdrawal">{{ _lang('Withdrawal') }}</option>
                                    <option value="other">{{ _lang('Other') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Description') }}</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ old('description') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Currency') }}</label>
                                <select class="form-control auto-select" data-selected="{{ old('currency_id') }}"
                                    name="currency_id" required>
                                    <option value="">{{ _lang('Select One') }}</option>
                                    {{ create_option('currency','id','name','',array('status=' => 1)) }}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Amount')}}</label>
                                <input type="text" class="form-control float-field" name="amount"
                                    value="{{ old('amount') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{
                                    _lang('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection