<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\WithdrawMethod;
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
                if(get_setting(Setting::get(),'branch_view')== 'enabled' && Auth::user()->user_type != 'admin' ){
                    $query->where('transactions.branch_id', Auth::user()->branch->id);                    
                }
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
                if ($request->has('type')) {
                    $query->where('type', $request->type);
                }
                if ($request->has('from_date') && $request->has('to_date') ) {                
                    $query ->whereDate('created_at', '>=', date($request->from_date));
                    $query->whereDate('created_at', '<=', date($request->to_date));
                }
               
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

    public function summary(){
        $currencies     = Currency::where('status',1)->get();
        $branches       = Branch::all();
        $payment_methods= WithdrawMethod::where('status',1)->get();
        $transactions = Transaction::where('status',2)->get();
        return view('backend.transactions.summary', compact('transactions','currencies', 'branches','payment_methods'));
    }

}