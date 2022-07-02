@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title">{{ _lang('Cash Summary') }}</span>
                <div class="ml-auto">
                    <span class="form-group float-left mr-2">
                        <input type="text" class=" datepicker select-filter filter-select" name="from_date"
                            style="width: 120px" value="">
                    </span>
                    <span class="form-group float-left mr-2">
                        <input type="text" class=" datepicker select-filter filter-select" style="width: 120px"
                            name="to_date" value="">
                    </span>
                    <span class="form-group">
                        <label for="age">Payment Method</label>
                        <select name="payment_method" class="select-filter filter-select">
                            <option value="">{{ _lang('All') }}</option>
                            @foreach ($payment_methods as $payment_method )
                            <option value="{{ $payment_method->id }}">{{ _lang($payment_method->name) }}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="form-group">
                        <label for="currency">Currency</label>
                        <select name="currency" class="select-filter filter-select">
                            <option value="">{{ _lang('All') }}</option>
                            @foreach ($currencies as $currency )
                            <option value="{{ $currency->id }}">{{ _lang($currency->name) }}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="form-group">
                        <label for="branch">Branch</label>
                        <select name="branch" class="select-filter filter-select">
                            <option value="">{{ _lang('All') }}</option>
                            @foreach ($branches as $branch )
                            <option value="{{ $branch->id }}">{{ _lang($branch->name) }}</option>
                            @endforeach
                        </select>
                    </span>
                    <a class="btn btn-primary btn-sm" href="{{ route('registers.index') }}"><i
                            class="icofont-refresh"></i>
                        {{ _lang('Refresh') }}</a>
                </div>
            </div>

            <div class="card-body">
                <table id="registers_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8">{{ _lang('Cash Summary') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"><strong> OPENING BALANCE</strong></td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td colspan="7"><strong>Cash Issued In</strong> </td>
                            <td>270</td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>CASH INFLOW</strong></td>
                        </tr>
                        <tr>
                            <td><strong>CLIENT'S NAME</strong></td>
                            <td><strong>RECEIPT NUMBER</strong></td>
                            <td><strong>CAPITAL</strong></td>
                            <td><strong>INTEREST</strong></td>
                            <td><strong>TOTAL</strong></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>MOSES GUMBO</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><strong>TOTAL RECEIPTS</strong></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>OTHER RECEIPTS</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL CASH INFLOW</strong></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>CASH OUTFLOW</strong></td>
                        </tr>
                        <tr>
                            <td><strong>CLIENT'S NAME</strong></td>
                            <td><strong>APPLICATION</strong></td>
                            <td><strong>APPLIED AMOUNT</strong></td>
                            <td><strong>ADMIN FEE</strong></td>
                            <td><strong>CASH DISBURSED</strong></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>BRIAN CHITAKATIRA</td>
                            <td>0</td>
                            <td>167</td>
                            <td>17</td>
                            <td>150</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>BRIAN CHITAKATIRA</td>
                            <td>0</td>
                            <td>167</td>
                            <td>17</td>
                            <td>150</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL DISBURSEMENTS</strong></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>OTHER CASH OUTFLOWS</strong></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td><strong>TOTAL CASH OUTFLOWS</strong></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="7"><strong>NET CASHFLOW</strong></td>
                            <td>270</td>
                        </tr>
                        <tr>
                            <td colspan="7"><strong>CLOSING BALANCE</strong></td>
                            <td>270</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
{{-- <script src="{{ asset('backend/assets/js/datatables/registers.js') }}"></script> --}}
@endsection