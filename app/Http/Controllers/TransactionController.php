<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Loan;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\WithdrawMethod;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transactions = Transaction::select('type','note')->distinct()->get();    
        return view('backend.transactions.list', compact('transactions'));
    }

    public function get_table_data(Request $request) {
        $transactions = Transaction::select('transactions.*')
            ->with('user')
            ->with('currency')
            ->orderBy("transactions.id", "desc");

        return Datatables::eloquent($transactions)
            ->filter(function ($query) use ($request) {
                // if(get_setting(Setting::get(),'branch_view')== 'enabled' && (auth()->user()->role->multiple_branch == 0) ){
                //     $query->where('transactions.branch_id', Auth::user()->branch->id);                    
                // }
                // if ($request->has('status')) {
                //     $query->where('status', $request->status);
                // }
                // if ($request->has('type')) {
                //     $query->where('type', $request->type);
                // }
                // if ($request->has('from_date') && $request->has('to_date') ) {                
                //     $query ->whereDate('created_at', '>=', date($request->from_date));
                //     $query->whereDate('created_at', '<=', date($request->to_date));
                // }
               
            }, true)
            ->editColumn('user.name', function ($transaction) {
                return '<b>' . $transaction->user->name . ' </b><br> ID: ' . $transaction->user->id_number;
            })
            ->editColumn('amount', function ($transaction) {
                $symbol = $transaction->dr_cr == 'cr' ? '-' : '+';
                $class  = $transaction->dr_cr == 'cr' ? 'text-danger' : 'text-success';
                return '<span class="' . $class . '">' . $symbol . ' ' . decimalPlace($transaction->amount, currency($transaction->currency->name)) . '</span>';
            })
            ->editColumn('dr_cr', function ($transaction) {
                return match($transaction->dr_cr){'dr' => "Debit", 'cr' => "Credit"};
            })
            ->editColumn('type', function ($transaction) {
                return str_replace('_', ' ', $transaction->type);
            })
            ->editColumn('status', function ($transaction) {
                return transaction_status($transaction->status);
            })
            ->addColumn('action', function ($transaction) {
                $actions = '<div class="text-center"><a href="' . action('TransferRequestController@show', $transaction['id']) . '" data-title="' . _lang('Transaction Details') . '" class="btn btn-outline-primary btn-sm ajax-modal"><i class="icofont-eye-alt"></i> ' . _lang('Details') . '</a></div>';

                return $actions;
            })
            ->setRowId(function ($transaction) {
                return "row_" . $transaction->id;
            })
            ->rawColumns(['user.name', 'status', 'amount', 'action'])
            ->make(true);
    }

    public function summary(Request $request){
        $currencies     = Currency::where('status',1)->get();
        $branches       = Branch::all();
        $payment_methods= WithdrawMethod::where('status',1)->get();
        $transactions = Transaction::where('status',2)->get();

        $currency = Currency::find(1);

        //Totals before today
        $prev_total_incomes = Income::where([['created_at','<',Carbon::today()],['withdraw_method_id',1]])->sum('amount');
        $prev_total_expenses = Expense::where([['created_at','<',Carbon::today()],['withdraw_method_id',1]])->sum('amount');
        $prev_cash_out = Transaction::where([['created_at','<',Carbon::today()],['type','Loan_Disbursement']])->sum('amount');
        $prev_repayments = Transaction::where([['created_at','<',Carbon::today()],['type','Loan_Repayment']])->sum('amount');

        //Todays Totals      
        $incomes = Income::whereDate('created_at',Carbon::today())->where('withdraw_method_id',1)->whereNotIn('type',['issued_in'])->get();
        $cash_issued_ins = Income::whereDate('created_at',Carbon::today())->where([['type','issued_in'],['withdraw_method_id',1]])->get();
        $repayments = Transaction::whereDate('created_at',Carbon::today())->where('type','Loan_Repayment')->get();
        $disbursements = Transaction::whereDate('created_at',Carbon::today())->where('type','Loan_Disbursement')->get();
        $expenses = Expense::whereDate('created_at',Carbon::today())->where('withdraw_method_id',1)->get();     

        $payment_method = WithdrawMethod::find(1);
        $opening_balance = ($prev_repayments+$prev_total_incomes)-($prev_cash_out+$prev_total_expenses);   

        return view('backend.transactions.summary', compact('transactions','currencies', 'branches','payment_methods','payment_method','opening_balance','cash_issued_ins','repayments','incomes','disbursements','expenses','currency'));
    }

}