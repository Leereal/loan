@extends('layouts.app')

@section('content')

<div id="invoice-POS">

    <center id="top">
        <div class="logo"> <img class="logo mr-1" src="{{ get_logo() }}"></div>
        <div class="info">
            <h2>{{ get_option('site_title',
                config('app.name')) }}</h2>
        </div>
        <!--End Info-->
    </center>
    <!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <h2>Contact Info</h2>
            <p>
                Branch :{{$transaction->branch->name}}</br>
                Email : {{$transaction->branch->contact_email ?? ''}}</br>
                Phone : {{$transaction->branch->contact_phone ?? ''}}</br>
            </p>
        </div>
    </div>
    <!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item">
                        <h2>Item</h2>
                    </td>
                    <td class="Hours">
                        <h2>Qty</h2>
                    </td>
                    <td class="Rate">
                        <h2>Sub Total</h2>
                    </td>
                </tr>

                <tr class="service">
                    <td class="tableitem">
                        <p class="itemtext">Loan Repayment</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">1</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">$100.00</p>
                    </td>
                </tr>

                {{-- <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>tax</h2>
                    </td>
                    <td class="payment">
                        <h2>$419.25</h2>
                    </td>
                </tr> --}}

                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">
                        <h2>Total</h2>
                    </td>
                    <td class="payment">
                        <h2>$100.00</h2>
                    </td>
                </tr>

            </table>
        </div>
        <!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank you for doing business with us!</strong> 
            </p>
        </div>

    </div>
    <!--End InvoiceBot-->
</div>
<!--End Invoice-->

@endsection

@section('js-script')

<script>

</script>
@endsection