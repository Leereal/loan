<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Loan;
use App\Models\LoanProduct;
use App\Models\Setting;
use App\Models\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class RegistersController extends Controller
{
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
        $currencies     = Currency::all();
        $branches         = Branch::all();
        $ages            = ["Current","1 Month","2 Months","3 Months","3 to < 6 Months","6 to 12 Months","+1 Year"];
   
        return view('backend.reports.registers.list', compact('currencies', 'branches','ages'));
    }


    public function get_table_data(Request $request) {
        $branch = $request->branch;
        $registers = DB::table('loan_products')
        ->join('loans', 'loan_products.id', '=', 'loans.loan_product_id')
        ->select('loan_products.id','name', 'interest_rate','branch_id', DB::raw('SUM(loans.applied_amount) AS disbursements,SUM(loans.total_paid) AS repayments,COUNT(loans.id) as total_loans'))
        ->whereNotIn('loans.status',[0,3,2])
        ->groupBy('name')
        ->orderBy('name'); 
        return Datatables::queryBuilder($registers)

            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('loans.status', $request->status);
                }
                if ($request->has('branch')) {
                    $query->where('loans.branch_id', $request->branch);
                }
                if ($request->has('currency')) {
                    $query->where('loans.currency_id', $request->currency);
                }
                if ($request->has('age')) {
                    if($request->age == 'Current'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(1),Carbon::now()]);
                    }
                    if($request->age == '1 Month'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(2),Carbon::now()->subMonths(1)]);
                    }
                    if($request->age == '2 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(3),Carbon::now()->subMonths(2)]);
                    }  
                    if($request->age == '3 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(4),Carbon::now()->subMonths(3)]);
                    }  
                    if($request->age == '3 to < 6 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(6),Carbon::now()->subMonths(4)]);
                    }  
                    if($request->age == '6 to 12 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(12),Carbon::now()->subMonths(6)]);
                    }
                    if($request->age == '+1 Year'){
                        $query->whereBetween("loans.created_at", "<=",Carbon::now()->subMonths(12));
                    }                       
                }
            }, true)
        
            ->editColumn('disbursements', function ($register) use($request) {
                
                if($request->currency){
                    $currency= Currency::find($request->currency);                   
                    return decimalPlace($register->disbursements, currency($currency->name));
                }
                return decimalPlace($register->disbursements, currency($request->currency));
                
            })
            ->editColumn('repayments', function ($register) use($request) {
                if($request->currency){
                    $currency= Currency::find($request->currency);                   
                    return decimalPlace($register->repayments, currency($currency->name));
                }
                return decimalPlace($register->repayments, currency($request->currency));
            })

            ->editColumn('interest_rate', function ($register){
              
                return (($register->interest_rate) . "%" );
            })
            ->editColumn('name', function ($register){
              
                return  '<a href="' . action('RegistersController@view', $register->name) . '">' . _lang($register->name) . '</a>'; 
            })

            // ->editColumn('interest_rate', 'backend.reports.branch') // To use blade      

            ->addColumn('book_value', function ($register) use($request) { 
                if($request->currency){
                    $currency= Currency::find($request->currency);                   
                    return decimalPlace(($register->disbursements - $register->repayments),currency($currency->name));
                }
                return decimalPlace(($register->disbursements - $register->repayments),currency($request->currency));
            })

            ->addColumn('branch', function ($register) use($request) { 
                if($request->branch){
                    $branch = Branch::find($request->branch);
                    return $branch->name;
                }
                else{
                    return "All Branches";
                }               
            })
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')             
             
            ->setRowId(function ($register) {
                return "row_" . $register->id;
            })       

            ->rawColumns(['name']) //to render html
            ->make(true);
    }

    public function view(Request $request){
        $name=$request->name;
        $currencies     = Currency::all();
        $loan_products     = LoanProduct::all();
        $withdraw_methods     = WithdrawMethod::all();
        $branches       = Branch::all();
        $ages           = ["Current","1 Month","2 Months","3 Months","3 to < 6 Months","6 to 12 Months","+1 Year"];
   
        return view('backend.reports.registers.view', compact('currencies', 'branches','ages','name','withdraw_methods','loan_products'));
    }

    public function get_register_table_data(Request $request) {
        $loans = Loan::select('loans.*')
            ->with('borrower')
            ->with('currency')
            ->with('branch')
            ->orderBy("loans.created_at", "desc");

        return Datatables::eloquent($loans)

            ->filter(function ($query) use ($request) {

                if(get_setting(Setting::get(),'branch_view')== 'enabled' && Auth::user()->user_type != 'admin' ){
                    $query->where('loans.branch_id', Auth::user()->branch->id);                    
                }
      
                if ($request->has('status')) {
                    $query->where('loans.status', $request->status);
                }
                if ($request->has('branch')) {
                    $query->where('loans.branch_id', $request->branch);
                }
                if ($request->has('currency')) {
                    $query->where('loans.currency_id', $request->currency);
                }
                if ($request->has('age')) {
                    if($request->age == 'Current'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(1),Carbon::now()]);
                    }
                    if($request->age == '1 Month'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(2),Carbon::now()->subMonths(1)]);
                    }
                    if($request->age == '2 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(3),Carbon::now()->subMonths(2)]);
                    }  
                    if($request->age == '3 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(4),Carbon::now()->subMonths(3)]);
                    }  
                    if($request->age == '3 to < 6 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(6),Carbon::now()->subMonths(4)]);
                    }  
                    if($request->age == '6 to 12 Months'){
                        $query->whereBetween("loans.created_at", [Carbon::now()->subMonths(12),Carbon::now()->subMonths(6)]);
                    }
                    if($request->age == '+1 Year'){
                        $query->whereBetween("loans.created_at", "<=",Carbon::now()->subMonths(12));
                    }                       
                }
                if ($request->has('withdraw_method')) {
                    $query->where('loans.withdraw_method_id', $request->withdraw_method);
                }
                if ($request->has('loan_product')) {
                    $query->where('loans.loan_product_id', $request->loan_product);
                }
            }, true)
        
            ->editColumn('loan_product', function ($loan){ 
                return $loan->loan_product->name;
            })
            ->editColumn('cash_out', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->cash_out, currency($loan->currency->name));
                }
                return decimalPlace($loan->cash_out, currency($request->currency));
            })
            ->editColumn('penalties', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->late_payment_penalties, currency($loan->currency->name));
                }
                return decimalPlace($loan->late_payment_penalties, currency($request->currency));
            })
            ->editColumn('applied_amount', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->applied_amount, currency($loan->currency->name));
                }
                return decimalPlace($loan->applied_amount, currency($request->currency));
            })
            ->editColumn('total_payable', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->total_payable, currency($loan->currency->name));
                }
                return decimalPlace($loan->total_payable, currency($request->currency));
            })
            ->editColumn('total_paid', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->total_paid, currency($loan->currency->name));
                }
                return decimalPlace($loan->total_paid, currency($request->currency));
            })
            ->editColumn('admin_fee', function ($loan) use($request) {
                if($request->currency){
                    return decimalPlace($loan->admin_fee, currency($loan->currency->name));
                }
                return decimalPlace($loan->admin_fee, currency($request->currency));
            })
            ->editColumn('borrower.name', function ($loan){
                return  '<a href="' . action('UserController@show', $loan->borrower->id) . '">' . _lang($loan->borrower->name) . '</a>'; 
            })

            ->editColumn('cellphone', function ($loan) {
                return  $loan->borrower->country_code . $loan->borrower->phone;
            })
            ->editColumn('withdraw_method', function ($loan){ 
                return $loan->withdraw_method->name;
            })
            ->editColumn('disbursed_by', function ($loan){ 
                return $loan->created_by->name;
            })
            ->editColumn('approved_by', function ($loan){ 
                return $loan->approved_by->name;
            })
            ->editColumn('branch', function ($loan){ 
                return $loan->branch->name;
            })
            ->setRowId(function ($loan) {
                return "row_" . $loan->id;
            })
            ->rawColumns(['borrower.name']) //to render html
            ->make(true);
    }
}

