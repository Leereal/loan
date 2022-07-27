@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title">{{ _lang('Registers') }}</span>
            </div>
            <div class="ml-auto row">
                <span class="form-group col">
                    <label for="loan_product">Loan Product</label>
                    <select name="loan_product" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($loan_products as $loan_product )
                        <option value="{{ $loan_product->id }}">{{ _lang($loan_product->name) }}</option>
                        @endforeach
                    </select>
                </span>
                @if(get_setting(\App\Models\Setting::all(),'branch_view'=='disabled') || auth()->user()->user_type
                == 'admin')
                <span class="form-group col">
                    <label for="branch">Branch</label>
                    <select name="branch" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($branches as $branch )
                        <option value="{{ $branch->id }}">{{ _lang($branch->name) }}</option>
                        @endforeach
                    </select>
                </span>
                @endif
                <span class="form-group col">
                    <label for="employer">Employer</label>
                    <select name="employer" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($employers as $employer )
                        <option value="{{ $employer->id }}">{{ _lang($employer->name) }}</option>
                        @endforeach
                    </select>
                </span>
                <span class="form-group col">
                    <label for="age">Age Analysis</label>
                    <select name="age" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($ages as $age )
                        <option value="{{ $age }}">{{ _lang($age) }}</option>
                        @endforeach
                    </select>
                </span>
                <span class="form-group col">
                    <label for="currency">Currency</label>
                    <select name="currency" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($currencies as $currency )
                        <option value="{{ $currency->id }}">{{ _lang($currency->name) }}</option>
                        @endforeach
                    </select>
                </span>
                <span class="form-group col">
                    <label for="withdraw_method">Disbursement Method</label>
                    <select name="withdraw_method" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        @foreach ($withdraw_methods as $withdraw_method )
                        <option value="{{ $withdraw_method->id }}">{{ _lang($withdraw_method->name) }}</option>
                        @endforeach
                    </select>
                </span>
                <span class="form-group col">
                    <label for="status">Loan Status</label>
                    <select name="status" class="select-filter filter-select">
                        <option value="">{{ _lang('All') }}</option>
                        {{-- <option value="0">{{ _lang('Pending') }}</option> --}}
                        <option value="1">{{ _lang('Approved') }}</option>
                        {{-- <option value="2">{{ _lang('Completed') }}</option> --}}
                        {{-- <option value="3">{{ _lang('Cancelled') }}</option> --}}
                        <option value="4">{{ _lang('Overdue') }}</option>
                        <option value="5">{{ _lang('Internal') }}</option>
                        <option value="6">{{ _lang('Bad Debts') }}</option>
                    </select>
                </span>
                <span class="col">
                    <a class="btn btn-primary btn-sm" href="{{ route('registers.index') }}"><i
                            class="icofont-refresh"></i>
                        {{ _lang('Refresh') }}</a>

                </span>


            </div>

            <div class="card-body">
                <table id="register_table" class="table table-bordered  table-hover table-striped  nowrap ">
                    <thead class="">
                        <tr>
                            <th>{{ _lang('Created Date') }}</th>
                            <th>{{ _lang('Client Name') }}</th>
                            <th>{{ _lang('Loan Product') }}</th>
                            <th>{{ _lang('Applied Amount') }}</th>
                            <th>{{ _lang('Total Paid') }}</th>
                            <th>{{ _lang('Amount Due') }}</th>
                            <th>{{ _lang('Loan ID') }}</th>
                            <th>{{ _lang('Cellphone') }}</th>
                            <th>{{ _lang('Release Date') }}</th>
                            <th>{{ _lang('Cash Out') }}</th>
                            <th>{{ _lang('First Payment Date') }}</th>
                            <th>{{ _lang('Disbursement Method') }}</th>
                            <th>{{ _lang('Penalties') }}</th>
                            <th>{{ _lang('Admin Fee') }}</th>
                            <th>{{ _lang('Description') }}</th>
                            <th>{{ _lang('Remarks') }}</th>
                            <th>{{ _lang('Disbursed By') }}</th>
                            <th>{{ _lang('Approved By') }}</th>
                            <th>{{ _lang('Branch') }}</th>
                            <th>{{ _lang('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script src="{{ asset('backend/assets/js/datatables/register.js') }}"></script>
@endsection