@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            {{-- <div class="card-header d-flex align-items-center no-print">
                <span class="panel-title no-print">{{ _lang('Cash Summary') }}</span>
                <div class="ml-auto no-print">
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
                        <select name="payment_method" class="select-filter filter-select ">
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
            </div> --}}

            <div class="card-body" style="overflow-x: scroll; ">
                <table id="summary" class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="8">{{ _lang($payment_method->name.' Summary') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"><strong> OPENING BALANCE</strong></td>
                            <td><strong>{{decimalPlace($opening_balance,currency($currency->name))}}</strong></td>
                        </tr>
                        <tr class="table-primary">
                            <td colspan="7"><strong>Cash Issued In</strong> </td>
                            <td><strong>{{decimalPlace($cash_issued_ins->sum('amount'),currency($currency->name))}}</strong>
                            </td>
                        </tr>
                        @forelse($cash_issued_ins as $cash_issued_in)
                        <tr>
                            <td colspan="7">{{ $cash_issued_in->description }} </td>
                            <td>
                                {{decimalPlace($cash_issued_in->amount,currency($currency->name))}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        @endforelse

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
                        @forelse($repayments as $repayment)
                        <tr>
                            <td>{{ $repayment->user->name }}</td>
                            <td>{{ $repayment->receipt_number }}</td>
                            <td>{{decimalPlace($repayment->loan->applied_amount,currency($currency->name))}}</td>
                            <td>{{decimalPlace($repayment->loan->total_interest,currency($currency->name))}}</td>
                            <td>{{decimalPlace($repayment->amount,currency($currency->name))}}</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        @endforelse
                        <tr class="table-primary">
                            <td><strong>TOTAL RECEIPTS</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><strong>{{decimalPlace($repayments->sum('amount'),currency($currency->name))}}</strong>
                            </td>
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
                        @forelse($incomes as $income)
                        <tr>
                            <td>{{ $income->description }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{decimalPlace($income->amount,currency($currency->name))}}</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        @endforelse
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr class="table-primary">
                            <td class="text-nowrap"><strong>TOTAL CASH INFLOW</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><strong>{{decimalPlace(($repayments->sum('amount') + $incomes->sum('amount') +
                                    0),currency($currency->name))}}</strong></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="7"><strong>CASH OUTFLOW</strong></td>
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
                        @forelse($disbursements as $disbursement)
                        <tr>
                            <td>{{ $disbursement->user->name }}</td>
                            <td>0</td>
                            <td>{{decimalPlace($disbursement->loan->applied_amount,currency($currency->name))}}</td>
                            <td>{{decimalPlace($disbursement->loan->admin_fee,currency($currency->name))}}</td>
                            <td>{{decimalPlace($disbursement->loan->cash_out,currency($currency->name))}}</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        @endforelse
                        <tr class="table-primary">
                            <td class="text-nowrap"><strong>TOTAL DISBURSEMENTS</strong></td>
                            <td>0</td>
                            <td>{{decimalPlace($disbursements->sum('loan.applied_amount'),currency($currency->name))}}
                            </td>
                            <td>{{decimalPlace($disbursements->sum('loan.admin_fee'),currency($currency->name))}}</td>
                            <td><strong>{{decimalPlace($disbursements->sum('loan.cash_out'),currency($currency->name))}}</strong>
                            </td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap"><strong>OTHER CASH OUTFLOWS</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense->description }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{decimalPlace($expense->amount,currency($currency->name))}}</td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        @endforelse
                        <tr></tr>
                        <tr class="table-primary text-nowrap">
                            <td><strong>TOTAL CASH OUTFLOWS</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><strong>{{decimalPlace(($disbursements->sum('amount') + $expenses->sum('amount') +
                                    0),currency($currency->name))}}</strong></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="7"><strong>NET CASHFLOW</strong></td>
                            <td>{{ 0 }}</td>
                        </tr>
                        <tr class="table-primary text-nowrap">
                            <td colspan="7"><strong>CLOSING BALANCE </strong></td>
                            <td><strong>{{decimalPlace((($opening_balance + $cash_issued_ins->sum('amount') +
                                    $repayments->sum('amount') +
                                    $incomes->sum('amount'))-
                                    ($disbursements->sum('amount') +
                                    $expenses->sum('amount'))),currency($currency->name))}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection