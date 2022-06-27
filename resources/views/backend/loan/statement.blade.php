@extends('layouts.app')

@section('content')
<div class="body-view">
    <div class="page-content container printable">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Loan Statement
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: {{ $loan->loan_id }}
                </small>
            </h1>

            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print"
                        onclick="window.print();">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>

                </div>
            </div>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <img class="logo mr-1" width="100" src="{{ get_logo() }}">
                                <span class="text-default-d3 company-color">{{ get_option('site_title',
                                    config('app.name')) }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <hr class="row brc-default-l1 mx-n1 mb-4" />

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Client Name: </span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $loan->borrower->name
                                    }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">ID Number: </span>
                                <span class="text-600 text-110 text-blue align-middle">{{
                                    $loan->borrower->id_number}}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">

                                    <span class="text-sm text-grey-m2 align-middle">Branch: </span>
                                    <span class="text-600 text-110 text-blue align-middle">{{
                                        $loan->branch->name}}</span>
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b
                                        class="text-600"> : +{{ $loan->borrower->country_code.$loan->borrower->phone}}
                                    </b></div>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Loan Statement
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Amount Applied : </span>{{
                                    decimalPlace($loan->applied_amount,
                                    currency($loan->currency->name)) }}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Admin Fee : </span>
                                    {{decimalPlace($loan->admin_fee,currency($loan->currency->name))}}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Status:</span>
                                    <span class="badge 
                                        {{
                                        match($loan->status){
                                        0," 0"=> ' badge-danger',
                                        1,"1" => ' badge-warning',
                                        2,"2" => ' badge-success',
                                        3,"3" => ' badge-doubt',
                                        4,"4" => ' badge-doubt',
                                        5,"5" => ' badge-doubt',
                                        6,"6" => ' badge-doubt',
                                        default =>' badge-danger',
                                        };
                                        }}"
                                        >
                                        {{
                                        match($loan->status){
                                        0," 0"=> 'Pending Approval',
                                        1,"1" => 'Unpaid',
                                        2,"2" => 'Completed',
                                        3,"3" => 'Cancelled',
                                        4,"4" => 'Overdue',
                                        5,"5" => 'Internal',
                                        6,"6" => 'Bad Debt',
                                        default =>'Invalid',
                                        };
                                        }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    {{-- <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">Receipt Number</div>
                            <div class="col-9 col-sm-5">Description</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2">Amount</div>
                        </div>

                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">1</div>
                                <div class="col-9 col-sm-5">Domain registration</div>
                                <div class="d-none d-sm-block col-2">2</div>
                                <div class="d-none d-sm-block col-2 text-95">$10</div>
                                <div class="col-2 text-secondary-d2">$20</div>
                            </div>

                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <div class="d-none d-sm-block col-1">2</div>
                                <div class="col-9 col-sm-5">Web hosting</div>
                                <div class="d-none d-sm-block col-2">1</div>
                                <div class="d-none d-sm-block col-2 text-95">$15</div>
                                <div class="col-2 text-secondary-d2">$15</div>
                            </div>

                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">3</div>
                                <div class="col-9 col-sm-5">Software development</div>
                                <div class="d-none d-sm-block col-2">--</div>
                                <div class="d-none d-sm-block col-2 text-95">$1,000</div>
                                <div class="col-2 text-secondary-d2">$1,000</div>
                            </div>

                            <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                <div class="d-none d-sm-block col-1">4</div>
                                <div class="col-9 col-sm-5">Consulting</div>
                                <div class="d-none d-sm-block col-2">1 Year</div>
                                <div class="d-none d-sm-block col-2 text-95">$500</div>
                                <div class="col-2 text-secondary-d2">$500</div>
                            </div>
                        </div> --}}

                        {{-- <div class="row border-b-2 brc-default-l2"></div> --}}

                        <!-- or use a table instead -->

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none">
                                    <tr class="text-white">
                                        <th>Date</th>
                                        <th class="opacity-2">Receipt Number</th>
                                        <th>Transacted By</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                    <tr></tr>
                                    <?php $balance = 0; ?>
                                    <?php $total_paid = 0;?>
                                    @foreach ( $loan->transactions as $transaction )
                                    @if ($transaction->type !="Admin_Fee")

                                    <tr>
                                        <td>{{ $transaction->type == 'Interest' ? $transaction->loan->first_payment_date
                                            : $transaction->created_at}}</td>
                                        <td>{{ $transaction->receipt_number ?? 'N/A' }}</td>
                                        <td>{{ $transaction->created_by->name ?? 'Auto System'}}</td>
                                        <td>{{ $transaction->note }}</td>
                                        <td class="text-95">
                                            @if($transaction->dr_cr=='cr' && $transaction->type == 'Loan_Disbursement')
                                            {{decimalPlace($transaction->loan->applied_amount,currency($transaction->currency->name))}}
                                            <?php $balance += $transaction->loan->applied_amount ?>
                                            @elseif($transaction->dr_cr=='cr')
                                            {{decimalPlace($transaction->amount,currency($transaction->currency->name))}}
                                            <?php $balance += $transaction->amount; ?>
                                            @endif
                                        </td>
                                        <td class="text-secondary-d2">
                                            @if($transaction->dr_cr=='dr' )
                                            {{
                                            decimalPlace($transaction->amount,currency($transaction->currency->name));
                                            }}
                                            <?php $balance -= $transaction->amount; ?>
                                            <?php $total_paid += $transaction->amount; ?>
                                            @endif
                                        </td>
                                        <td class="text-secondary-d2">{{
                                            decimalPlace($balance,currency($transaction->currency->name)) }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                NB: A Negative balance shows over payment
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Total Paid
                                    </div>
                                    <div class="col-5 text-right">
                                        <span class="text-120 text-secondary-d1">{{
                                            decimalPlace($total_paid,currency($transaction->currency->name)) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Total Balance
                                    </div>
                                    <div class="col-5 text-right">
                                        <span class="text-110 text-secondary-d1">{{
                                            decimalPlace($balance,currency($transaction->currency->name)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div>
                            <span class="text-secondary-d1 text-105">Thank you for doing business with us</span>
                            <a href="{{ action('LoanController@repay', $loan->id) }}"
                                class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>
                        </div>
                        <div id="editor"></div>
                        {{--
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js-script')

<script>

</script>
@endsection