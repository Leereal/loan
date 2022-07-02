<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomes = Income::all();
        return view('backend.income.list', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment_methods = WithdrawMethod::all();
        if (!$request->ajax()) {
            return view('backend.income.create',compact('payment_methods'));
        } else {
            return view('backend.income.modal.create',compact('payment_methods'));
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
        $validator = Validator::make($request->all(), [
            'amount'            => 'required',
            'currency_id'          => 'required|integer',
            'type'              => 'required|string',
            'description'       => 'required'  
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('incomes.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $income                     = new Income();
        $income->amount             = $request->input('amount');      
        $income->description        = $request->input('description');
        $income->currency_id        = $request->input('currency_id');
        $income->withdraw_method_id = $request->input('payment_method');
        $income->type               = $request->input('type');
        $income->created_user_id    = Auth::id();
        $income->ip_address         = request()->ip();
        $income->branch_id          = auth()->user()->branch_id;
        $income->save();

        if (!$request->ajax()) {
            return redirect()->route('incomes.index')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $income, 'table' => '#income_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $income = Income::find($id);
        if (!$request->ajax()) {
            return view('backend.income.view', compact('income', 'id'));
        } else {
            return view('backend.income.modal.view', compact('income', 'id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $payment_methods = WithdrawMethod::all(); 
        $income = Income::find($id);
        if (!$request->ajax()) {
            return view('backend.income.edit', compact('income', 'id','payment_methods'));
        } else {
            return view('backend.income.modal.edit', compact('income', 'id','payment_methods'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'amount'            => 'required',
            'currency_id'          => 'required|integer',
            'type'              => 'required|string',
            'description'       => 'required'  
        ]);
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('incomes.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $income                     = Income::find($id);
        $income->amount             = $request->input('amount');      
        $income->description        = $request->input('description');
        $income->currency_id        = $request->input('currency_id');
        $income->withdraw_method_id = $request->input('payment_method');
        $income->type               = $request->input('type');
        $income->updated_user_id    = Auth::id();
        $income->ip_address         = request()->ip(); 
        $income->save();

        if (!$request->ajax()) {
            return redirect()->route('incomes.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $income, 'table' => '#income_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $income = Income::find($id);
        $income->delete();
        return redirect()->route('incomes.index')->with('success', _lang('Deleted successfully'));
    }
}
