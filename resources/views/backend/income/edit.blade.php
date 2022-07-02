@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('Update Loan Product') }}</span>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off"
                    action="{{ action('IncomeController@update', $id) }}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Type') }}</label>
                                <select class="form-control auto-select" data-selected="{{ $income->type }}" name="type"
                                    required>
                                    <option value="issued_in">{{ _lang('Issued In') }}</option>
                                    <option value="other">{{ _lang('Other') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Description') }}</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ $income->description }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Currency') }}</label>
                                <select class="form-control auto-select" data-selected="{{ $income->currency_id }}"
                                    name="currency_id" required>
                                    <option value="">{{ _lang('Select One') }}</option>
                                    {{ create_option('currency','id','name','',array('status=' => 1)) }}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Payment Method') }}</label>
                                <select class="form-control auto-select"
                                    data-selected="{{ $income->payment_method_id }}" name="payment_method" required>
                                    <option value="">Select Method</option>
                                    @foreach ($payment_methods as $payment_method )
                                    <option value="{{ $payment_method->id }}">{{ _lang($payment_method->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Amount')}}</label>
                                <input type="text" class="form-control float-field" name="amount"
                                    value="{{ $income->amount }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{
                                    _lang('Update Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection