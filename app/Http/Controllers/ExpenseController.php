<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('backend.expense.list', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->ajax()) {
            return view('backend.expense.create');
        } else {
            return view('backend.expense.modal.create');
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
                return redirect()->route('expenses.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $expense                     = new Expense();
        $expense->amount             = $request->input('amount');      
        $expense->description        = $request->input('description');
        $expense->currency_id        = $request->input('currency_id');
        $expense->type               = $request->input('type');
        $expense->created_user_id    = Auth::id();
        $expense->ip_address         = request()->ip();
        $expense->branch_id          = auth()->user()->branch_id;
        $expense->save();

        if (!$request->ajax()) {
            return redirect()->route('expenses.index')->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $expense, 'table' => '#expense_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $expense = Expense::find($id);
        if (!$request->ajax()) {
            return view('backend.expense.view', compact('expense', 'id'));
        } else {
            return view('backend.expense.modal.view', compact('expense', 'id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $expense = Expense::find($id);
        if (!$request->ajax()) {
            return view('backend.expense.edit', compact('expense', 'id'));
        } else {
            return view('backend.expense.modal.edit', compact('expense', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
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
                return redirect()->route('expenses.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $expense                     = Expense::find($id);
        $expense->amount             = $request->input('amount');      
        $expense->description        = $request->input('description');
        $expense->currency_id        = $request->input('currency_id');
        $expense->type               = $request->input('type');
        $expense->updated_user_id    = Auth::id();
        $expense->ip_address         = request()->ip(); 
        $expense->save();

        if (!$request->ajax()) {
            return redirect()->route('expenses.index')->with('success', _lang('Updated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $expense, 'table' => '#expense_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', _lang('Deleted successfully'));
    }
}
