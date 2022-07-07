<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanCollateral;
use App\Models\LoanPayment;
use App\Models\LoanRepayment;
use App\Models\Reversal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReversalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $reversals = Reversal::all();
        return view('backend.reversals.list', compact('reversals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loanDisbursementReversal($id)
    {
        if($id){
            //Get the loan to be reversed
            DB::beginTransaction();
            $loan = Loan::find($id);

            //Insert the reversal first
            $reversal                       = new Reversal();
            $reversal->type                 = "Loan_Disbursement";
            $reversal->description          = "Loan ID ".$loan->loan_id." reversed before approval.";
            $reversal->loan_id              = $id;
            $reversal->created_user_id      = $loan->created_user_id;
            $reversal->reversed_user_id     = auth()->id();
            $reversal->branch_id            = $loan->branch_id;
            $reversal->save();

            //Delete the loan if not approved   
            //If loan was approved delete all other records      
            $loan_collaterals = LoanCollateral::where('loan_id', $loan->id);
            $loan_collaterals->delete();

            $repayments = LoanRepayment::where('loan_id', $loan->id);
            $repayments->delete();

            $loan_payment = LoanPayment::where('loan_id', $loan->id);
            $loan_payment->delete();

            $transaction = Transaction::where('loan_id', $loan->id);
            $transaction->delete();

            $loan->delete();

            DB::commit();

            return redirect()->route('loans.index')->with('success', _lang('Deleted successfully'));
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reversal  $reversal
     * @return \Illuminate\Http\Response
     */
    public function show(Reversal $reversal)
    {
        //
    }

    public function destroy(Reversal $reversal)
    {
        //
    }
}
