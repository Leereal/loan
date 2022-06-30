<?php

namespace App\Http\Controllers;

use App\Models\BankingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BankingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banking_details = BankingDetail::all()
            ->orderBy("id", "desc")
            ->get();
        return view('backend.user.banking_detail.list', compact('banking_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->get('user');
        return view('backend.user.banking_detail.create',compact('user_id'));
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
            'user_id'               => 'required|numeric',
            // 'withdraw_method_id'    => 'required|numeric',
            'name'                  => 'required',
            'branch'                => 'nullable',
            'account_type'          => 'nullable',
            'account_number'        => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('banking_detail.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $banking_detail                                  = new BankingDetail();
        $banking_detail->user_id                         = $request->input('user_id');
        // $banking_detail->withdraw_method_id              = $request->input('withdraw_method_id');
        $banking_detail->name                            = $request->input('name');
        $banking_detail->branch                          = $request->input('branch');
        $banking_detail->account_type                    = $request->input('account_type');
        $banking_detail->account_number                  = $request->input('account_number');
        $banking_detail->created_by_id                   = Auth::user()->id;
        $banking_detail->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $banking_detail->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $banking_detail, 'table' => '#banking_detail_table']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankingDetail  $bankingDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $bankingDetail)
    {
        $banking_details = BankingDetail::find($bankingDetail);
        if (!$request->ajax()) {
            return view('backend.user.banking_detail.view', compact('banking_details'));
        } else {
            return view('backend.user.banking_detail.modal.view', compact('banking_details'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankingDetail  $bankingDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $banking_detail = BankingDetail::find($id);       
        if (!$request->ajax()) {
            return view('backend.user.banking_detail.edit', compact('banking_detail', 'id'));
        } else {
            return view('backend.user.banking_detail.modal.edit', compact('banking_detail', 'id'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankingDetail  $bankingDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validator = Validator::make($request->all(), [       
            //'withdraw_method_id'    => 'required|numeric',
            'name'                  => 'required',
            'branch'                => 'nullable',
            'account_type'          => 'nullable',
            'account_number'        => 'required',            
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('banking_detail.edit',$id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $banking_detail                                  = BankingDetail::find($id);    
        //$banking_detail->withdraw_method_id              = $request->input('withdraw_method_id');
        $banking_detail->name                            = $request->input('name');
        $banking_detail->branch                          = $request->input('branch');
        $banking_detail->account_type                    = $request->input('account_type');
        $banking_detail->account_number                  = $request->input('account_number');
        $banking_detail->ip_address                      = request()->ip();
        $banking_detail->updated_by_id                   = Auth::user()->id;
        $banking_detail->save();

        if (!$request->ajax()) {
            return redirect()->route('users.show', $banking_detail->user_id)->with('success', _lang('Saved successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $banking_detail, 'table' => '#banking_detail_table']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankingDetail  $bankingDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankingDetail = BankingDetail::find($id);
        $bankingDetail->delete();
        return back()->with('success', _lang('Deleted successfully'));
    }
}
