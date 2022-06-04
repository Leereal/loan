<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use DataTables;
use Illuminate\Http\Request;

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
        return view('backend.transactions.list');
    }

    public function get_table_data(Request $request) {
        $transactions = Transaction::select('transactions.*')
            ->with('user')
            ->with('currency')
            ->orderBy("transactions.id", "desc");

        return Datatables::eloquent($transactions)
            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
                if ($request->has('type')) {
                    $query->where('type', $request->type);
                }
            }, true)
            ->editColumn('user.name', function ($transaction) {
                return '<b>' . $transaction->user->name . ' </b><br>' . $transaction->user->email;
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

}